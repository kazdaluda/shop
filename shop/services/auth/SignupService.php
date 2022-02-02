<?php


namespace shop\services\auth;


use shop\access\Rbac;
use shop\dispatchers\EventDispatcher;
use shop\entities\User\User;
use shop\forms\auth\SignupForm;
use shop\repositories\UserRepository;
use shop\services\newsletter\Newsletter;
use shop\services\RoleManager;
use shop\services\TransactionManager;

use Yii;
use yii\rbac\ManagerInterface;

class SignupService
{

    private $users;
    private $roles;
    private $transaction;
    private $newsletter;


    public function __construct(
        UserRepository $users,

        RoleManager $roles,
       TransactionManager $transaction

      // Newsletter $newsletter
    )
    {

       $this->users=$users;
       $this->roles=$roles;
       $this->transaction=$transaction;

       //$this->newsletter=$newsletter;
    }



    public function signup(SignupForm $form):void
   {
       $user=User::signup(
           $form->username,
           $form->email,
           $form->password,
           $form->phone
           );
       $this->transaction->wrap(function ()use($user){
           $this->users->save($user);
           $this->roles->assign($user->id,Rbac::ROLE_USER);
       });

   }

   public function confirm($token):void
   {

       if (empty($token)){
           throw new \DomainException('Empty confirm token.');
       }


       $user=$this->users->getByEmailConfirmToken($token);

       $user->confirmSignup();
       $this->users->save($user);

      // $this->newsletter->subscribe($user->email);

   }
}





















