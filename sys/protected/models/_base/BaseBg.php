<?php

/**
 * This is the model base class for the table "bg".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Bg".
 *
 * Columns in table "bg" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $photo
 * @property string $date
 *
 */
abstract class BaseBg extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'bg';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Bg|Bgs', $n);
	}

	public static function representingColumn() {
		return 'photo';
	}

	public function rules() {
		return array(
			array('photo', 'length', 'max'=>255),
			array('date', 'length', 'max'=>45),
			array('photo, date', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, photo, date', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'photo' => Yii::t('app', 'Photo'),
			'date' => Yii::t('app', 'Date'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('photo', $this->photo, true);
		$criteria->compare('date', $this->date, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}