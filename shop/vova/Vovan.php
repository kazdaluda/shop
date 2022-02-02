<?php
namespace shop\vova;

class Vovan implements VovaInterface
{
    public $l;

    public function __construct(LudaInterface $l)
    {
       $this->l=$l;
    }

    public function vova()
  {
      return "Vovan";
  }
  public function luda()
  {

      return  $this->l->luda('vvvv');

  }
}