<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "component_config".
 *
 * @property integer $id
 * @property integer $config_id
 * @property integer $component_id
 * @property integer $count
 * @property integer $summ
 */
class ComponentConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'component_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['config_id', 'component_id', 'summ'], 'required'],
            [['config_id', 'component_id', 'count', 'summ'], 'integer'],
            ['config_id', 'unique', 'targetAttribute' => ['config_id', 'component_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'config_id' => 'Config ID',
            'component_id' => 'Компонент',
            'componentName' => 'Название компонента',
            'ArtCode' => 'ArtCode',
            'count' => 'Количество',
            'summ' => 'Сумма',
        ];
    }

    /**
     * @inheritdoc
     * @return ComponentConfigQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ComponentConfigQuery(get_called_class());
    }

    public function getComponent()
    {
        return $this->hasOne(Component::className(), ['id' => 'component_id']);
    }

    public function getComponentName(){
        return $this->component->name;
    }

    public function getArtcode(){
        return $this->component->artcode;
    }

}
