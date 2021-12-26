<?php
    function display_error($validation,$field){
        if($validation->hasError($field)){
            return $validation->getError($field);
        }
        else{
            return false;
        }
    }

    function check($pass1, $pass2){
        if($pass1 == $pass2){
                return true;
            }
        else{
            return false;
        }
    } 
?>