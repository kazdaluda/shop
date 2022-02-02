<?php


namespace backend\forms\Shop;


use shop\entities\Shop\Discount;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class DiscountSearch extends Model
{
    public $percent;
    public $name;
    public $id;
    public $from_date;


    public $active;
    public $sort;
    public $to_date;


    public function rules(): array
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['percent','sort','id'],'integer'],
            [['active'], 'boolean'],
            [['from_date',  'to_date'], 'date','format'=>'php:Y-m-d'],

        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {

        $query = Discount::find()->alias('d');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            exit();
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'd.id' => $this->id,
             'd.sort'=>$this->sort,
            'd.active' => $this->active,
            'd.percent' => $this->percent,
            'd.to_date' => $this->to_date,
            'd.from_date'=>$this->from_date
        ]);

        $query->andFilterWhere(['like', 'd.name', $this->name]);


        return $dataProvider;
    }


}