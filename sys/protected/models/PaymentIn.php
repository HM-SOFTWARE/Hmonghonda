<?php

Yii::import('application.models._base.BasePaymentIn');

class PaymentIn extends BasePaymentIn
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave()
    {
        $this->date = date('Y-m-d', strtotime($this->date));
        return parent::beforeSave();
    }

    public function beforeValidate()
    {
        //  $this->amonut = substr(preg_replace("/[^0-9]/", "", $this->amonut), 0, -2);
        return parent::beforeValidate();
    }

    public function getTotal($records, $amount)
    {
        $total = 0;
        foreach ($records as $record) {
            $total += $record->$amount;
        }
        return number_format($total, 2);
    }

    public function search1()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('detail', $this->detail, true);
        $criteria->compare('amonut', $this->amonut);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('branch_id', $this->branch_id);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('cus_id', $this->cus_id);
        // $criteria->addCondition('cus_id IS NULL'); // disable list pay supsin, kheuthabian
        $criteria->compare('sp', $this->sp);
        $criteria->compare('car_id', $this->car_id);
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 200,
            ),
        ));
    }

}
