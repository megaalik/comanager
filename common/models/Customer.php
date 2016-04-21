<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property integer $org_type
 * @property string $org_name
 * @property integer $city
 * @property string $head_position
 * @property string $head_position_dp
 * @property string $male
 * @property string $last_name
 * @property string $first_name
 * @property string $patronymic
 * @property string $last_name_dp
 * @property string $first_name_dp
 * @property string $patronimic_dp
 * @property string $contacts
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['org_type', 'org_name', 'city_id', 'head_position', 'head_position_dp', 'male', 'last_name', 'first_name', 'patronymic', 'last_name_dp', 'first_name_dp', 'patronimic_dp'], 'required'],
            [['org_type', 'city_id'], 'integer'],
            [['org_name'], 'unique', 'message'=>'Данная организация уже есть в базе данных'],
            [['org_name', 'head_position', 'head_position_dp', 'male', 'last_name', 'first_name', 'patronymic', 'last_name_dp', 'first_name_dp', 'patronimic_dp'], 'trim'],
            [['org_name', 'contacts'], 'string', 'max' => 255],
            [['head_position', 'head_position_dp'], 'string', 'max' => 200],
            [['male'], 'string', 'max' => 3],
            [['last_name', 'first_name', 'patronymic', 'last_name_dp', 'first_name_dp', 'patronimic_dp'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'org_type' => 'Тип организации',
            'org_name' => 'Название организации',
            'city_id' => 'Город',
            'head_position' => 'Должность руководителя',
            'head_position_dp' => 'Должность руководителя в дательном падеже (кому?)',
            'male' => 'Пол',
            'last_name' => 'Фамилия',
            'first_name' => 'Имя',
            'patronymic' => 'Отчество',
            'last_name_dp' => 'Фамилия в дательном падеже (кому?)',
            'first_name_dp' => 'Имя в дательном падаже (кому?)',
            'patronimic_dp' => 'Отчество в дательном падеже (кому?)',
            'contacts' => 'Контакты',
        ];
    }

    /**
     * @inheritdoc
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg_type()
    {
        return $this->hasOne(Org_type::className(), ['id' => 'org_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
