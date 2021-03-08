<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property int $auto_id
 * @property int $category_id
 * @property string $sub_category_name
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $categoryname;
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['category_id', 'sub_category_name'], 'required'],
            [['sub_category_name', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'category_id' => 'Category ID',
            'sub_category_name' => 'Sub Category Name',
            'categoryname' => 'Category Name',
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
