<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "offer".
 *
 * @property integer $id
 * @property string $offer_date
 * @property string $delivery_conditions
 * @property string $price_type
 * @property integer $provider_costs
 * @property integer $delivery_costs
 * @property integer $local_delivery_costs
 * @property double $customs_duty
 * @property double $nds
 * @property integer $service_costs
 * @property double $income_rate
 * @property integer $registration_costs
 * @property double $marketing_costs
 * @property string $currency
 * @property integer $currency_rate
 * @property integer $total_price
 * @property integer $total_price_nds
 * @property integer $customer_id
 * @property integer $city_id
 * @property string $performer_id
 * @property integer $user_id
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['offer_date', 'delivery_conditions', 'price_type', 'provider_costs', 'delivery_costs', 'local_delivery_costs', 'customs_duty', 'nds', 'service_costs', 'income_rate', 'registration_costs', 'marketing_costs', 'currency', 'currency_rate', 'customer_id', 'city_id', 'performer_id', 'user_id'], 'required', 'message' =>'Введите данные' ],
            [['offer_date'], 'safe'],
            [['provider_costs', 'delivery_costs', 'local_delivery_costs', 'service_costs', 'registration_costs', 'currency_rate', 'total_price', 'total_price_nds', 'customer_id', 'city_id', 'performer_id', 'user_id'], 'integer'],
            [['customs_duty', 'nds', 'income_rate', 'marketing_costs'], 'number'],
            [['delivery_conditions'], 'string', 'max' => 30],
            [['price_type'], 'string', 'max' => 100],
            [['currency'], 'string', 'max' => 3],
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['cip'] = ['offer_date', 'price_type', 'provider_costs', 'delivery_costs', 'service_costs', 'registration_costs', 'marketing_costs', 'currency', 'currency_rate', 'customer_id', 'city_id', 'performer_id', 'user_id'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'offer_date' => 'Дата КП',
            'delivery_conditions' => 'Условия доставки',
            'price_type' => 'Тип прайса',
            'provider_costs' => 'Стоимость производителя',
            'delivery_costs' => 'Стоимость доставки',
            'local_delivery_costs' => 'Расходы на доставку внутри страны',
            'customs_duty' => 'Customs Duty %',
            'nds' => 'Nds %',
            'service_costs' => 'Расходы по сервису/ установке',
            'income_rate' => 'Таможенная пошлина, %',
            'registration_costs' => 'Расходы по регистрации/ лицензированию',
            'marketing_costs' => 'Расходы на продвижени/ маркетинг, %',
            'currency' => 'Валюта',
            'currency_rate' => 'Курс доллара',
            'total_price' => 'Итоговая цена',
            'total_price_nds' => 'НДС',
            'customer_id' => 'Клиент',
            'city_id' => 'Город',
            'performer_id' => 'Исполнитель',
            'user_id' => 'Пользователь',
        ];
    }

    /**
     * @inheritdoc
     * @return OfferQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OfferQuery(get_called_class());
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    public function beforeSave(){
        $this->city_id = 1;
    }

    public function beforeValidate(){
        if(Yii::$app->request->post('delivery_conditions')=="CIP"){
            $this->scenario = 'cip';echo "cip";die;
        }
    }
}
