<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ChapterManagement;

/**
 * ChapterManagementSearch represents the model behind the search form of `backend\models\ChapterManagement`.
 */
class ChapterManagementSearch extends ChapterManagement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auto_id','category_id','sub_category_id'], 'integer'],
            [['chapter_name', 'status', 'created_at', 'updated_at','categoryname'], 'safe'],
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
        $query = ChapterManagement::find()->joinWith(['category']);

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

        $query->andFilterWhere(['like', 'chapter_name', $this->chapter_name])
              ->andFilterWhere(['like', 'category_management.category_name', $this->categoryname])
              ->andFilterWhere(['like', 'chapter_management.status', $this->status]);

        return $dataProvider;
    }
}
