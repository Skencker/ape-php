<?php
    class Securite{

        public static funtion verifAccessSession() {
            return (!empty($_SESSION['connect']) && $_SESSION['connect'] === 1 );
        }
    }
?>