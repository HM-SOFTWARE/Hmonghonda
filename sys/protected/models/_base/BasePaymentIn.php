<?php

/**
 * This is the model base class for the table "payment_in".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PaymentIn".
 *
 * Columns in table "payment_in" available as properties of the model,
 * followed by relations of table "payment_in" available as properties of the model.
 *
 * @property integer $id
 * @property string $detail
 * @property integer $amonut
 * @property string $date
 * @property integer $branch_id
 * @property string $status
 * @property integer $cus_id
 * @property integer $sp
 * @property integer $car_id
 *
 * @property Branch $branch
 */
abstract class BasePaymentIn extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'payment_in';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'PaymentIn|PaymentIns', $n);
	}

	public static function representingColumn() {
		return 'detail';
	}

	public function rules() {
		return array(
			array('detail, amonut, date, branch_id', 'required'),
			array('amonut, branch_id, cus_id, sp, car_id', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>7),
			array('status, cus_id, sp, car_id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, detail, amonut, date, branch_id, status, cus_id, sp, car_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'branch' => array(self::BELONGS_TO, 'Branch', 'branch_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'detail' => Yii::t('app', 'Detail'),
			'amonut' => Yii::t('app', 'Amonut'),
			'date' => Yii::t('app', 'Date'),
			'branch_id' => null,
			'status' => Yii::t('app', 'Status'),
			'cus_id' => Yii::t('app', 'Cus'),
			'sp' => Yii::t('app', 'Sp'),
			'car_id' => Yii::t('app', 'Car'),
			'branch' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('detail', $this->detail, true);
		$criteria->compare('amonut', $this->amonut);
		$criteria->compare('date', $this->date, true);
		$criteria->compare('branch_id', $this->branch_id);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('cus_id', $this->cus_id);
		$criteria->compare('sp', $this->sp);
		$criteria->compare('car_id', $this->car_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}