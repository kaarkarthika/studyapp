<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SubCategory;

/**
 * SubCategorySearch represents the model behind the search form of `backend\models\SubCategory`.
 */
class SubCategorySearch extends SubCategory
{
    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['auto_id', 'category_id'], 'integer'],
            [['sub_category_name', 'status', 'created_at', 'updated_at','categoryname'], 'safe'],
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
        $query = SubCategory::find()->joinWith(['category']);

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
            'auto_id' => $this->auto_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'sub_category_name', $this->sub_category_name])
            ->andFilterWhere(['like', 'category_management.category_name', $this->categoryname])
            ->andFilterWhere(['like', 'sub_category.status', $this->status]);

        return $dataProvider;
    }
}
