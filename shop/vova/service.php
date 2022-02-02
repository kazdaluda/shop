<?php


namespace shop\vova;


use shop\cart\CartItem;
use shop\entities\Shop\Product\Product;
use shop\readModels\Shop\ProductReadRepository;
use shop\repositories\Shop\ProductRepository;
use yii\base\Theme;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\mail\MailerInterface;
interface zzz
{
    public function www($tt);
}
interface rrr
{
    public function wwww($aa);
}

class vova implements rrr
{
    public $rrr;
    public function __construct()
    {
       //$this->rrr=$rrr;
    }

    public function wwww($aa)
   {

       return 44+$aa;
   }

}
class yyyy implements rrr
{
  public function wwww($aa)
  {
     return 44-$aa;
  }
}


class ludan
{
    public $aa;
    public $aaa;
    public function __construct(rrr $rrr)
    {
        $this->aa=$rrr;
    }

}
class hhh
{
    public function hhha()
    {
        //$aaa=new ludan(new vova());
       // $zz=$aaa->aa->wwww(44);
       // $xxx=new ludan(new yyyy());
       // $ffff=$xxx->aa->wwww(44);
       // return $zz.'--'.$ffff;
    }
}





class service
{
    public $l;
    public $v;
    const aaa=56;
    public $zzz;
    public $vova;
  public function __construct(ProductRepository $ppp)
  {
     $this->v=$ppp;

  }
 public function vova()
 {

 }
  public function luda($r)
  {



    $ar=\Yii::$app->session->get('cart',[]);
     $prod=new Product();
    $ar[]=[
        'sss'=>$prod,
        'ee'=>33,
        'yyy'=>66
    ];
    $ar=[];
    \Yii::$app->session->set('cart',$ar);
   // return $ar;


   // $qq=parent::luda(7)*8;
   // return $qq*45;
     $as=[
         ['aa'=>23,'ss'=>77,'ww'=>12,'ee'=>32],
         ['aa'=>2,'ss'=>99,'ww'=>23,'ee'=>33],
         ['aa'=>6,'ss'=>123,'ww'=>78,'ee'=>34],
         ['aa'=>33,'ss'=>1233,'ww'=>9,'ee'=>35],
     ];
      $ass=[
          ['aa'=>11,'bb'=>21,3,4,5],
          ['aa'=>112,'bb'=>212,3,4,5],
          ['aa'=>'rr','bb'=>'tt',3,4,5],
      ];
      $asss=['aa'=>1,'bb'=>2,22,33,44,3,4,5];

     $zz= ArrayHelper::map($as,'ww',function ($aa){
         return $aa['aa'].'--'.$aa['ss'].' '.$aa['ee'];
         //return $aa['aa'];
     });
     $ff=ArrayHelper::map($as,'ee','aa');

      $arz=[1,2,3,10];
      $aaa= array_reduce($arz,function ($a,$aa) use ($ass,$asss){
         $a=array_merge($ass,$asss);
          return $a;
      },2);
      $cc=array_merge($ass,$asss);

      $xxx=array_map(function ($n){
         return [
             'aaa'=>$n,
             'zzz'=>$n,
             'xxx'=>$n,
         ];
      },$arz);
      $zx=ArrayHelper::map($ass,'aa','bb');

     // $qqqq=array_map(function (Product $rrrr){return $this->xxx($rrrr); },$qw);


      return $zx;
  }


}
