<?php
    class Securite{

        public static function verifAccessSession() {
            return (!empty($_SESSION['connect']) && $_SESSION['connect'] === 1 );
        }
    }
?>