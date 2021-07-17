<?php
    class Security{

        public static function verifAccessSession() {
            return (!empty($_SESSION['connect']) && $_SESSION['connect'] === 1 );
        }
    }

    //verification des inputs

    function veryfInput ($var) {
        $var = trim(stripslashes(htmlspecialchars($var))); 
        //enlever espace etc....
        //enlever les \
        //enlever le code html etc
        if (!empty($var)){
        return $var;
        }
        else return false;
    };
?>

// creer fonction pour le token class user {}