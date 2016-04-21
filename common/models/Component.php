<?php

namespace common\models;

use Yii;
/**
 * This is the model class for table "component".
 *
 * @property integer $id
 * @property string $artcode
 * @property string $name
 * @property integer $price
 * @property string $price_date
 * @property string $eng_desc
 * @property string $rus_desc
 */
class Component extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'component';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['artcode', 'name', 'price_date'], 'required'],
            [['artcode'], 'unique'],
            [['price'], 'integer'],
            [['price_date'], 'safe'],
            [['artcode'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 200],
            [['eng_desc', 'rus_desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'artcode' => 'ArtCode',
            'name' => 'Наименование',
            'price' => 'Цена',
            'price_date' => 'Дата цены по прайсу',
            'eng_desc' => 'Описание на английском языке',
            'rus_desc' => 'Описание на русском языке',
        ];
    }

    /**
     * @inheritdoc
     * @return ComponentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ComponentQuery(get_called_class());
    }

}