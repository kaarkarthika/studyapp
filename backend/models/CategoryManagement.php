<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category_management".
 *
 * @property int $auto_id
 * @property string $category_name
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class CategoryManagement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'category_management';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at','category_image'], 'safe'],
            [['category_name'], 'required'],
            [['category_name', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'category_name' => 'Category Name',
            'category_image' => 'Image',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
