<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.10.2021
 * Time: 11:52
 */

namespace frontend\controllers\auth;


use shop\services\auth\NetworkService;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;

class NetworkController extends Controller
{
     private $service;

     public function __construct($id, $module,NetworkService $service, array $config = [])
     {
         $this->service=$service;
         parent::__construct($id, $module, $config);
     }
     public function actions()
     {
         return [
           'auth'=>[
               'class'=>AuthAction::class,
               'successCallback'=>[$this,'onAuthSuccess'],
           ]
         ];
     }

     public function onAuthSuccess(ClientInterface $client)
     {
       $network=$client->getId();
       $attributes=$client->getUserAttributes();
       $identity=ArrayHelper::getValue($attributes,'id');

       try{
           $user=$this->service->auth($network,$identity);
           Yii::$app->user->login($user,Yii::$app->params['user.rememberMeDuration']);
       }catch (\DomainException $e){
           Yii::$app->errorHandler->logException($e);
           Yii::$app->session->setFlash('error',$e->getMessage());
       }
     }


}
























