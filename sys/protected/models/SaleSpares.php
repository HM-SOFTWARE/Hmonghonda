<?php

Yii::import('application.models._base.BaseSaleSpares');

class SaleSpares extends BaseSaleSpares
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function searchdel()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('paid', $this->paid);
        if (!empty($this->date)) {
            Yii::app()->session['datedel'] = $this->date;
        } else {
            $this->date = Yii::app()->session['datedel'];
        }
        $criteria->compare('date', $this->date, true);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('info_spares_id', $this->info_spares_id);
        if (Yii::app()->user->checkAccess('User')) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $criteria->compare('branch_id', $user->branch_id);
        } else {
            $criteria->compare('branch_id', Yii::app()->session['admin_sale_branch']);
        }
        $criteria->compare('sale_status_id', $this->sale_status_id);
        $criteria->compare('discount', $this->discount);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('price_buy', $this->price_buy);
        $criteria->compare('qautity', $this->qautity);
        $criteria->order = 'id DESC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 200,
            ),
        ));
    }

    public function getData($id)
    {
        if (!empty($id)) {
            $sql = "select distinct(customer_id) from sale_spares where sale_status_id=2 and customer_id=" . (int) $id . "";
        } else {
            $sql = "select distinct(customer_id) from sale_spares where sale_status_id=2 and customer_id=0 order by customer_id DESC";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;
    }

    public function getData1()
    {
        $sql = "select distinct(customer_id) from sale_spares order by customer_id DESC";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;
    }

}
