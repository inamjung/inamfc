<?php

namespace app\modules\member\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\member\models\Customers;

/**
 * CustomersSearch represents the model behind the search form about `app\modules\member\models\Customers`.
 */
class CustomersSearch extends Customers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 't', 'a', 'c', 'pay'], 'integer'],
            [['name', 'addr', 'p', 'tel', 'work', 'pos', 'interest', 'slip', 'fb', 'line', 'email','createdate','paydate'], 'safe'],
            [['money'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Customers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>[
                    'id'=>'sort_desc'
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            't' => $this->t,
            'a' => $this->a,
            'c' => $this->c,
            'money' => $this->money,
            'pay' => $this->pay,
            'createdate' => $this->createdate,
            'paydate' => $this->paydate,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'addr', $this->addr])
            ->andFilterWhere(['like', 'p', $this->p])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'work', $this->work])
            ->andFilterWhere(['like', 'pos', $this->pos])
            ->andFilterWhere(['like', 'interest', $this->interest])
            ->andFilterWhere(['like', 'slip', $this->slip])
            ->andFilterWhere(['like', 'fb', $this->fb])
            ->andFilterWhere(['like', 'line', $this->line])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
