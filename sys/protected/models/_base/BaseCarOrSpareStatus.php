<?php

/**
 * This is the model base class for the table "car_or_spare_status".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CarOrSpareStatus".
 *
 * Columns in table "car_or_spare_status" available as properties of the model,
 * followed by relations of table "car_or_spare_status" available as properties of the model.
 *
 * @property integer $id
 * @property string $status
 *
 * @property InfoSpares[] $infoSpares
 * @property InfonCar[] $infonCars
 */
abstract class BaseCarOrSpareStatus extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'car_or_spare_status';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'CarOrSpareStatus|CarOrSpareStatuses', $n);
	}

	public static function representingColumn() {
		return 'status';
	}

	public function rules() {
		return array(
			array('status', 'required'),
			array('status', 'length', 'max'=>255),
			array('id, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'infoSpares' => array(self::HAS_MANY, 'InfoSpares', 'car_or_spare_status_id'),
			'infonCars' => array(self::HAS_MANY, 'InfonCar', 'car_or_spare_status_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'status' => Yii::t('app', 'Status'),
			'infoSpares' => null,
			'infonCars' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}