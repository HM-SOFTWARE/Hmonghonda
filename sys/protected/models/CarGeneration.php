<?php

Yii::import('application.models._base.BaseCarGeneration');

class CarGeneration extends BaseCarGeneration
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}