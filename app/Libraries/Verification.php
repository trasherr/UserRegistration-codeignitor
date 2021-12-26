<?php
namespace App\Libraries;

class Verifiaction {

    public static function check($pass1, $pass2){
        if($pass1 == $pass2){
                return true;
            }
        else{
            return false;
        }
    } 


} 



?>