<?php
    namespace controller;

    class ControlSignOff {

        public function signOff() {
            session_start();

            unset($_SESSION["user"]);
            unset($_SESSION["links"]);

            header("Location: ../index.php");
        }
        
    }

    $object = new ControlSignOff();
    $object -> signOff();
?>