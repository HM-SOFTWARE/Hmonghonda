<?php

/**
 * This is the model base class for the table "district".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "District".
 *
 * Columns in table "district" available as properties of the model,
 * followed by relations of table "district" available as properties of the model.
 *
 * @property integer $id
 * @property string $district_name
 * @property integer $province_id
 *
 * @property Customer[] $customers
 * @property Province $province
 */
abstract class BaseDistrict extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'district';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'District|Districts', $n);
	}

	public static function representingColumn() {
		return 'district_name';
	}

	public function rules() {
		return array(
			array('district_name, province_id', 'required'),
			array('province_id', 'numerical', 'integerOnly'=>true),
			array('district_name', 'length', 'max'=>255),
			array('id, district_name, province_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'customers' => array(self::HAS_MANY, 'Customer', 'district_id'),
			'province' => array(self::BELONGS_TO, 'Province', 'province_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'district_name' => Yii::t('app', 'District Name'),
			'province_id' => null,
			'customers' => null,
			'province' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('district_name', $this->district_name, true);
		$criteria->compare('province_id', $this->province_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}