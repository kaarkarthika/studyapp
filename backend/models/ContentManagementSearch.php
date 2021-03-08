<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ContentManagement;

/**
 * ContentManagementSearch represents the model behind the search form of `backend\models\ContentManagement`.
 */
class ContentManagementSearch extends ContentManagement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auto_id', 'category_id', 'sub_category_id', 'chapter_id'], 'integer'],
            [['option_key', 'upload_link', 'upload_file', 'upload_video', 'status', 'created_at', 'updated_at','categoryname','subcategoryname','chaptername'], 'safe'],
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
        $link = array('U','L');
        $query = ContentManagement::find()->where(['option_key'=>$link])->joinWith(['category'],['subcategory'],['chapter']);

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

        $query->andFilterWhere(['like', 'option_key', $this->option_key])
            ->andFilterWhere(['like', 'upload_link', $this->upload_link])
            ->andFilterWhere(['like', 'upload_file', $this->upload_file])
            ->andFilterWhere(['like', 'upload_video', $this->upload_video])
            ->andFilterWhere(['like', 'category_management.category_name', $this->categoryname])
            ->andFilterWhere(['like', 'sub_category.sub_category_name', $this->subcategoryname])
            ->andFilterWhere(['like', 'chapter_management.chapter_name', $this->chaptername])
            ->andFilterWhere(['like', 'content_management.status', $this->status]);

        return $dataProvider;
    }

     public function search1($params)
    {
        $query = ContentManagement::find()->where(['option_key'=>'V'])->joinWith(['category'],['subcategory'],['chapter']);

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

        $query->andFilterWhere(['like', 'option_key', $this->option_key])
            ->andFilterWhere(['like', 'upload_link', $this->upload_link])
            ->andFilterWhere(['like', 'upload_file', $this->upload_file])
            ->andFilterWhere(['like', 'upload_video', $this->upload_video])
            ->andFilterWhere(['like', 'category_management.category_name', $this->categoryname])
            ->andFilterWhere(['like', 'sub_category.sub_category_name', $this->subcategoryname])
            ->andFilterWhere(['like', 'chapter_management.chapter_name', $this->chaptername])
            ->andFilterWhere(['like', 'content_management.status', $this->status]);

        return $dataProvider;
    }
}
