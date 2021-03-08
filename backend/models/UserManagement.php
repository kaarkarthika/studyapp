<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_management".
 *
 * @property int $auto_id
 * @property string $name
 * @property string $age
 * @property string $mobile_number
 * @property string $address
 * @property string $email_id
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 */
class UserManagement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'user_management';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at','auth_key','profile_pic','short_description'], 'safe'],
            [['first_name','last_name', 'age', 'mobile_number', 'address', 'email_id'], 'required'],
            [['first_name','last_name', 'age', 'mobile_number', 'address', 'email_id', 'password'], 'string', 'max' => 255],
            [['mobile_number','email_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'age' => 'Age',
            'mobile_number' => 'Mobile Number',
            'address' => 'Place of Living',
            'email_id' => 'Email ID',
            'password' => 'Password',
            'profile_pic' => 'Profile Pic',
            'short_description' => 'About',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
