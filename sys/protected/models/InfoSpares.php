<?php

Yii::import('application.models._base.BaseInfoSpares');

class InfoSpares extends BaseInfoSpares
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeLabels()
    {
        $rules_a = array(
            'id' => Yii::t('app', 'ລະ​ຫັດ'),
            'spare_code' => Yii::t('app', 'ລະ​ຫັດ​ອາ​ໄຫຼ່'),
            'spare_name' => Yii::t('app', 'ຊື່​ອາ​ໄຫຼ່'),
            'spare_price_buy' => Yii::t('app', 'ລາ​ຄາ​ຊື່'),
            'spare_price_sale' => Yii::t('app', 'ລະ​ຄາ​ຂາຍ'),
            'date_in' => Yii::t('app', 'ວັນ​ທີ​ເອົາ​ເຂົ້າ​ລະ​ບົບ'),
            'date_out' => Yii::t('app', 'Date Out'),
            'spare_position_id' => 'ຕຳ​ແໜ່ງ',
            'type_spares' => 'ປະ​ເພດ​ອາ​ໄຫຼ່',
            'branch_id' => null,
            'car_or_spare_status_id' => 'ສະ​ຖາ​ນະ',
            'qautity' => 'ຈຳ​ນວນອາ​ໄຫຼ່',
            'number_come' => 'ເລກ​ທີ​ນຳ​ເຂົ້າ',
            'user_id' => 'ຜູ້​ປ້ອນ​ເຂົ້າ',
            'branch_from_share' => 'ສາ​ຂາ',
            'sparePosition' => 'ຕຳ​ແໜ່ງ',
            'branch' => null,
            'carOrSpareStatus' => null,
            'user' => null,
            'branchFromShare' => 'ສາ​ຂາ',
            'saleSpares' => null,
        );
        return array_merge(parent::attributeLabels(), $rules_a);
    }

    public function afterFind()
    {
        $this->date_in = date('m/d/Y', strtotime($this->date_in));
        $this->date_out = date('m/d/Y', strtotime($this->date_out));
        return parent::afterFind();
    }

    public function beforeValidate()
    {
        $this->spare_price_buy = substr(preg_replace("/[^0-9]/", "", $this->spare_price_buy), 0, -2);
        $this->spare_price_sale = substr(preg_replace("/[^0-9]/", "", $this->spare_price_sale), 0, -2);
        return parent::beforeValidate();
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->addNotInCondition('id', Yii::app()->session['order_spares']);
        $criteria->compare('spare_code', $this->spare_code, true);
        $criteria->compare('spare_name', $this->spare_name, true);
        $criteria->compare('spare_price_buy', $this->spare_price_buy);
        $criteria->compare('spare_price_sale', $this->spare_price_sale);
        $criteria->compare('date_in', $this->date_in, true);
        $criteria->compare('date_out', $this->date_out, true);
        $criteria->compare('number_come', $this->number_come);
        $criteria->compare('spare_position_id', $this->spare_position_id);
        if (Yii::app()->user->checkAccess('User')) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $criteria->compare('t.branch_id', $user->branch_id);
        } else {
            $criteria->compare('t.branch_id', Yii::app()->session['admin_sale_branch']);
        }
        $criteria->compare('car_or_spare_status_id', $this->car_or_spare_status_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('branch_from_share', $this->branch_from_share);
        $criteria->compare('type_spares', $this->type_spares, true);
        $criteria->compare('qautity', $this->qautity);
        $criteria->order = 'id DESC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 200,
            ),
        ));
    }

    public function search1()
    {
        $criteria = new CDbCriteria;
        $criteria->addNotInCondition('id', Yii::app()->session['order_spares']);
        $criteria->compare('spare_code', $this->spare_code, true);
        $criteria->compare('spare_name', $this->spare_name, true);
        $criteria->compare('spare_price_buy', $this->spare_price_buy);
        $criteria->compare('spare_price_sale', $this->spare_price_sale);
        $criteria->compare('date_in', $this->date_in, true);
        $criteria->compare('date_out', $this->date_out, true);
        $criteria->compare('spare_position_id', $this->spare_position_id);
        if (Yii::app()->user->checkAccess('User')) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $criteria->compare('t.branch_id', $user->branch_id);
        } else {
            $criteria->compare('t.branch_id', Yii::app()->session['admin_sale_branch']);
        }
        $criteria->compare('car_or_spare_status_id', $this->car_or_spare_status_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('branch_from_share', $this->branch_from_share);
        $criteria->compare('type_spares', $this->type_spares, true);
        $criteria->compare('qautity', $this->qautity);
        $criteria->order = 'id DESC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
