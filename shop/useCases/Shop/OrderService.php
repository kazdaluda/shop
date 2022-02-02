<?php

namespace shop\useCases\Shop;

use shop\cart\Cart;
use shop\cart\CartItem;
use shop\entities\Shop\Order\CustomerData;
use shop\entities\Shop\Order\DeliveryData;
use shop\entities\Shop\Order\Order;
use shop\entities\Shop\Order\OrderItem;
use shop\forms\Shop\Order\OrderForm;
use shop\repositories\Shop\DeliveryMethodRepository;
use shop\repositories\Shop\OrderRepository;
use shop\repositories\Shop\ProductRepository;
use shop\repositories\UserRepository;
use shop\services\sms\SmsSender;
use shop\services\TransactionManager;

class OrderService
{
    private $cart;
    private $orders;
    private $products;
    private $users;
    private $deliveryMethods;
    private $transaction;
   // private $sms;

    public function __construct(
        Cart $cart,
        OrderRepository $orders,
        ProductRepository $products,
        UserRepository $users,
        DeliveryMethodRepository $deliveryMethods,
        TransactionManager $transaction
        // SmsSender $sms
    )
    {
        $this->cart = $cart;
        $this->orders = $orders;
        $this->products = $products;
        $this->users = $users;
        $this->deliveryMethods = $deliveryMethods;
        $this->transaction = $transaction;
       // $this->sms=$sms;
    }

    public function checkout($userId, OrderForm $form): Order
    {
        $user = $this->users->get($userId);

        $products = [];

        $items = array_map(function (CartItem $item) {
            $product = $item->getProduct();
            $product->checkout($item->getModificationId(), $item->getQuantity());
            $products[] = $product;
            return OrderItem::create(
                $product,
                $item->getModificationId(),
                $item->getPrice(),
                $item->getQuantity()
            );
        }, $this->cart->getItems());

        $order = Order::create(
            $user->id,
            new CustomerData(
                $form->customer->phone,
                $form->customer->name
            ),
            $items,
            $this->cart->getCost()->getTotal(),
            $form->note
        );

        $order->setDeliveryInfo(
            $this->deliveryMethods->get($form->delivery->method),
            new DeliveryData(
                $form->delivery->index,
                $form->delivery->address
            )
        );

        $this->transaction->wrap(function () use ($order, $products) {
            $this->orders->save($order);
            foreach ($products as $product) {
                $this->products->save($product);
            }
            $this->cart->clear();
        });
     // $this->sms->send($user->phone, 'New order'.$order->id);
        return $order;
    }
    public function pay($id)
    {

    }
    public function fail($id)
    {

    }
}