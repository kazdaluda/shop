<?php
namespace frontend\controllers\vova;

use shop\vova\hhh;
use shop\vova\service;
use shop\vova\vova;
use yii\web\Controller;

class VovaController extends Controller
{
    public $c;
    public $vova;
    public $hhh;
    public function __construct($id, $module,service $c,
                                vova $vova,
                                hhh $hhh,
                                $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->c=$c;
        $this->vova=$vova;
        $this->hhh=$hhh;
    }

    public function actionLuda()
  {
      $luda=$this->c->luda(true);
      $vova=$this->c->vova();
      $hhh=$this->hhh->hhha();
      return $this->render('luda',['luda'=>$luda,
          'vova'=>$vova,'hhh'=>$hhh,

      ]);
  }
}