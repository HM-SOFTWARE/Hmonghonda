<?php

Yii::import('application.models._base.BaseInfonCar');

class InfonCar extends BaseInfonCar
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

//    public function rules() {
//        $rules[] = array('car_code_1,car_code_2', 'application.extensions.uniqueMultiColumnValidator');
//
//
//        return array_merge(parent::rules(), $rules);
//        //return $rules;
//    }

    public function attributeLabels()
    {
        $rules_a = array(
            'id' => Yii::t('app', 'ລະ​ຫັດ'),
            'car_code_1' => Yii::t('app', 'ເລກ​ຈັກ'),
            'car_code_2' => Yii::t('app', 'ເລກ​ຖັງ'),
            'car_price_buy' => Yii::t('app', 'ລາ​ຄາຊື້'),
            'car_price_sale' => Yii::t('app', 'ລາ​ຄາຂາຍ'),
            'car_type_id' => Yii::t('app', 'ປະ​ເພດ​ລົດ'),
            'generation' => Yii::t('app', 'ລຸ້ນ​ລົດ'),
            'color' => Yii::t('app', 'ສີ​ລົດ'),
            'date_in' => Yii::t('app', 'ວັນ​ທີ​ເອົາ​ລົດ​ເຂົ້າ'),
            'date_out' => Yii::t('app', 'Date Out'),
            'branch_id' => Yii::t('app', 'ສາ​ຂາ'),
            'car_or_spare_status_id' => Yii::t('app', 'ສະ​ຖາ​ນະ'),
            'brand' => Yii::t('app', 'ຍີ່​ຫໍ​່'),
            'branch_from_share' => 'ມາ​ຈາກສາ​ຂາ',
            'duc_com' => 'ເອກະສານ',
            'user_id' => 'ຜູ້​ປ້ອນ​ເຂົ້າ',
            'number_com' => 'ເລກ​ທີ່​ນຳ​ເຂົ້າ',
        );
        return array_merge(parent::attributeLabels(), $rules_a);
    }

    public function afterFind()
    {
        $this->date_in = date('m/d/Y', strtotime($this->date_in));
        $this->date_out = date('m/d/Y', strtotime($this->date_out));
        return parent::afterFind();
    }

    public function beforeSave()
    {
        $this->date_in = date('Y-m-d', strtotime($this->date_in));
        $this->date_out = date('Y-m-d', strtotime($this->date_out));
        return parent::beforeSave();
    }

    public function beforeValidate()
    {
        $this->car_price_buy = substr(preg_replace("/[^0-9]/", "", $this->car_price_buy), 0, -2);
        $this->car_price_sale = substr(preg_replace("/[^0-9]/", "", $this->car_price_sale), 0, -2);
        if ($this->isNewRecord) {
            $criteria = new CDbCriteria;
            $criteria->compare('car_code_1', $this->car_code_1);
            $criteria->addInCondition('car_or_spare_status_id', array(1, 2));
            $car = InfonCar::model()->findAll($criteria);
            if (!empty($car) && !empty($this->car_code_1)) {
                $this->car_code_1 = NULL;
                $this->addError('car_code_1', 'ກະ​ລຸ​ນາ​ກວດ​ຄືນເລກ​ຈັກ​ນີ້​ມີ​ແລ້ວ.');
            }
            $criteria = new CDbCriteria;
            $criteria->compare('car_code_2', $this->car_code_2);
            $criteria->addInCondition('car_or_spare_status_id', array(1, 2));
            $car = InfonCar::model()->findAll($criteria);
            if (!empty($car) && !empty($this->car_code_2)) {
                $this->car_code_2 = NULL;
                $this->addError('car_code_2', 'ກະ​ລຸ​ນາ​ກວດ​ຄືນເລກ​ຖັງນີ້​ມີ​ແລ້ວ.');
            }
        }

        return parent::beforeValidate();
    }

    public function search1()
    {
        $criteria = new CDbCriteria;

        $criteria->addNotInCondition('id', Yii::app()->session['order_car']);
        $criteria->compare('car_code_1', $this->car_code_1, true);
        $criteria->compare('car_code_2', $this->car_code_2, true);
        $criteria->compare('car_price_buy', $this->car_price_buy, true);
        $criteria->compare('car_price_sale', $this->car_price_sale, true);
        $criteria->compare('car_type_id', $this->car_type_id);
        $criteria->compare('generation', $this->generation);
        $criteria->compare('color', $this->color);
        $criteria->compare('date_in', $this->date_in, true);
        $criteria->compare('date_out', $this->date_out, true);
        if (Yii::app()->user->checkAccess('User')) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $criteria->compare('branch_id', $user->branch_id);
        } else {
            $criteria->compare('branch_id', Yii::app()->session['admin_sale_branch']);
        }
        $criteria->addCondition('car_or_spare_status_id!=3'); ///////// 3 is Status id 3  have done sale
        $criteria->compare('brand', $this->brand);
        $criteria->compare('user_id', $this->user_id);
        $criteria->order = 'id DESC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('car_code_1', $this->car_code_1, true);
        $criteria->compare('car_code_2', $this->car_code_2, true);
        $criteria->compare('car_price_buy', $this->car_price_buy, true);
        $criteria->compare('car_price_sale', $this->car_price_sale, true);
        $criteria->compare('car_type_id', $this->car_type_id);
        $criteria->compare('generation', $this->generation);
        $criteria->compare('color', $this->color);
        $criteria->compare('date_in', $this->date_in, true);
        $criteria->compare('date_out', $this->date_out, true);
        $criteria->compare('number_com', $this->number_com, true);
        if (Yii::app()->user->checkAccess('User')) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $criteria->compare('branch_id', $user->branch_id);
        } else {
            $criteria->compare('branch_id', Yii::app()->session['admin_sale_branch']);
        }
        $criteria->addCondition('car_or_spare_status_id!=3'); ///////// 3 is Status id 3  have done sale
        $criteria->compare('brand', $this->brand);
        $criteria->compare('user_id', $this->user_id);
        $criteria->order = 'id DESC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 200,
            ),
        ));
    }

    public function searchdel()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('car_code_1', $this->car_code_1, true);
        $criteria->compare('car_code_2', $this->car_code_2, true);
        $criteria->compare('car_price_buy', $this->car_price_buy, true);
        $criteria->compare('car_price_sale', $this->car_price_sale, true);
        $criteria->compare('car_type_id', $this->car_type_id);
        $criteria->compare('generation', $this->generation);
        $criteria->compare('color', $this->color);
        $criteria->compare('date_in', $this->date_in, true);
        if (!empty($this->date_out)) {
            Yii::app()->session['dateoutdel'] = $this->date_out;
        } else {
            $this->date_out = Yii::app()->session['dateoutdel'];
        }
        $criteria->compare('date_out', $this->date_out, true);
        if (Yii::app()->user->checkAccess('User')) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $criteria->compare('branch_id', $user->branch_id);
        } else {
            $criteria->compare('branch_id', Yii::app()->session['admin_sale_branch']);
        }
        $criteria->addCondition('car_or_spare_status_id=3'); ///////// 3 is Status id 3  have done sale
        $criteria->compare('brand', $this->brand);
        $criteria->compare('user_id', $this->user_id);
        $criteria->order = 'id DESC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 200,
            ),
        ));
    }

    public static function checkd($doc, $id)
    {
        if ($doc == 0) {
// return '<span class="glyphicon glyphicon-ok glyphicon"></span>';
            return CHtml::ajaxLink('<span class="glyphicon glyphicon-text-width"></span>', Yii::app()->createUrl("infonCar/doc&id=$id"), array('update' => '#view'));
        } else {
            $data = InfonCar::model()->findByPk($id);
            return'<span class="glyphicon glyphicon-ok glyphicon"></span> ' . date('d/m/Y', strtotime($data->date_d));
            ;
        }
    }

    public static function checkdsaled($doc, $id)
    {
        if ($doc == 0) {
// return '<span class="glyphicon glyphicon-ok glyphicon"></span>';
            return CHtml::ajaxLink('<span class="glyphicon glyphicon-text-width"></span>', Yii::app()->createUrl("infonCar/doc&id=$id&ducnot=1"), array('update' => '#data'));
        } else {
            $data = InfonCar::model()->findByPk($id);
            return'<span class="glyphicon glyphicon-ok glyphicon"></span> ' . date('d/m/Y', strtotime($data->date_d));
            ;
        }
    }

    public static function showcustomer($car_id)
    {
        $carsale = CarSale::model()->findByAttributes(array('infon_car_id' => $car_id));
        if (!empty($carsale)) {
            return $carsale->customer->first_name . ' ' . $carsale->customer->last_name;
        } else {
            return NULL;
        }
    }

}
