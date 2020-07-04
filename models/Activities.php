<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Activities".
 *
 * @property int $id
 * @property string $type
 * @property string $action
 * @property string $date
 */
class Activities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Activities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'action'], 'required'],
            [['type', 'action', 'uid', 'searchParams'], 'string'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'action' => 'Action',
            'date' => 'Date',
        ];
    }
}
