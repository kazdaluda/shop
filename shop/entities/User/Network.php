<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.09.2021
 * Time: 20:38
 */

namespace shop\entities\User;


use Webmozart\Assert\Assert;
use yii\db\ActiveRecord;
/**
 * @property integer $user_id
 * @property string $identity
 * @property string $network
 */

class Network extends ActiveRecord
{
    public static function create($network,$identity)
    {
        Assert::notEmpty($network);
        Assert::notEmpty($identity);

        $item= new static();
        $item->network=$network;
        $item->identity=$identity;
        return $item;

    }
    public function isFor($network,$identity){
        return $this->network === $network && $this->identity === $identity;
    }
    public static function tableName()
    {
        return '{{%user_networks}}';
    }
}






















