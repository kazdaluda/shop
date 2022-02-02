<?php


namespace shop\repositories;
use shop\entities\User\User;
use shop\dispatchers\EventDispatcher;

class UserRepository
{
    private $dispatcher;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
    public function getByEmailConfirmToken($token):User
    {
        return $this->getBy(['verification_token'=>$token]);
    }
    public function getAllByProductInWishList($productId): iterable
    {
        return User::find()
            ->alias('u')
            ->joinWith('wishlistItems w', false, 'INNER JOIN')
            ->andWhere(['w.product_id' => $productId])
            ->each();
    }

    public function findByUsernameOrEmail($value)
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }
    public function getByEmail(string $email):User
    {

        return $this->getBy(['email'=>$email]);
    }
    public function existsByPasswordResetToken(string $token)
    {
        return (bool) User::findByPasswordResetToken($token);
    }
    public function getByPasswordRestToken(string $token):User
    {

        return $this->getBy(['password_reset_token'=>$token]);
    }
    public function save(User $user):void
    {
        if (!$user->save()){
            throw new \RuntimeException('Saving error.');
        }
        $this->dispatcher->dispatchAll($user->releaseEvents());
    }
    public function findByNetworkIdentity($network, $identity): User
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }
    private function getBy(array $conditionr):User
    {

        if (!$user=User::find()->andWhere($conditionr)->limit(1)->one()){

            throw new NotFoundException('User not found.');
        }
        return $user;
    }
    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
        }
        $this->dispatcher->dispatchAll($user->releaseEvents());
    }
    public function get($id): User
    {
        return $this->getBy(['id' => $id]);
    }
}