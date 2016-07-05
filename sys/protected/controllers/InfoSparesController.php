<?php

class InfoSparesController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->renderPartial('view', array(
            'model' => $this->loadModel($id),
                ), FALSE, TRUE);
    }

    public function actionQtt($id)
    {

        Yii::app()->clientScript->scriptMap['*.js'] = false;
        if (isset($_POST['InfoSpares'])) {
            InfoSpares::model()->updateByPk($id, array('qautity' => (int) $_POST['InfoSpares']['qautity']));
            $this->redirect(array('index'));
        }
        $this->renderPartial('form_qtt', array(
            'model' => $this->loadModel($id),
                ), FALSE, TRUE);
    }

    public function actionLock($id)
    {
        InfoSpares::model()->updateByPk($id, array('status' => 'Pending'));
        $this->redirect(array('index', 'branc_id' => Yii::app()->session['admin_sale_branch']));
    }

    public function actionDiscount()
    {
        Yii::app()->session['discount_spares'] = $_POST['discount'];
        $this->redirect(array('infoSpares/orderList'));
    }

    public function actionMorepay()
    {
        Yii::app()->session['morepay'] = $_POST['morepay'];
        $this->redirect(array('infoSpares/orderList'));
    }

    public function actionPaynot()
    {
        $model = Paybefore::model()->findByAttributes(array('customer_id' => $_GET['cus_id']));
        $price = $model->price;
        $this->performAjaxValidation($model);
        if (isset($_POST['Paybefore'])) {
            $model->attributes = $_POST['Paybefore'];
            $model->price = substr(preg_replace("/[^0-9]/", "", $model->price), 0, -2);
            $model->price = $model->price + $price;

            if ($model->save()) {
                $this->redirect(array('payment', 'cus_id' => $_GET['cus_id']));
            }
        }
        $model->price = NULL;
        $this->renderPartial('form_pay', array('model' => $model), false, false);
    }

    public function actionType()
    {
        Yii::app()->clientScript->scriptMap = array(
            'jquery.js' => false,
            'jquery.min.js' => false,
        );
        $model = new TypeSpares;
        if (isset($_POST['TypeSpares'])) {
            $model->attributes = $_POST['TypeSpares'];
            $model->spare_price_sale = substr(preg_replace("/[^0-9]/", "", $model->spare_price_sale), 0, -2);
            $model->spare_price_buy = substr(preg_replace("/[^0-9]/", "", $model->spare_price_buy), 0, -2);
            if ($model->save()) {
                $this->redirect(array('infoSpares/create'));
            }
        }
        $this->renderPartial('type', array(
            'model' => $model,
                ), FALSE, TRUE);
    }

    public function actioncanclesale($branch_id, $id, $qautity, $cus_id)
    {
        $model = InfoSpares::model()->findByPk($id);

        if (empty($model->branch_from_share)) {
            $model->car_or_spare_status_id = 1;
        } else {
            $model->car_or_spare_status_id = 2;
        }
        $qautityn = $qautity + $model->qautity;
        InfoSpares::model()->updateByPk($id, array('car_or_spare_status_id' => $model->car_or_spare_status_id, 'qautity' => $qautityn));
        $salspares = SaleSpares::model()->findByAttributes(array('info_spares_id' => $id, 'customer_id' => $cus_id));
        $salspares->delete();
        Yii::app()->user->setFlash('success', 'ການ​ຍົກ​ເລີກ​ອາ​ໄຫຼ່ທີ​ຂາຍສຳ​ເລັດ​ແລ້ວ​...');
        $this->redirect(array('infoSpares/del', 'branc_id' => $branch_id));
    }

    public function actionPosition()
    {
        Yii::app()->clientScript->scriptMap = array(
            'jquery.js' => false,
            'jquery.min.js' => false,
        );
        $model = new SparesPosition();
        if (isset($_POST['SparesPosition'])) {
            $model->attributes = $_POST['SparesPosition'];

            if (!Yii::app()->user->checkAccess('User')) {
                $model->branch_id = Yii::app()->session['admin_sale_branch'];
            } else {
                $user = User::model()->findByPk(Yii::app()->user->id);
                $model->branch_id = $user->branch_id;
            }
            if ($model->save()) {
                $this->redirect(array('infoSpares/create'));
            }
        }
        $this->renderPartial('position', array(
            'model' => $model,
                ), FALSE, TRUE);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new InfoSpares;
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['InfoSpares'])) {
            $model->attributes = $_POST['InfoSpares'];
            $model->date_in = date('Y-m-d', strtotime($model->date_in));
            $model->status = "Approve";
            if ($model->car_or_spare_status_id == 1) {
                $model->branch_from_share = NULL;
            }
            if ($model->car_or_spare_status_id == 2 && empty($model->branch_from_share)) {
                Yii::app()->user->setFlash('error', "ກະ​ລຸ​ນາ​ເລືອກ​ສາ​ຂາ");
            } else {
                if ($model->save())
                    $this->redirect(array('index'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $model->spare_price_buy = number_format($model->spare_price_buy, 2);
        $model->spare_price_sale = number_format($model->spare_price_sale, 2);
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['InfoSpares'])) {
            $last_qautity = $model->qautity;
            $model->attributes = $_POST['InfoSpares'];
            // $model->date_in = date('Y-m-d', strtotime($model->date_in));
            $model->date_in = date('Y-m-d');
            $model->status = "Approve";
            if ($model->car_or_spare_status_id == 1) {
                $model->branch_from_share = NULL;
            }
            if ($model->car_or_spare_status_id == 2 && empty($model->branch_from_share)) {
                Yii::app()->user->setFlash('error', "ກະ​ລຸ​ນາ​ເລືອກ​ສາ​ຂາ");
            } else {
                if ($last_qautity > 0 && $model->qautity > $last_qautity) {
                    $last_model = LastOldSpares::model()->findByAttributes(array('info_spares_id' => $model->id));
                    if (!empty($last_model)) {
                        $last_model->last_qautity = $model->qautity;
                        $last_model->old_qautity = $last_qautity;
                        $last_model->save();
                    } else {
                        $last_model = new LastOldSpares();
                        $last_model->last_qautity = $model->qautity;
                        $last_model->old_qautity = $last_qautity;
                        $last_model->info_spares_id = $model->id;
                        $last_model->save();
                    }
                }

                if ($model->save()) {
                    if (isset(Yii::app()->session['admin_sale_branch'])) {
                        $this->redirect(array('index', 'branc_id' => Yii::app()->session['admin_sale_branch']));
                    } else {
                        $this->redirect(array('index'));
                    }
                }
            }
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
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionDelsale($id)
    {
        SaleSpares::model()->findByPk($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        if (isset($_GET['branc_id'])) {
            Yii::app()->session['admin_sale_branch'] = $_GET['branc_id'];
        }
        $model = new InfoSpares('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['InfoSpares']))
            $model->attributes = $_GET['InfoSpares'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionSale()
    {
        if (isset($_GET['branc_id'])) {
            Yii::app()->session['admin_sale_branch'] = $_GET['branc_id'];
        } else {
            if (!empty(Yii::app()->session['admin_sale_branch'])) {
                unset(Yii::app()->session['admin_sale_branch']);
            }
        }
        $model = new InfoSpares('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['InfoSpares']))
            $model->attributes = $_GET['InfoSpares'];

        $this->render('sale', array(
            'model' => $model,
        ));
    }

    public function actionOrder($id)
    {
        $car = InfoSpares::model()->findByPk($id);
        if (!empty(Yii::app()->session['order_spares'])) {
            $all_order_spares = array();
            $qtt = array();
            foreach (Yii::app()->session['order_spares'] as $k => $order_spares) {
                $all_order_spares[] = $order_spares;
                $qtt[] = Yii::app()->session['qtt'][$k];
            }
            $all_order_spares[] = $id;
            $qtt[$k + 1] = 0;
            Yii::app()->session['order_spares'] = $all_order_spares;
            Yii::app()->session['qtt'] = $qtt;
        } else {
            Yii::app()->session['order_spares'] = array($id);
            Yii::app()->session['qtt'] = array(0);
        }
        $this->redirect(array('orderList'));
    }

    public function actionOrderList()
    {
        $this->render('order', array('all_list_order' => Yii::app()->session['order_spares']));
    }

    public function actionCheckqautity()
    {
        $array_qtt = array();
        if (empty(Yii::app()->session['qtt'])) {
            $array_qtt[$_GET['key']] = $_POST['qautity'];
            Yii::app()->session['qtt'] = $array_qtt;
        } else {
            $tempspares = Yii::app()->session['qtt'];
            unset($tempspares[$_GET['key']]);
            foreach ($tempspares as $k => $qtt) {
                $array_qtt[$k] = $qtt;
            }
            $array_qtt[$_GET['key']] = $_POST['qautity'];
            Yii::app()->session['qtt'] = $array_qtt;
        }
        Yii::app()->clientScript->scriptMap['*.js'] = false;
        $this->renderPartial('order', array('all_list_order' => Yii::app()->session['order_spares']), false, false);
        exit;
    }

    public function actionCancle($id)
    {
        $temp = Yii::app()->session['order_spares'];
        $qtt = Yii::app()->session['qtt'];
        unset($temp[$id]);
        unset($qtt[$id]);
        Yii::app()->clientScript->scriptMap = array(
            'jquery.js' => false,
            'jquery.min.js' => false,
        );
        Yii::app()->session['order_spares'] = array_values($temp);
        Yii::app()->session['qtt'] = array_values($qtt);
        Yii::app()->clientScript->scriptMap['*.js'] = false;
        $this->renderPartial('order', array('all_list_order' => Yii::app()->session['order_spares']), false, false);
        exit;
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new InfoSpares('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['InfoSpares']))
            $model->attributes = $_GET['InfoSpares'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionPositiondel()
    {
        if (isset($_GET['del'])) {
            SparesPosition::model()->deleteByPk((int) $_GET['del']);
            $this->redirect(array('infoSpares/create'));
        }
        $user = User::model()->findByPk(Yii::app()->user->id);
        if (!Yii::app()->user->checkAccess('User')) {
            $user->branch_id = Yii::app()->session['admin_sale_branch'];
        }
        $model = SparesPosition::model()->findAllByAttributes(array('branch_id' => $user->branch_id));
        $this->renderPartial('positiondel', array(
            'model' => $model,
        ));
    }

    public function actionCheckpstatus()
    {
        if (isset($_POST['status_sale'])) {
            Yii::app()->session['pstatus_sale'] = $_POST['status_sale'];
        }
        // Yii::app()->clientScript->scriptMap['*.js'] = false;
        //$this->renderPartial('order', array('all_list_order' => Yii::app()->session['order_spares']), false, false);
        $this->redirect(array('orderList',));
    }

    public function actionPaidbefore()
    {
        if (isset($_GET['b'])) {
            Yii::app()->session['brach_h'] = $_POST['branch_from_share'];
            unset(Yii::app()->session['paybefore']);
        } else {
            unset(Yii::app()->session['brach_h']);
            Yii::app()->session['paybefore'] = $_POST['paybefore'];
        }
        //   $this->renderPartial('order', array('all_list_order' => Yii::app()->session['order_spares']), false, false);
        $this->redirect(array('orderList',));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return InfoSpares the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = InfoSpares::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionComfirmSale()
    {
        $model = new Customer;
        $i = 0;
        if (!empty(Yii::app()->session['pstatus_sale'])) {
            if (Yii::app()->session['pstatus_sale'] == 4 && empty(Yii::app()->session['brach_h'])) {
                Yii::app()->clientScript->scriptMap = array(
                    'jquery.js' => false,
                    'jquery.min.js' => false,
                );
                $this->renderPartial('error', array('key' => 'ເລືອກ​ສາ​ຂາ'), false, true);
                exit;
            }
            if (empty(Yii::app()->session['paybefore'])) {
                Yii::app()->session['paybefore'] = number_format(0, 2);
            }
            if (Yii::app()->session['pstatus_sale'] == 2 && empty(Yii::app()->session['paybefore'])) {
                Yii::app()->clientScript->scriptMap = array(
                    'jquery.js' => false,
                    'jquery.min.js' => false,
                );
                $this->renderPartial('error', array('key' => 'ປ້ອນ​ຈຳ​ນວນ​ເງີນ​ຈ່າຍ​ກ່ອນ'), false, true);
                exit;
            }
            if (!empty(Yii::app()->session['brach_h'])) {
                Yii::app()->session['pbranch_from_share'] = Yii::app()->session['brach_h'];
            }
        } else {
            Yii::app()->clientScript->scriptMap = array(
                'jquery.js' => false,
                'jquery.min.js' => false,
            );
            $this->renderPartial('error', array('key' => 'ເລືອກ​ສະ​ຖານ​ະ'), false, true);
            exit;
        }
        foreach (Yii::app()->session['order_spares'] as $key => $order_car) {
            $i++;
            if (Yii::app()->session['qtt'][$key] <= 0) {
                Yii::app()->clientScript->scriptMap = array(
                    'jquery.js' => false,
                    'jquery.min.js' => false,
                );
                $this->renderPartial('error', array('key' => $i), false, true);
                exit;
            }
        }
        Yii::app()->clientScript->scriptMap = array(
            'jquery.js' => false,
            'jquery.min.js' => false,
        );
        $this->renderPartial('customer', array('model' => $model), false, true);
    }

    public function actionPayment()
    {

        if (isset($_GET['cus_id'])) {
            $_POST['cus_id'] = Yii::app()->session['cus_id'];
            $_POST['cus_id'] = Yii::app()->session['cus_id'];
        }
        if (isset($_POST['cus_id'])) {
            Yii::app()->session['cus_id'] = $_POST['cus_id'];
            Yii::app()->session['cus_id'] = $_POST['cus_id'];
        } else {
            $_POST['cus_id'] = null;
        }
        $this->render('payment');
    }

    public function actionInvoice($id)
    {
        unset(Yii::app()->session['qtt']);
        unset(Yii::app()->session['order_spares']);
        // unset(Yii::app()->session['pstatus_sale']);
        unset(Yii::app()->session['pbranch_from_share']);
        unset(Yii::app()->session['paybefore']);
        unset(Yii::app()->session['discount_spares']);
        unset(Yii::app()->session['morepay']);
        $this->render('invoice', array('cus_id' => $id));
    }

    /**
     * Performs the AJAX validation.
     * @param InfoSpares $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'info-spares-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionReportsalecar()
    {
        $this->render('reportsalecar');
    }

    public function actionReportshare()
    {
        $this->render('reportshare');
    }

    public function actionReportcar()
    {
        $this->render('reportcar');
    }

    public function actionDel()
    {
        if (isset($_GET['branc_id'])) {
            Yii::app()->session['admin_sale_branch'] = $_GET['branc_id'];
        }
        $model = new SaleSpares('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SaleSpares']))
            $model->attributes = $_GET['SaleSpares'];

        $this->render('del', array(
            'model'
            => $model,
        ));
    }

    public function actionreportbycount()
    {
        $this->render('reportbycount');
    }

}
