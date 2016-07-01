<?php

class InfonCarController extends Controller
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
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->renderPartial('view', array(
            'model' => $this->loadModel($id),
                ), false, true);
    }

    public function actionListrunpai()
    {

        $this->render('listrunpai');
    }

    public function actionCengsupxen()
    {
        $this->render('cengsupxen');
    }

    public function actionCengsupxendone()
    {

        $this->render('cengsupxendone');
    }

    public function actionGivefree()
    {
        Yii::app()->session['givefree'] = $_POST['cak_car'];
    }

    public function actionRunpai($id)
    {

        Yii::app()->clientScript->scriptMap = array(
            'jquery.js' => false,
            'jquery-ui.min.js' => false,
            'jquery.min.js' => false,
            'jquery.ba-bbq.js' => false,
            'jquery.yiilistview.js' => false
        );
        $model = Placard::model()->findByPk($id);

        $sale = CarSale::model()->findByAttributes(array('infon_car_id' => $model->infon_car_id));
        if (isset($_POST['Placard'])) {
            if (isset($_POST['Placard']['date_note']) && !empty($_POST['Placard']['date_note'])) {
                $model->date_note = date('Y-m-d', strtotime($_POST['Placard']['date_note']));
            }
            if (isset($_POST['Placard']['date_placars']) && !empty($_POST['Placard']['date_placars'])) {
                $model->date_placars = date('Y-m-d', strtotime($_POST['Placard']['date_placars']));
            }
            if (isset($_POST['Placard']['pay_note'])) {
                $model->pay_note = substr(preg_replace("/[^0-9]/", "", $_POST['Placard']['pay_note']), 0, -2);
            }
            if (isset($_POST['Placard']['pay_placar'])) {
                $model->pay_placar = substr(preg_replace("/[^0-9]/", "", $_POST['Placard']['pay_placar']), 0, -2);
            }

            if ((int) ($model->pay_note) <= 0) {
                $model->pay_note = substr(preg_replace("/[^0-9]/", "", $model->pay_note), 0, -2);
            }
            if ((int) ($model->pay_placar) <= 0) {
                $model->pay_placar = substr(preg_replace("/[^0-9]/", "", $model->pay_placar), 0, -2);
            }
            Placard::model()->updateByPk($id, array('date_note' => $model->date_note, 'date_placars' => $model->date_placars, 'pay_note' => $model->pay_note, 'pay_placar' => $model->pay_placar));

            if (!empty($model->pay_note)) {
                $payin = PaymentIn::model()->findByAttributes(array('cus_id' => $sale->customer_id, 'car_id' => $sale->infon_car_id, 'sp' => 0));
                if (empty($payin)) {
                    $payin = new PaymentIn;
                }
                $payin->branch_id = $sale->branch_id;
                $payin->date = $model->date_note;
                $payin->cus_id = $sale->customer_id;
                $payin->status = "Approve";
                $payin->car_id = $sale->infon_car_id;
                $payin->sp = 0;
                $payin->amonut = $model->pay_note;
                $payin->detail = 'ໃຊ້​ຈ່າຍແຈ້ງສັບສີນລົດ (ເລກ​ຈັກ ' . $model->infonCar->car_code_1 . ', ​ລະ​ຫັດ​ລູກ​ຄ້າ ' . sprintf('%06d', $sale->customer_id) . ' ຊື່​ລູກ​ຄ້າ ' . $sale->customer->first_name . ' ' . $sale->customer->last_name . ')';
                $payin->save();
            }
            if (!empty($model->pay_placar)) {
                $payin = PaymentIn::model()->findByAttributes(array('cus_id' => $sale->customer_id, 'car_id' => $sale->infon_car_id, 'sp' => 1));
                if (empty($payin)) {
                    $payin = new PaymentIn;
                }
                $payin->branch_id = $sale->branch_id;
                $payin->date = $model->date_placars;
                $payin->amonut = $model->pay_placar;
                $payin->status = "Approve";
                $payin->car_id = $sale->infon_car_id;
                $payin->detail = 'ໃຊ້​ຈ່າຍແລ່ນ​ປ້າຍລົດ (ເລກ​ຈັກ ' . $model->infonCar->car_code_1 . ', ​ລະ​ຫັດ​ລູກ​ຄ້າ ' . sprintf('%06d', $sale->customer_id) . ' ຊື່​ລູກ​ຄ້າ ' . $sale->customer->first_name . ' ' . $sale->customer->last_name . ')';
                $payin->cus_id = $sale->customer_id;
                $payin->sp = 1;
                $payin->save();
            }
            if (isset($_GET['c'])) {
                $this->redirect(array('cengsupxen'));
            } elseif (isset($_GET['cd'])) {
                $this->redirect(array('cengsupxendone'));
            } else {
                $this->redirect(array('listrunpai'));
            }
        } elseif (isset($_POST['yt0'])) {
            $this->redirect(array('listrunpai'));
        }
        $this->renderPartial('runpai', array('model' => $model), false, true);
    }

    public function actionDoc($id)
    {
        Yii::app()->clientScript->scriptMap = array(
            'jquery.js' => false,
            'jquery-ui.min.js' => false,
            'jquery.min.js' => false,
            'jquery.ba-bbq.js' => false,
            'jquery.yiilistview.js' => false
        );
        $model = InfonCar::model()->findByPk($id);
        if (isset($_POST['InfonCar'])) {
            $date = date('Y-m-d', strtotime($_POST['InfonCar']['date_d']));
            InfonCar::model()->updateByPk($id, array('date_d' => $date, 'duc_com' => 1));
            if (isset($_GET['ducnot'])) {
                $this->redirect(array('infonCar/reportsalecar'));
            } else {
                $this->redirect(array('index'));
            }
        }
        $this->renderPartial('doc', array('model' => $model), false, true);
        exit;
    }

    public function actionViewsale($id)
    {

        $this->renderPartial('viewsale', array(
            'model' => $this->loadModel($id),
                ), false, true);
    }

    public function actionOrder()
    {
        if (isset($_GET['share'])) {
            if (isset(Yii::app()->session['share'])) {
                Yii::app()->session['share'] = 4;
            } else {
                Yii::app()->session['share'] = 4;
                unset(Yii::app()->session['order_car']);
            }
        } elseif (isset(Yii::app()->session['share'])) {
            unset(Yii::app()->session['order_car']);
            unset(Yii::app()->session['share']);
        }

        if (isset($_GET['status'])) {
            Yii::app()->session['full_or_dao'] = $_GET['status'];
        }
        $criteria = new CDbCriteria();

        if (isset($_POST['order_id'])) {
            $criteria->addInCondition('id', $_POST['order_id']);
        } else {
            $criteria->addInCondition('id', array($_GET['id']));
        }
        $cars = InfonCar::model()->findAll($criteria);
        foreach ($cars as $car) {
            if (!empty(Yii::app()->session['order_car'])) {
                $all_order_car = array();
                $qtt = array();
                $paid = array();
                $interest = array();
                $period_paid = array();
                $pai = array();
                $share_to_branch = array();
                $amount_paid = array();
                foreach (Yii::app()->session['order_car'] as $k => $order_car) {
                    $all_order_car[] = $order_car;
                    $qtt[] = Yii::app()->session['status_pay'][$k];
                    $paid[] = Yii::app()->session['paid'][$k];
                    $interest[] = Yii::app()->session['interest'][$k];
                    $period_paid[] = Yii::app()->session['period_paid'][$k];
                    $pai[] = Yii::app()->session['pai'][$k];
                    $share_to_branch[] = Yii::app()->session['share_to_branch'][$k];
                    $amount_paid[] = Yii::app()->session['amonut_paid'];
                }
                $all_order_car[] = $car->id;
                $qtt[$k + 1] = 0;
                $paid[$k + 1] = 0;
                $interest[$k + 1] = 0;
                $period_paid[$k + 1] = 0;
                $pai[$k + 1] = 0;
                $share_to_branch[$k + 1] = 0;
                $amount_paid[$k + 1] = 0;
                Yii::app()->session['status_pay'] = $qtt;
                Yii::app()->session['order_car'] = $all_order_car;
                Yii::app()->session['interest'] = $interest;
                Yii::app()->session['paid'] = $paid;
                Yii::app()->session['period_paid'] = $period_paid;
                Yii::app()->session['pai'] = $pai;
                Yii::app()->session['share_to_branch'] = $share_to_branch;
                Yii::app()->session['amonut_paid'] = $amount_paid;
            } else {
                Yii::app()->session['pai'] = array(0);
                Yii::app()->session['period_paid'] = array(0);
                Yii::app()->session['paid'] = array(0);
                Yii::app()->session['interest'] = array(0);
                Yii::app()->session['order_car'] = array($car->id);
                Yii::app()->session['share_to_branch'] = array(0);
                Yii::app()->session['status_pay'] = array(0);
                Yii::app()->session['amonut_paid'] = array(0);
            }
        }
        $this->redirect(array('orderList'));
    }

    public function actionOrderList()
    {
        $this->render(isset(Yii::app()->session['share']) ? 'order_share' : 'order', array('all_list_order' => Yii::app()->session['order_car']));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new InfonCar;
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if (isset($_POST['InfonCar'])) {
            $model->attributes = $_POST['InfonCar'];
            // $model->car_price_buy = substr(preg_replace("/[^0-9]/", "", $model->car_price_buy), 0, -2);
            // $model->car_price_sale = substr(preg_replace("/[^0-9]/", "", $model->car_price_sale), 0, -2);
            $model->user_id = Yii::app()->user->id;
            $model->date_in = date('Y-m-d', strtotime($model->date_in));
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
        $model->car_price_buy = number_format($model->car_price_buy, 2);
        $model->car_price_sale = number_format($model->car_price_sale, 2);
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if (isset($_POST['InfonCar'])) {
            $model->attributes = $_POST['InfonCar'];
            $model->user_id = Yii::app()->user->id;
            $model->date_in = date('Y-m-d', strtotime($model->date_in));
            $model->status = "Approve";
            if ($model->car_or_spare_status_id == 1) {
                $model->branch_from_share = NULL;
            }
            if ($model->car_or_spare_status_id == 2 && empty($model->branch_from_share)) {
                Yii::app()->user->setFlash('error', "ກະ​ລຸ​ນາ​ເລືອກ​ສາ​ຂາ");
            } else {
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

    public function actioncanclesale($branch_id, $id)
    {
        $model = InfonCar::model()->findByPk($id);
        if (empty($model->branch_from_share)) {
            $model->car_or_spare_status_id = 1;
        } else {
            $model->car_or_spare_status_id = 2;
        }
        $model->date_out = NULL;
        InfonCar::model()->updateByPk($id, array('car_or_spare_status_id' => $model->car_or_spare_status_id, 'date_out' => NULL));
        $salcar = CarSale::model()->findByAttributes(array('infon_car_id' => $id));
        $salcar->delete();
        Yii::app()->user->setFlash('success', 'ການ​ຍົກ​ເລີກ​ລົດ​ທີ​ຂາຍຖືກສຳ​ເລັດ​ແລ້ວ​...');
        $this->redirect(array('infonCar/del', 'branc_id' => $branch_id));
    }

    public function actionCancle($id)
    {
        $temp = Yii::app()->session['order_car'];
        $status = Yii::app()->session['status_pay'];
        $amount_p = Yii::app()->session['amonut_paid'];
        $interest = Yii::app()->session['interest'];
        $pai = Yii::app()->session['pai'];
        $paid = Yii::app()->session['paid'];
        $period_paid = Yii::app()->session['period_paid'];
        $share_to_barnch = Yii::app()->session['share_to_branch'];
        unset($temp[$id]);
        unset($status[$id]);
        unset($amount_p[$id]);
        unset($interest[$id]);
        unset($pai[$id]);
        unset($period_paid[$id]);
        unset($share_to_barnch[$id]);
        unset($paid['$id']);

        Yii::app()->clientScript->scriptMap = array(
            'jquery.js' => false,
            'jquery.min.js' => false,
        );

        Yii::app()->session['order_car'] = array_values($temp);
        Yii::app()->session['status_pay'] = array_values($status);
        Yii::app()->session['amonut_paid'] = array_values($amount_p);
        Yii::app()->session['interest'] = array_values($interest);
        Yii::app()->session['pai'] = array_values($pai);
        Yii::app()->session['paid'] = array_values($paid);
        Yii::app()->session['period_paid'] = array_values($period_paid);
        Yii::app()->session['share_to_branch'] = array_values($share_to_barnch);
        $this->redirect(array('infonCar/orderList'));
        // $this->renderPartial(isset(Yii::app()->session['share']) ? 'order_share' : 'order', array('all_list_order' => Yii::app()->session['order_car']), false, true);
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        if (isset($_GET['branc_id'])) {
            Yii::app()->session['admin_sale_branch'] = $_GET['branc_id'];
        }
        $model = new InfonCar('search');
        $model->unsetAttributes();  // clear any default values
        if (
                isset($_GET['InfonCar']))
            $model->attributes = $_GET['InfonCar'];

        $this->render('index', array(
            'model'
            => $model,
        ));
    }

    public function actionDel()
    {
        if (isset($_GET['branc_id'])) {
            Yii::app()->session['admin_sale_branch'] = $_GET['branc_id'];
        }
        $model = new InfonCar('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['InfonCar']))
            $model->attributes = $_GET['InfonCar'];

        $this->render('del', array(
            'model'
            => $model,
        ));
    }

    public function actionViewcus($id)
    {
        $this->renderPartial('viewcus', array(
            'model' => Customer::model()->findByPk($id)
                ), false, true);
    }

    public function actionpainornot($id, $cus_id)
    {
        $pai = Placard::model()->findByAttributes(array('infon_car_id' => $id));
        $id_car = $id;
        $cust_id = $cus_id;
        if (empty($pai)) {
            $pai = new Placard();
        }
        if (isset($_POST['pai_or_not'])) {
            $pai->infon_car_id = $id_car;
            $pai->customer_id = $cust_id;
            if ($_POST['pai_or_not'] == 1) {
                $pai->save();
            } else {
                if (!empty($pai)) {
                    $pai->delete();
                }
            }
            $this->redirect(array('reportsalecar'));
        }
        $this->renderPartial('paiornot', array('pai' => $pai
                ), false, true);
    }

    public function actionLock($id)
    {
        InfonCar::model()->updateByPk($id, array('status' => 'Pending'));
        $this->redirect(array('index', 'branc_id' => Yii::app()->session['admin_sale_branch']));
    }

    public function actionSalecar()
    {
        if (isset($_GET['branc_id'])) {
            Yii::app()->session['admin_sale_branch'] = $_GET['branc_id'];
        } else {
            if (!empty(Yii::app()->session['admin_sale_branch'])) {
                unset(Yii::app()->session['admin_sale_branch']);
            }
        }
        if (!empty(Yii::app()->session['order_car']) && isset($_GET['status']) && Yii::app()->session['full_or_dao'] != $_GET['status']) {
            unset(Yii::app()->session['order_car']);
            unset(Yii::app()->session['status_pay']);
            unset(Yii::app()->session['amonut_paid']);
            unset(Yii::app()->session['interest']);
            unset(Yii::app()->session['pai']);
            unset(Yii::app()->session['paid']);
            unset(Yii::app()->session['period_paid']);
            unset(Yii::app()->session['share_to_branch']);
        } elseif (in_array(Yii::app()->session['full_or_dao'], array(2))) {
            unset(Yii::app()->session['full_or_dao']);
            unset(Yii::app()->session['order_car']);
            unset(Yii::app()->session['status_pay']);
            unset(Yii::app()->session['amonut_paid']);
            unset(Yii::app()->session['interest']);
            unset(Yii::app()->session['pai']);
            unset(Yii::app()->session['paid']);
            unset(Yii::app()->session['period_paid']);
            unset(Yii::app()->session['share_to_branch']);
        }
        $model = new InfonCar('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['InfonCar']))
            $model->attributes = $_GET['InfonCar'];
        $this->render('sale', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new InfonCar('search');
        $model->unsetAttributes();  // clear any default values
        if (
                isset($_GET['InfonCar']))
            $model->attributes = $_GET['InfonCar'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return InfonCar the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = InfonCar::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param InfonCar $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'infon-car-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionComfirmSale()
    {
        $model = new Customer;
        //   Yii::app()->session['status_pay'] = $_POST['status_pay'];
        //   Yii::app()->session['amonut_paid'] = isset($_POST['amonut_paid']) ? $_POST['amonut_paid'] : 0;
        // Yii::app()->session['interest'] = isset($_POST['interest']) ? $_POST['interest'] : 0;
        //   Yii::app()->session['share_to_branch'] = isset($_POST['share_to_branch']) ? $_POST['share_to_branch'] : 0;
        $i = 0;
        foreach (Yii::app()->session['order_car'] as $key => $order_car) {
            $i++;
            if (isset(Yii::app()->session['share'])) {
                if (empty($_POST['share_to_branch'][$key])) {
                    Yii::app()->clientScript->scriptMap = array(
                        'jquery.js' => false,
                        'jquery.min.js' => false,
                    );
                    $this->renderPartial('error', array('key' => $i), false, true);
                    exit;
                }
            }
            if (empty($_POST['status_pay'][$key])) {
                Yii::app()->clientScript->scriptMap = array(
                    'jquery.js' => false,
                    'jquery.min.js' => false,
                );
                $this->renderPartial('error', array('key' => $i), false, true);
                exit;
            } else {
                if ($_POST['status_pay'][$key] == 2 || $_POST['status_pay'][$key] == 3) {
                    if ($_POST['amonut_paid'][$key] == "0.00" || empty($_POST['amonut_paid'][$key]) || !is_numeric($_POST['interest'][$key]) || empty($_POST['interest'][$key])) {

                        Yii::app()->clientScript->scriptMap = array(
                            'jquery.js' => false,
                            'jquery.min.js' => false,
                        );
                        $this->renderPartial('error', array('key' => $i), false, true);
                        exit;
                    }
                }
                if ($_POST['status_pay'][$key] == 2 && (int) $_POST['period_paid'][$key] == 0) {
                    Yii::app()->clientScript->scriptMap = array(
                        'jquery.js' => false,
                        'jquery.min.js' => false,
                    );
                    $this->renderPartial('error', array('key' => $i), false, true);
                    exit;
                }
            }
        }
        Yii::app()->clientScript->scriptMap = array(
            'jquery.js' => false,
            'jquery.min.js' => false,
        );
        $this->renderPartial(isset(Yii::app()->session['share']) ? 'who_send_share' : 'customer', array('model' => $model), false, true);
    }

    public function actionAjaxcheckDistrict()
    {
        $giatUnit = (!empty($_POST['province_id'])) ? $_POST['province_id'] : '0';
        $data = District::model()->findAll('province_id = :province_id', array(':province_id' => $giatUnit));
        // this name districtCodeAndName get from model District  use connect two fields
        $data = CHtml::listData($data, 'id', 'district_name');
        echo CHtml::tag('option', array('value' => ''), CHtml::encode(Yii::t('app', '=== ເລືອກ​ເມືອງ ===')), true);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionInvoice($id)
    {
        unset(Yii::app()->session['status_pay']);
        unset(Yii::app()->session['amonut_paid']);
        unset(Yii::app()->session['interest']);
        unset(Yii::app()->session['order_car']);
        // unset(Yii::app()->session['share']);
        unset(Yii::app()->session['pai']);
        unset(Yii::app()->session['period_paid']);
        unset(Yii::app()->session['share_to_branch']);
        unset(Yii::app()->session['discount_car']);
        unset(Yii::app()->session['givefree']);

        $this->render(isset(Yii::app()->session['share']) ? 'invoice_share' : 'invoice', array('cus_id' => $id));
    }

    public function actionStatus()
    {
        $array_qtt = array();
        if (!empty(Yii::app()->session['status_pay'])) {
            $tempspares = Yii::app()->session['status_pay'];
            unset($tempspares[$_GET['key']]);
            foreach ($tempspares as $k => $qtt) {
                $array_qtt[$k] = $qtt;
            }
            $array_qtt[$_GET['key']] = $_POST['status_id'];
            Yii::app()->session['status_pay'] = $array_qtt;
        } else {
            $array_qtt[$_GET['key']] = $_POST['status_id'];
            Yii::app()->session['status_pay'] = $array_qtt;
        }
        $this->renderPartial('order', array('all_list_order' => Yii::app()->session['order_car']), false, false);
        //   exit;
    }

    public function actionPaid()
    {
        $array_qtt = array();
        if (!empty(Yii::app()->session['paid'])) {
            $tempspares = Yii::app()->session['paid'];
            unset($tempspares[$_GET['key']]);
            foreach ($tempspares as $k => $qtt) {
                $array_qtt[$k] = $qtt;
            }
            $array_qtt[$_GET['key']] = $_POST['amonut_paid'];
            Yii::app()->session['paid'] = $array_qtt;
        } else {

            $array_qtt[$_GET['key']] = $_POST['amonut_paid'];
            Yii::app()->session['paid'] = $array_qtt;
        }
        $this->renderPartial('order', array('all_list_order' => Yii::app()->session['order_car']), false, false);
    }

    public function actionSharebranch()
    {
        Yii::app()->session['Sharebranch'] = $_POST['share_to_branch'];
        $this->renderPartial('order_share', array('all_list_order' => Yii::app()->session['order_car']), false, false);
    }

    public function actionPai()
    {
        $array_qtt = array();
        if (!empty(Yii::app()->session['pai'])) {
            $tempspares = Yii::app()->session['pai'];
            unset($tempspares[$_GET['key']]);
            foreach ($tempspares as $k => $qtt) {
                $array_qtt[$k] = $qtt;
            }
            $array_qtt[$_GET['key']] = $_POST['pai'];
            Yii::app()->session['pai'] = $array_qtt;
        } else {
            $array_qtt[$_GET['key']] = $_POST['pai'];
            Yii::app()->session['pai'] = $array_qtt;
        }
        $this->renderPartial('order', array('all_list_order' => Yii::app()->session['order_car']), false, false);
    }

    public function actionInterest()
    {
        $array_qtt = array();
        if (!empty(Yii::app()->session['interest'])) {
            $tempspares = Yii::app()->session['interest'];
            unset($tempspares[$_GET['key']]);
            foreach ($tempspares as $k => $interest) {
                $array_qtt[$k] = $interest;
            }
            $array_qtt[$_GET['key']] = $_POST['interest'];
            Yii::app()->session['interest'] = $array_qtt;
        } else {
            $array_qtt[$_GET['key']] = $_POST['interest'];
            Yii::app()->session['interest'] = $array_qtt;
        }
        $this->renderPartial('order', array('all_list_order' => Yii::app()->session['order_car']), false, false);
    }

    public function actionPeriodpaid()
    {
        $array_qtt = array();
        if (!empty(Yii::app()->session['period_paid'])) {
            $tempspares = Yii::app()->session['period_paid'];
            unset($tempspares[$_GET['key']]);
            foreach ($tempspares as $k => $interest) {
                $array_qtt[$k] = $interest;
            }
            $array_qtt[$_GET['key']] = (int) $_POST['period_paid'];
            Yii::app()->session['period_paid'] = $array_qtt;
        } else {
            $array_qtt[$_GET['key']] = (int) $_POST['period_paid'];
            Yii::app()->session['period_paid'] = $array_qtt;
        }
        $this->renderPartial('order', array('all_list_order' => Yii::app()->session['order_car']), false, false);
    }

    public function actionDiscount()
    {
        Yii::app()->session['discount_car'] = $_POST['discount'];
        $this->redirect(array('infonCar/orderList'));
    }

    public function actionPayment()
    {
        $list = array();
        if (isset($_GET['cus_id'])) {
            $_POST['cus_id'] = Yii::app()->session['cus_id'];
            $_POST['car_code'] = Yii::app()->session['car_code'];
        }
        if (isset($_POST['cus_id'])) {
            Yii::app()->session['cus_id'] = $_POST['cus_id'];
            Yii::app()->session['car_code'] = $_POST['car_code'];
            $criteria = new CDbCriteria(
                    array(
                'with' => array(
                    'infonCar',
                ),
                'together' => true,
            ));
            $criteria->compare('customer_id', !empty($_POST['cus_id']) ? (int) $_POST['cus_id'] : NULL);
            $criteria->compare('infonCar.car_code_1', $_POST['car_code']);
            $criteria->compare('sale_status_id', 2);
            $criteria->order = 't.id ASC';
            $list = CarSale::model()->findAll($criteria);
        }
        $this->render('payment', array('list' => $list));
    }

    public function actionDetailpay()
    {
        $model = new CarSale;
        $transfer = new AcountTransfer;
        $this->performAjaxValidation($model);
        if (isset($_POST['CarSale'])) {
            $model->attributes = $_POST['CarSale'];
            /* if (isset(Yii::app()->session['admin_sale_branch'])) {
              $model->branch_id = Yii::app()->session['admin_sale_branch'];
              } else {
              $model->branch_id = User::model()->findByPk(Yii::app()->user->id)->branch_id;
              } */

            $max_saleid = Yii::app()->db->createCommand('SELECT max(id) FROM car_sale where id=' . $_POST['sale_id'] . '')->queryScalar();
            $sale = CarSale::model()->findByPk($max_saleid);
            $model->infon_car_id = $sale->infon_car_id;
            $model->date_payof_month = date('Y-m-d', strtotime('+1 month', strtotime($sale->date_payof_month)));
            $model->branch_id = $sale->branch_id;
            $model->customer_id = $sale->customer_id;
            $model->count_date_pay = $sale->count_date_pay - 1;
            $model->sale_status_id = $sale->sale_status_id;
            $model->paid = substr(preg_replace("/[^0-9]/", "", $model->paid), 0, -2);
            $model->type_paid = $_POST['cash_transfer'];
            $model->user_id = Yii::app()->user->id;
            if ($model->save()) {
                $dept_paymoth_id = Yii::app()->db->createCommand('SELECT id FROM depts_month_pay WHERE infon_car_id=' . $model->infon_car_id . ' and MONTH(date_pay)=' . date('m', strtotime($model->date_payof_month)) . ' and status="0"')->queryScalar();
                DeptsMonthPay::model()->updateByPk($dept_paymoth_id, array('status' => 1));
                if (!empty($_POST['pup_mai'])) {
                    $pupmai = new PupmaiPaylate;
                    $pupmai->price = substr(preg_replace("/[^0-9]/", "", $_POST['pup_mai']), 0, -2);
                    $pupmai->car_sale_id = $model->id;
                    if ((int) $pupmai->price > 0) {
                        $pupmai->save();
                    }
                }
                if ($model->type_paid == 'Transfer') {
                    $detail_tra = 'ໂອນ​ເງີນ​ຄ່າ​ລົດ (ລະ​ຫັດ​ລຸກ​ຄ້າ ' . sprintf('%06d', $model->customer_id) . ', ເລກ​ຈັກ ' . $model->infonCar->car_code_1 . ', ຜູ້​ໂອນ ' . $model->other_payment . ' )';
                    $transfer->name = $detail_tra;
                    $transfer->branch_id = $model->branch_id;
                    $transfer->amount = number_format($model->paid, 2);
                    $transfer->date = date('Y-m-d');
                    $transfer->save();
                }
                $this->redirect(array('payment', 'cus_id' => $sale->customer_id));
            } else {
                print_r($model->getErrors());
                exit;
            }
        }
        $model->paid = number_format((int) $_GET['paid'], 2);
        $this->renderPartial('form_pay', array('model' => $model), FALSE, false);
    }

    public function actionReportsalecar()
    {
        if (isset($_GET['rs'])) {
            unset(Yii::app()->session['search']);
            unset(Yii::app()->session['date_start']);
            unset(Yii::app()->session['date_end']);
            unset(Yii::app()->session['status_sale']);
            unset(Yii::app()->session['branch']);
            unset(Yii::app()->session['code_car1']);
            unset(Yii::app()->session['generation']);
        }
        $this->render('reportsalecar'
        );
    }

    public function actionReportshare()
    {
        $this->render('reportshare'
        );
    }

    public function actionReportcar()
    {
        $this->render('reportcar'
        );
    }

    public function actionReportdaily()
    {
        $this->render('reportdail');
    }

    public function actionReportdailybydate()
    {
        $this->render('reportdailbydate');
    }

    public function actionCardaocash()
    {
        $this->render('dao_cash');
    }

    public function actionExportPdf()
    {
        Yii::import('application.vendor.tcpdf.examples.tcpdf_include', true);
        if (isset($_POST['pdf'])) {
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('TCPDF Example 061');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 061', PDF_HEADER_STRING);
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
                require_once(dirname(__FILE__) . '/lang/eng.php');
                $pdf->setLanguageArray($l);
            }
            $pdf->SetFont('dejavusans', '', 10);
            $pdf->AddPage();
            if (isset($_GET['care'])) {
                if (!empty($_GET['care'])) {
                    $status = SaleStatus::model()->findByPk($_GET['care']);
                    $html = '<b><u>ລາຍ​ງານ​ລົດ​ທີຂ​າຍແລ້ວ ' . $status->name . '</u></b><br/><br/>';
                } else {
                    $html = '<b><u>ລາຍ​ງານ​ລົດ​ທີຂ​າຍແລ້ວ</u></b><br/><br/>';
                }
            } elseif (isset($_GET['spales'])) {
                $html = '<b><u>ລາຍ​ງານ​ອາ​ໄຫຼ່​ທີຂ​າຍແລ້ວ</u></b><br/><br/>';
            } elseif (isset($_GET['daily'])) {
                $html = '<b><u>ລາຍ​ງານ​ລາຍ​ຮັບ​ລາຍ​ວັນ</u></b><br/><br/>';
            }
            $html .=$_POST['pdf'];
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->lastPage();
            $pdf->Output('detail.pdf', 'D');
        }
    }

}
