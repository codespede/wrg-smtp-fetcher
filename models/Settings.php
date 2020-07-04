<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Settings".
 *
 * @property int $id
 * @property string $key
 * @property string $value
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['value'], 'string'],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Value',
        ];
    }

    public static function findSetting($attr){ 
        $config = new self;
        $val = $config->getAttribute($attr);
        if($val == 'true') return true;
        if($val == 'false') return false;
        return $val;
    }

    public function getAttribute($attribute, $storeId = 0){
        if($model = self::find()->where(['key' => $attribute])->one()){
            return $model->value;
        }
        return false;
    }
}
