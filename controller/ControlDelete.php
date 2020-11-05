<?php
    namespace controller;

    use model\ModelLink;
    require_once("../model/ModelLink.php");

    class ControlDelete {

        public $id;

        public function __construct() {
            $this -> id = $_GET["id"];
        }

        public function delete() {
            $model = new ModelLink();
        
            $result = $model -> delete(
                $this -> id
            );
        
            session_start();
                    
            if($result != "") {
                $_SESSION["links"] = $model -> read(
                    $_SESSION["user"]["email"]
                );
                $_SESSION["result"] = "Enlace Eliminado";
            } else {
                $_SESSION["result"] = "El Enlace no Pudo Ser Eliminado";
            }
        
            header("Location: ../principal.php");
        }
        
    }

    $object = new ControlDelete();
    $object -> delete();
?>