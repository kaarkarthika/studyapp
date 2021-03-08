<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "chapter_management".
 *
 * @property int $auto_id
 * @property int $sub_category_id
 * @property string $chapter_name
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class ChapterManagement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $categoryname;
    public static function tableName()
    {
        return 'chapter_management';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_category_id','category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['category_id', 'chapter_name'], 'required'],
            [['chapter_name', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'sub_category_id' => 'Sub Category Name',
            'categoryname' => 'Category Name',
            'category_id' => 'Category Name',
            'chapter_name' => 'Chapter Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function afterFind() {
    if(isset($this->category)){
        $this->categoryname = $this->category->category_name; 
    }else{
         $this->categoryname="-";
    }
        parent::afterFind();
    }
    public function getCategory()
    {
        //TansiLeadManagement
        return $this->hasOne(CategoryManagement::className(), ['auto_id' =>'category_id']);
    }
}
