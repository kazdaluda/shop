<?php
namespace frontend\controllers\auth;

use shop\forms\auth\LoginForm;
use shop\services\auth\AuthService;
use yii\web\Controller;
use Yii;

class AuthController extends Controller
{
    public $layout='cabinet';
   private $service;

   public function __construct( $id, $module,AuthService $service, array $config = [])
   {
       $this->service=$service;
       parent::__construct($id, $module, $config);
   }

    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $user=$this->service->auth($form);
                Yii::$app->user->login($user, $form->rememberMe ? 3600*24*30:0);
                return $this->goBack();
            }catch (\DomainException $e){
                Yii::$app->session->setFlash('error',$e->getMessage());
            }

        }

        return $this->render('/auth/auth/login', [
            'model' => $form,
        ]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}






























