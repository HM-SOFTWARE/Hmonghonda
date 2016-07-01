<?php

Yii::import('application.models._base.BaseCustomer');

class Customer extends BaseCustomer {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function attributeLabels() {
        $rules_a = array(
            'id' => Yii::t('app', 'ລະ​ຫັດ'),
            'first_name' => Yii::t('app', 'ຊື່'),
            'last_name' => Yii::t('app', 'ນາມ​ສະ​ກຸນ'),
            'address' => Yii::t('app', '​ບ້ານ'),
            'phone_1' => Yii::t('app', '​ເບີ​ໂທ 1'),
            'phone_2' => Yii::t('app', 'ເບີ​ໂທ 2'),
            'age' => Yii::t('app', '​ອາ​ຍຸ'),
            'occupation' => Yii::t('app', 'ອາ​ຊີບ'),
            'district_id' => 'ເມືອງ',
            'date' => Yii::t('app', ''),
            'province_id' => 'ແຂວງ',
            'carSales' => null,
            'district' => null,
            'province' => null,
            'placards' => null,
            'saleSpares' => null,
        );
        return array_merge(parent::attributeLabels(), $rules_a);
    }

}
