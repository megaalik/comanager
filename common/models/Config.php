<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property string $tech_spec
 * @property string $tech_task_name
 * @property string $short_desc
 * @property string $long_desc
 * @property string $config_image
 * @property integer $deleted
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'tech_spec', 'tech_task_name', 'short_desc', 'long_desc'], 'required', 'message' => 'Не может быть пустым'],
            [['name'], 'unique', 'message' => 'Конфигурация с таким названием уже существует!'],
            [['price', 'deleted'], 'integer'],
            [['short_desc', 'long_desc'], 'string'],
            [['name', 'description', 'tech_spec', 'tech_task_name', 'config_image'], 'string', 'max' => 255],
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['step2'] = ['config_image'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название конфигурации',
            'description' => 'Краткое описание конфигурации',
            'price' => 'Цена',
            'tech_spec' => 'Техническая спецификация',
            'tech_task_name' => 'Название технического задания',
            'short_desc' => 'Краткое технического задания',
            'long_desc' => 'Полное технического задания',
            'config_image' => 'Картинка конфигурации',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @inheritdoc
     * @return ConfigQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConfigQuery(get_called_class());
    }

    public function afterSave(){
        Yii::$app->locator->cache->set('id',$this->id);
        Yii::$app->locator->cache->set('configName',$this->name);
    }
}
