<?php

Yii::import('application.models._base.BaseCarSale');

class CarSale extends BaseCarSale {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function attributeLabels() {
        $rules_a = array(
            'id' => Yii::t('app', 'ID'),
            'infon_car_id' => null,
            'customer_id' => null,
            'sale_status_id' => null,
            'paid' => Yii::t('app', 'ຈຳ​ນວນ​ເງີນ​ທີ​ຈ່າຍ'),
            'date' => Yii::t('app', 'Date'),
            'interest' => Yii::t('app', 'Interest'),
            'branch_id' => null,
            'other_payment' => Yii::t('app', '​ຊື່​ຜູ້​ຈ່າຍ'),
            'user_id' => null,
            'count_date_pay' => Yii::t('app', 'Count Date Pay'),
            'share_to_branch' => null,
            'branch' => null,
            'user' => null,
            'customer' => null,
            'infonCar' => null,
            'saleStatus' => null,
            'shareToBranch' => null,
        );
        return array_merge(parent::attributeLabels(), $rules_a);
    }

    public function beforeValidate() {
        if (!$this->sale_status_id == 1 || !$this->sale_status_id == 4) {
            $this->paid = substr(preg_replace("/[^0-9]/", "", $this->paid), 0, -2);
        }
        return parent::beforeValidate();
    }

}
