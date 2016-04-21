<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "performer".
 *
 * @property integer $id
 * @property string $last_name
 * @property string $first_name
 * @property string $patronymic
 * @property string $position
 * @property string $phone_num
 * @property string $mobile_num
 * @property string $email
 * @property integer $singer
 * @property string $sign_image
 */
class Performer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'performer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_name', 'first_name', 'patronymic', 'position', 'phone_num', 'mobile_num', 'email', 'singer', 'sign_image'], 'required'],
            [['singer'], 'integer'],
            [['last_name', 'first_name', 'patronymic'], 'string', 'max' => 50],
            [['position', 'phone_num', 'email', 'sign_image'], 'string', 'max' => 255],
            [['mobile_num'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'last_name' => 'Фамилия',
            'first_name' => 'Имя',
            'patronymic' => 'Отчество',
            'position' => 'Должность',
            'phone_num' => 'Номер телефона',
            'mobile_num' => 'Сотовый номер',
            'email' => 'e-mail',
            'singer' => 'Подписывающий',
            'sign_image' => 'Подпись',
        ];
    }

    /**
     * @inheritdoc
     * @return PerformerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PerformerQuery(get_called_class());
    }
}
