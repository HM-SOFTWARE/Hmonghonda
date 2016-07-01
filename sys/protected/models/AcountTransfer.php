<?php

Yii::import('application.models._base.BaseAcountTransfer');

class AcountTransfer extends BaseAcountTransfer {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        $this->date = date('Y-m-d', strtotime($this->date));
        return parent::beforeSave();
    }

    public function beforeValidate() {
        $this->amount = substr(preg_replace("/[^0-9]/", "", $this->amount), 0, -2);
        return parent::beforeValidate();
    }

}
