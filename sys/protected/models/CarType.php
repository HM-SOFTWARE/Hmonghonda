<?php

Yii::import('application.models._base.BaseCarType');

class CarType extends BaseCarType
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}