<?php

/**
 * This is the model base class for the table "province".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Province".
 *
 * Columns in table "province" available as properties of the model,
 * followed by relations of table "province" available as properties of the model.
 *
 * @property integer $id
 * @property string $province_name
 *
 * @property District[] $districts
 */
abstract class BaseProvince extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'province';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Province|Provinces', $n);
	}

	public static function representingColumn() {
		return 'province_name';
	}

	public function rules() {
		return array(
			array('province_name', 'required'),
			array('province_name', 'length', 'max'=>255),
			array('id, province_name', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'districts' => array(self::HAS_MANY, 'District', 'province_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'province_name' => Yii::t('app', 'Province Name'),
			'districts' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('province_name', $this->province_name, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}