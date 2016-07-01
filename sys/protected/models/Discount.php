<?php

Yii::import('application.models._base.BaseDiscount');

class Discount extends BaseDiscount
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}