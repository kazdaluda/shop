<?php


namespace shop\forms\manage\User;


use shop\entities\User\User;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserEditForm extends Model
{
  public $username;
  public $email;
  public $role;
  public $_user;
  public $phone;
  public $status;


  public function __construct(User $user,$config=[])
  {
     $this->username=$user->username;
     $this->email=$user->email;
     $this->phone=$user->phone;
     $this->_user=$user;
     $roles=\Yii::$app->authManager->getRolesByUser($user->id);
     $this->role=$roles? reset($roles)->name:null;
     $this->status=$user->status;

     parent::__construct($config);
  }
  public function rules()
  {
      return [
          [['username','email','status','role'],'required'] ,
          ['email','email'],
          ['email','string','max'=>255],
          ['phone', 'integer'],
          [['username','email'],'unique','targetClass'=>User::class,'filter'=>['<>','id',$this->_user->id]],

      ];
  }
  public function rolesList():array
  {
    return ArrayHelper::map(\Yii::$app->authManager->getRoles(),'name','description');
  }
}