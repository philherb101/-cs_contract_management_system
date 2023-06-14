<?php

namespace frontend\controllers;

use frontend\models\ContractActivityValue;
use frontend\models\ContractActivityValueUnitRate;
use frontend\models\ContractActivityValueUnitRateSearch;
use frontend\models\ContractActivityValueUnitRateSow;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContractActivityValueUnitRateController implements the CRUD actions for ContractActivityValueUnitRate model.
 */
class ContractActivityValueUnitRateController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ContractActivityValueUnitRate models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ContractActivityValueUnitRateSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContractActivityValueUnitRate model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ContractActivityValueUnitRate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ContractActivityValueUnitRate();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $sows = Yii::$app->request->post('sow', []);
                $kpisows = Yii::$app->request->post('kpisow', []);
                foreach ($sows as $key => $sowId) {
                    $cavsow = new ContractActivityValueUnitRateSow();
                    $cavsow->contract_activity_value_unit_rate_id = $model->id;
                    $cavsow->sow_id = $sowId;
                    $cavsow->sow_kpi = $kpisows[$key];
                    $cavsow->save();
                }
                \Yii::$app->session->setFlash('success', "Add Success.");
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ContractActivityValueUnitRate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $sows = Yii::$app->request->post('sow', []);
            $kpisows = Yii::$app->request->post('kpisow', []);
            ContractActivityValueUnitRateSow::deleteAll(['contract_activity_value_unit_rate_id' => $id]);
            foreach ($sows as $key => $sowId) {
                $cavsow = new ContractActivityValueUnitRateSow();
                $cavsow->contract_activity_value_unit_rate_id = $model->id;
                $cavsow->sow_id = $sowId;
                $cavsow->sow_kpi = $kpisows[$key];
                $cavsow->save();
            }
            \Yii::$app->session->setFlash('success', "Update Success.");
            return $this->redirect(['contract-activity-value/view', 'id' => $model->activity_value_id, 'contract_id'=> Yii::$app->request->get('contract_id'), 'req_order'=> Yii::$app->request->get('req_order')]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ContractActivityValueUnitRate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ContractActivityValueUnitRate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ContractActivityValueUnitRate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContractActivityValueUnitRate::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
