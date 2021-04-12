<?php

namespace app\modules\valute\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\valute\models\Currency;

/**
 * CurrencySearch represents the model behind the search form of `app\modules\valute\models\Currency`.
 */
class CurrencySearch extends Currency
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'date'], 'integer'],
            [['valuteID', 'numCode', 'charCode', 'name'], 'safe'],
            [['value'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Currency::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize'=>5,],
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
            'value' => $this->value,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'valuteID', $this->valuteID])
            ->andFilterWhere(['like', 'numCode', $this->numCode])
            ->andFilterWhere(['like', 'charCode', $this->charCode])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
