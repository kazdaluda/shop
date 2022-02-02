<?php

namespace shop\forms\auth;


use yii\base\Model;
use Yii;


/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;


    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }


}
