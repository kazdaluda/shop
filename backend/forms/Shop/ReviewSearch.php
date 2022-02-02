<?php


namespace backend\forms\Shop;


use shop\entities\Shop\Product\Review;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ReviewSearch extends Model
{
    public $id;
    public $user_id;
    public $vote;
    public $text;
    public $active;
    public $product;


    public function rules(): array
    {
        return [
            [['id', 'vote','user_id','product'], 'integer'],
            [['text'], 'safe'],
            [['active'], 'boolean'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Review::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => function (Review $review) {
                return [
                    'product_id' => $review->product,
                    'id' => $review->id,
                ];
            },
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
            'active' => $this->active,
            'vote' => $this->vote,
            'product' => $this->product,
        ]);

        $query
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
    public function activeList(): array
    {
        return [
            1 => \Yii::$app->formatter->asBoolean(true),
            0 => \Yii::$app->formatter->asBoolean(false),
        ];
    }


}