<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "api_service_log".
 *
 * @property int $autoid
 * @property string $request_data
 * @property string $event_key
 * @property string $response_data
 * @property string $status A=Active,I=Inactive
 * @property string $created_at
 * @property string $modified_at
 */
class ApiServiceLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'api_service_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_data', 'response_data', 'status'], 'string'],
            [['created_at'], 'required'],
            [['created_at', 'modified_at'], 'safe'],
            [['event_key'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'request_data' => 'Request Data',
            'event_key' => 'Event Key',
            'response_data' => 'Response Data',
            'status' => 'Status',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }
}
