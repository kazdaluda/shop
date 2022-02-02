<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.09.2021
 * Time: 17:44
 */

namespace frontend\controllers;


use shop\forms\ContactForm;
use shop\services\ContactService;
use yii\web\Controller;
use Yii;

class ContactController extends Controller
{
     private  $service;
     public function __construct($id,$module, ContactService $service, array $config = [])
     {
         $this->service=$service;
         parent::__construct($id, $module, $config);
     }


    public function actionIndex()
    {
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $this->service->send($form);
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                return $this->goHome();
            }catch (\Exception $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $form,
        ]);
    }

}