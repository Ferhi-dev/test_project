<?php
namespace App\Services;



class AntiSpam{

 
  public function isSpam($text)
  {
    if(strlen($text) > 5)
    {
      return "Attention c est une Spam";

    }
    else
    return "goood dont worry it is ok";

  }




}

?>