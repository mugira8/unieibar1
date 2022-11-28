<?php
    function escape($keyword){
        $sanitisazioa = htmlspecialchars($keyword, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
        $sanitisazioa = strip_tags($keyword);
        return $sanitisazioa;
    }

    function checkImage($image){
        $formatos_permitidos =  array('png','jpeg','jpg', 'gif');
	    $archivo = $_FILES['imagen']['name'];
	    $extension = pathinfo($image, PATHINFO_EXTENSION);
	    if(!in_array($extension, $formatos_permitidos) ) {
            return false;
	    }else{
            return true;
	    }
    }

    function checkEmail($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
