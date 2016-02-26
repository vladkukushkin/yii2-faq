<?php

namespace vladkukushkin\faq\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use vladkukushkin\faq\models\Faq;

/**
 * FaqSearch represents the model behind the search form about `vladkukushkin\faq\models\Faq`.
 */
class FaqSearch extends Faq
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faq_id', 'faq_show_on_main'], 'integer'],
            [['faq_title', 'faq_text', 'faq_language'], 'safe'],
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
        $query = Faq::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'faq_id' => $this->faq_id,
            'faq_show_on_main' => $this->faq_show_on_main,
        ]);

        $query->andFilterWhere(['like', 'faq_title', $this->faq_title])
            ->andFilterWhere(['like', 'faq_text', $this->faq_text])
            ->andFilterWhere(['like', 'faq_language', $this->faq_language]);

        return $dataProvider;
    }
}
