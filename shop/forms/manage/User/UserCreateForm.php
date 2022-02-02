<?php


namespace shop\forms\manage\User;


use shop\entities\User\User;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserCreateForm extends Model
{
  public $username;
  public $email;
  public $password;
  public $role;
  public $phone;

  public function rules()
  {
      return [
         [['username','email','role'],'required'] ,
          ['email','email'],
          [['username','email'],'string','max'=>255],
          [['username','email'],'unique','targetClass'=>User::class],
          ['password','string','min'=>6],
          ['phone','integer'],
      ];
  }
    public function rolesList():array
    {
        return ArrayHelper::map(\Yii::$app->authManager->getRoles(),'name','description');
    }
}