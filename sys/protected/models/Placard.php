<?php

Yii::import('application.models._base.BasePlacard');

class Placard extends BasePlacard {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function attributeLabels() {
        $label = array(
            'id' => Yii::t('app', 'ID'),
            'date_note' => Yii::t('app', 'Date Note'),
            'date_placars' => Yii::t('app', 'Date Placars'),
            'infon_car_id' => null,
            'customer_id' => null,
            'pay_note' => Yii::t('app', 'ຈຳ​ນວນ​ເງີນ'),
            'pay_placar' => Yii::t('app', 'ຈຳ​ນວນ​ເງີນ'),
            'customer' => null,
            'infonCar' => null,
        );
        return array_merge(parent::attributeLabels(), $label);
    }

    public function afterFind() {
        if (!empty($placardp->date_note)) {
            $this->date_note = date('m/d/Y', strtotime($this->date_note));
        }
        if (!empty($placardp->date_placars)) {
            $this->date_placars = date('m/d/Y', strtotime($this->date_placars));
        }
        $this->pay_note = number_format($this->pay_note, 2);
        $this->pay_placar = number_format($this->pay_placar, 2);
        parent::beforeFind();
    }

}
