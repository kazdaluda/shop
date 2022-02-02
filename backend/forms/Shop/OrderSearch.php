<?php

namespace backend\forms\Shop;

use shop\entities\Shop\Order\Order;
use shop\helpers\OrderHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class OrderSearch extends Model
{
    public $id;
    public $user_id;

    public function rules(): array
    {
        return [
            [['id','user_id'], 'integer'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }

    public function statusList(): array
    {
        return OrderHelper::statusList();
    }
}
