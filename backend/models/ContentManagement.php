<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "content_management".
 *
 * @property int $auto_id
 * @property int $category_id
 * @property int $sub_category_id
 * @property int $chapter_id
 * @property string $option_key U=Upload pdf,L=Link
 * @property string $upload_link
 * @property string $upload_file
 * @property string $upload_video
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class ContentManagement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public $categoryname;
    public $subcategoryname;
    public $chaptername;
    public static function tableName()
    {
        return 'content_management';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'sub_category_id', 'chapter_id'], 'integer'],
           // [['upload_file', 'upload_video'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['option_key', 'upload_link', 'upload_file', 'upload_video', 'status'], 'string', 'max' => 255],
           [['upload_file'], 'file', 'extensions'=>'pdf'],
           [['upload_video'], 'file','extensions' => 'mp4','maxSize' => '2048000'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'category_id' => 'Category Name',
            'categoryname' => 'Category Name',
            'sub_category_id' => 'Sub Category Name',
            'subcategoryname' => 'Sub Category Name',
            'chapter_id' => 'Chapter Name',
            'chaptername' => 'Chapter Name',
            'option_key' => 'Option Key',
            'upload_link' => 'Upload Link',
            'upload_file' => 'Upload File',
            'upload_video' => 'Upload Video',
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
    if(isset($this->subcategory)){
        $this->subcategoryname = $this->subcategory->sub_category_name; 
    }else{
         $this->subcategoryname="-";
    }
    if(isset($this->chapter)){
        $this->chaptername = $this->chapter->chapter_name; 
    }else{
         $this->chaptername="-";
    }
        parent::afterFind();
    }
    public function getCategory()
    {
        return $this->hasOne(CategoryManagement::className(), ['auto_id' =>'category_id']);
    }
    public function getSubcategory()
    {
        return $this->hasOne(SubCategory::className(), ['auto_id' =>'sub_category_id']);
    }
    public function getChapter()
    {
        return $this->hasOne(ChapterManagement::className(), ['auto_id' =>'chapter_id']);
    }
}
