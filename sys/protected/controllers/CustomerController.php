<?php

class CustomerController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionListdept() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $criteria = new CDbCriteria(
                array(
            'with' => array(
                'infonCar',
                'customer'
            ),
            'together' => true,
        ));
        $criteria->compare('t.status', 0);
        $criteria->compare('first_pay', 'N');
        if (isset($_POST['date']) && !empty($_POST['date'])) {
            $criteria->compare('MONTH(date_pay)', date('m', strtotime($_POST['date'])));
            $criteria->compare('YEAR(date_pay)', date('Y', strtotime($_POST['date'])));
        } else {
            $criteria->compare('MONTH(date_pay)', date('m'));
            $criteria->compare('YEAR(date_pay)', date('Y'));
        }
        if ($user->user_type == "User") {
            $criteria->compare('infonCar.branch_id', $user->branch_id);
        }
        $model = DeptsMonthPay::model()->findAll($criteria);
        $this->render('list_dept', array(
            'models' => $model
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Customer;
        $discount = new Discount;
        $giveaway = new Giveaway;
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if (isset($_POST['Customer'])) {
            $model->attributes = $_POST['Customer'];
            if (!empty(Yii::app()->session['order_car'])) {
                if ($model->save()) {
                    $discount->discount = substr(preg_replace("/[^0-9]/", "", Yii::app()->session['discount_car']), 0, -2);
                    $discount->customer_id = $model->id;
                    if (!empty($discount->discount) || !empty(Yii::app()->session['givefree'])) {
                        $discount->save();
                    }
                    $giveaway->giveaway = Yii::app()->session['givefree'];
                    $giveaway->customer_id = $model->id;
                    if (!empty(Yii::app()->session['givefree'])) {
                        $giveaway->save();
                    }
                    foreach (Yii::app()->session['order_car'] as $key => $order_car) {
                        $salecar = new CarSale;
                        if (Yii::app()->user->checkAccess('Admin')) {
                            $salecar->branch_id = Yii::app()->session['admin_sale_branch'];
                        } else {
                            $salecar->branch_id = User::model()->findByPk(Yii::app()->user->id)->branch_id;
                        }
                        $salecar->infon_car_id = $order_car;
                        $salecar->customer_id = $model->id;
                        $salecar->date_payof_month = date('Y-m-d');
                        $salecar->count_date_pay = Yii::app()->session['period_paid'][$key];
                        $salecar->sale_status_id = Yii::app()->session['status_pay'][$key];
                        if (!empty(Yii::app()->session['Sharebranch'])) {
                            $salecar->share_to_branch = Yii::app()->session['Sharebranch'];
                        }
                        $salecar->user_id = Yii::app()->user->id;
                        $salecar->date = date('Y-m-d');
                        $salecar->count_date_pay = Yii::app()->session['period_paid'][$key];
                        if ($salecar->sale_status_id == 1 || $salecar->sale_status_id == 4) {
                            $salecar->paid = InfonCar::model()->findByPk($order_car)->car_price_sale;
                        } else {
                            $salecar->paid = substr(preg_replace("/[^0-9]/", "", Yii::app()->session['paid'][$key]), 0, -2);
                            $salecar->interest = Yii::app()->session['interest'][$key];
                        }
                        if ($salecar->save()) {
                            if (Yii::app()->session['pai'][$key] == 1) {
                                if ($salecar->sale_status_id != 4) {
                                    $pai = new Placard();
                                    $pai->customer_id = $model->id;
                                    $pai->infon_car_id = $order_car;
                                    $pai->save();
                                }
                            }
                            $info_car = InfonCar::model()->findByPk($order_car);
                            $info_car->car_or_spare_status_id = 3;
                            $info_car->date_out = date('Y-m-d');
                            $info_car->car_price_buy = number_format($info_car->car_price_buy, 2);
                            $info_car->car_price_sale = number_format($info_car->car_price_sale, 2);
                            if (!$info_car->save()) {
                                echo "ffff";
                                print_r($info_car->getErrors());
                                exit;
                            }
                            /* if ($salecar->sale_status_id == 4) {
                              $insert_carshare = new InfonCar;
                              $info_car = InfonCar::model()->findByPk($order_car);
                              $info_car->car_price_buy = number_format($info_car->car_price_buy, 2);
                              $info_car->car_price_sale = number_format($info_car->car_price_sale, 2);
                              $insert_carshare->attributes = $info_car->attributes;
                              $insert_carshare->car_or_spare_status_id = 2;
                              $insert_carshare->branch_id = Yii::app()->session['Sharebranch'];
                              $insert_carshare->branch_from_share = $info_car->branch_id;
                              $insert_carshare->save();
                              } */
                        } else {
                            print_r($salecar->getErrors());
                            exit;
                        }
                    }
                    $this->redirect(array('infonCar/invoice', 'id' => $model->id));
                }
            } else {
                $this->redirect(array('infonCar/orderList'));
            }
        }
    }

    public function actionCreatespares() {
        $model = new Customer;
        $discount = new Discount;
        $hengang = new Khahengang;
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if (isset($_POST['Customer'])) {
            $model->attributes = $_POST['Customer'];
            if (!empty(Yii::app()->session['order_spares'])) {
                if ($model->save()) {
                    $discount->discount = substr(preg_replace("/[^0-9]/", "", Yii::app()->session['discount_spares']), 0, -2);
                    $discount->customer_id = $model->id;
                    if (!empty($discount->discount)) {
                        $discount->save();
                    }
                    $hengang->price = substr(preg_replace("/[^0-9]/", "", Yii::app()->session['morepay']), 0, -2);
                    $hengang->customer_id = $model->id;
                    if (!empty($hengang->price)) {
                        $hengang->save();
                    }

                    if (Yii::app()->session['pstatus_sale'] == 2) {
                        $paybefore = new Paybefore();
                        $paybefore->customer_id = $model->id;
                        $paybefore->price = substr(preg_replace("/[^0-9]/", "", Yii::app()->session['paybefore']), 0, -2);
                        $paybefore->save();
                    }
                    foreach (Yii::app()->session['order_spares'] as $key => $order_spares) {
                        $salespares = new SaleSpares;
                        $info_spares = InfoSpares::model()->findByPk($order_spares);
                        $salespares->price_buy = $info_spares->spare_price_sale;
                        $salespares->qautity = Yii::app()->session['qtt'][$key];
                        $salespares->paid = $salespares->price_buy * $salespares->qautity;
                        $salespares->customer_id = $model->id;
                        $salespares->info_spares_id = $order_spares;
                        if (Yii::app()->user->checkAccess('Admin')) {
                            $salespares->branch_id = Yii::app()->session['admin_sale_branch'];
                        } else {
                            $salespares->branch_id = User::model()->findByPk(Yii::app()->user->id)->branch_id;
                        }
                        $salespares->sale_status_id = Yii::app()->session['pstatus_sale'];
                        $salespares->discount = NULL;
                        $salespares->date = date('Y-m-d');
                        $salespares->user_id = Yii::app()->user->id;
                        if ($salespares->save()) {
                            $quatity = $info_spares->qautity - $salespares->qautity;
                            InfoSpares::model()->updateByPk($order_spares, array(
                                'qautity' => $quatity,
                            ));

                            /* if ($salespares->sale_status_id == 4) {
                              $info_spareshare = InfoSpares::model()->findByPk($order_spares);
                              $insert_spareshare = InfoSpares::model()->findByAttributes(array('spare_code' => $info_spareshare->spare_code, 'branch_id' => Yii::app()->session['pbranch_from_share']));
                              if (empty($insert_spareshare)) {
                              $insert_spareshare = new InfoSpares;
                              } else {
                              $qautity = $insert_spareshare->qautity;
                              }
                              $info_spareshare->spare_price_buy = number_format($info_spareshare->spare_price_buy, 2);
                              $info_spareshare->spare_price_sale = number_format($info_spareshare->spare_price_sale, 2);
                              $insert_spareshare->attributes = $info_spareshare->attributes;
                              if (empty($qautity)) {
                              $insert_spareshare->qautity = $salespares->qautity;
                              } else {
                              $insert_spareshare->qautity = $qautity + $salespares->qautity;
                              }
                              $insert_spareshare->car_or_spare_status_id = 2;
                              $insert_spareshare->branch_id = Yii::app()->session['pbranch_from_share'];
                              $insert_spareshare->branch_from_share = $info_spareshare->branch_id;
                              $insert_spareshare->date_in = date('Y-m-d');
                              if (!$insert_spareshare->save()) {
                              print_r($insert_spareshare->getErrors());
                              exit;
                              }
                              } */
                        } else {
                            print_r($salespares->getErrors());
                            exit;
                        }
                    }
                    $this->redirect(array('infoSpares/invoice', 'id' => $model->id));
                }
            } else {
                $this->redirect(array('infoSpares/orderList'));
            }
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Customer'])) {
            $model->attributes = $_POST['Customer'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Customer');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Customer('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Customer']))
            $model->attributes = $_GET['Customer'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Customer the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Customer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Customer $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'customer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
