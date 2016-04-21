<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trash".
 *
 * @property integer $id
 * @property integer $component_id
 * @property integer $config_id
 * @property string $name
 * @property string $description
 * @property integer $count
 * @property integer $price
 * @property integer $summ
 * @property integer $user_id
 */
class Trash extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trash';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['component_id', 'config_id', 'count', 'price', 'summ', 'user_id'], 'integer'],
            [['user_id'], 'required'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'component_id' => 'Component ID',
            'config_id' => 'Config ID',
            'name' => 'Name',
            'description' => 'Description',
            'count' => 'Count',
            'price' => 'Price',
            'summ' => 'Summ',
            'user_id' => 'User ID',
        ];
    }
}
