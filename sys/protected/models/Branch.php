<?php

Yii::import('application.models._base.BaseBranch');

class Branch extends BaseBranch {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function branchname($id) {
        if (!empty($id)) {
            return Branch::model()->findByPk($id);
        } else {
            return NULL;
        }
    }

}
