<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Emails".
 *
 * @property int $id
 * @property string $from
 * @property string $to
 * @property string $body
 * @property string $dateSent
 */
class Emails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Emails';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'to', 'body'], 'required'],
            [['subject', 'body'], 'string'],
            [['dateSent', 'uid', 'msgNo'], 'safe'],
            [['from', 'to'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'body' => 'Body',
            'dateSent' => 'Date Sent',
        ];
    }
}
