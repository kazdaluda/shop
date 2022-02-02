<?php
namespace shop\services\manage;

use shop\entities\User\User;
use shop\forms\manage\User\UserCreateForm;
use shop\forms\manage\User\UserEditForm;
use shop\repositories\UserRepository;
use shop\services\newsletter\Newsletter;
use shop\services\RoleManager;
use shop\services\TransactionManager;

class UserManageService
{
   private $repository;
   private $roles;
   private $transaction;
   private $newsletter;

   public function __construct(
       UserRepository $repository,
      RoleManager $roles,
      TransactionManager $transaction
       // Newsletter $newsletter
   )
   {
       $this->repository=$repository;
       $this->roles=$roles;
       $this->transaction=$transaction;
      // $this->newsletter=$newsletter;
   }
   public function create(UserCreateForm $form):User
   {
     $user=User::create(
        $form->username,
        $form->email,
        $form->phone,
        $form->password
     );
     $this->transaction->wrap(function ()use($user,$form){
         $this->repository->save($user);
         $this->roles->assign($user->id,$form->role);
     });

     return $user;
   }
   public function edit($id,UserEditForm $form):void
   {
      $user=$this->repository->get($id);
      $user->edit($form->username,$form->email,$form->phone,$form->status);

       $this->transaction->wrap(function ()use($user,$form) {
           $this->repository->save($user);
           $this->roles->assign($user->id,$form->role);
       });
   }
   public function remove($id)
   {
       $user=$this->repository->get($id);
       $this->repository->remove($user);
      // $this->newsletter->unsubscribe($user->email);
   }
}























