<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "org_type".
 *
 * @property integer $id
 * @property string $org_type_name
 */
class Org_type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'org_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['org_type_name'], 'required'],
            [['org_type_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'org_type_name' => 'Org Type Name',
        ];
    }

    /**
     * @inheritdoc
     * @return Org_typeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new Org_typeQuery(get_called_class());
    }
}
