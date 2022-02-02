<?php


namespace backend\controllers\shop;


use backend\forms\Shop\DiscountSearch;

use shop\entities\Shop\Discount;
use shop\forms\manage\Shop\Product\DiscountForm;
use shop\services\manage\DiscountManageService;
use yii\web\Controller;

class DiscountController extends Controller
{
    private $discount;
    public function __construct($id, $module,DiscountManageService $discount, $config = [])
    {
        $this->discount=$discount;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $searchModel = new DiscountSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        $form=new DiscountForm();
        if ($form->load(\Yii::$app->request->post()) && $form->validate()){
            try {
                $user=$this->discount->create($form);
                return $this->redirect(['view','id'=>$user->id]);
            }catch (\DomainException $e){
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error',$e->getMessage());
            }
        }
        return $this->render('create',['model'=>$form]);

    }

    public function actionView( $id)
    {
        $view = $this->findModel($id);


        return $this->render('view', [
            'model' => $view,

        ]);
    }


    public function actionActivate($id)
    {
        try {
            $this->discount->activate($id);
        } catch (\DomainException $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDraft($id)
    {
        try {
            $this->discount->draft($id);
        } catch (\DomainException $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $rview = $this->findModel($id);

        $form = new DiscountForm($rview);


        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {

            try {
                $this->discount->edit($rview->id, $form);

                return $this->redirect(['view','id'=>$rview->id]);
            } catch (\DomainException $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'rview' => $rview,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        try {
            $this->discount->remove($id);
        } catch (\DomainException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    protected function findModel($id): Discount
    {
        if (($model = Discount::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}