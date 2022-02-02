<?php


namespace backend\controllers\shop;


use backend\forms\Shop\ReviewSearch;
use shop\entities\Shop\Product\Review;
use shop\forms\manage\Shop\Product\ReviewEditForm;
use shop\services\manage\Shop\ReviewManageService;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class ReviewController extends Controller
{
    private $service;

      public function __construct(
          $id,
          $module,
          ReviewManageService $service,
          $config = []
      )
      {
          parent::__construct($id, $module, $config);
          $this->service = $service;
      }
     public function behaviors(): array
      {
          return [
              'verbs' => [
                  'class' => VerbFilter::className(),
                  'actions' => [
                      'delete' => ['POST'],
                  ],
              ],
          ];
      }
 public function actionIndex()
 {
     $searchModel = new ReviewSearch();
     $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

     return $this->render('index', [
         'searchModel' => $searchModel,
         'dataProvider' => $dataProvider,
     ]);
 }

  public function actionView($product_id, $id)
  {
      $view = $this->findModel($id);


      return $this->render('view', [
          'rview' => $view,

      ]);
  }


    public function actionActivate($productId,$id)
    {
        try {
            $this->service->activate($productId,$id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view','product_id'=>$id, 'id' => $id]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDraft($productId,$id)
    {
        try {
            $this->service->draft($productId,$id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view','product_id'=>$id, 'id' => $id]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($product_id,$id)
    {

        $rview = $this->findModel($id);

        $form = new ReviewEditForm($rview);


        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {

            try {
                $this->service->edit($rview->product,$rview->id, $form);
                return $this->redirect(['view', 'product_id' => $rview->product,'id'=>$rview->id]);
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
    public function actionDelete($product_id,$id)
    {

        try {
            $this->service->remove($product_id,$id);
        } catch (\DomainException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

  protected function findModel($id): Review
  {
      if (($model = Review::findOne($id)) !== null) {
          return $model;
      }
      throw new NotFoundHttpException('The requested page does not exist.');
  }

}