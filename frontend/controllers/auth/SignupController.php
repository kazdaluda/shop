<?php
namespace frontend\controllers\auth;

use shop\forms\auth\SignupForm;
use shop\services\auth\SignupService;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class SignupController extends Controller
{
    public $layout='cabinet';
    private $service;

    public function __construct( $id, $module,SignupService $service, array $config = [])
    {
        $this->service=$service;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],

                ],
            ],

        ];
    }
    public function actionIndex()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{

                $this->service->signup($form);
                Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
                return $this->goHome();


            }catch (\DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error',$e->getMessage());
            }

        }
        return $this->render('/auth/signup/request', [
            'model' => $form,
        ]);
    }
    public function actionConfirm($token)
    {

        try{
            $this->service->confirm($token);
            Yii::$app->session->setFlash('success','Yuor email is confirmed');
            return $this->redirect(['auth/auth/login']);

        }catch (\DomainException $e){
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error',$e->getMessage());
            return $this->goHome();
        }
    }
}



























