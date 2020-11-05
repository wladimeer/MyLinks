<?php
    namespace controller;

    use model\ModelLink;
    require_once("../model/ModelLink.php");

    class ControlCreate {

        public $name, $link;
        public $error = "";

        public function __construct(){
            $this -> name = $_POST["name"];
            $this -> link = $_POST["link"];
        }

        public function create() {
            if(
                (strpos($this -> name, "<") !== false || strpos($this -> link, "<") !== false)
                ||
                ($this -> name == "" && $this -> link == "")
            ) {
                $this -> error = "Verifica los Campos";
            } else {
                if($this -> name == "") {
                    $this -> error = "Verifica el Nombre";
                }

                if($this -> link == "") {
                    $this -> error = "Verifica el Enlace";
                }             
            }

            session_start();

            if($this -> error == "") {
                $model = new ModelLink();

                $result = $model -> create([
                    "name" => $this -> name,
                    "link" => $this -> link,
                    "email" => $_SESSION["user"]["email"]
                ]);
                    
                if(count($result) == 1) {
                    $_SESSION["links"] = $model -> read(
                        $_SESSION["user"]["email"]
                    );
                    $_SESSION["result"] = "Enlace Añadido";
                    header("Location: ../principal.php");
                } else {
                    $_SESSION["error"] = "El Enlace no Pudo Ser Añadido";
                    header("Location: ControlForm.php?function=create");
                }
            } else {
                $_SESSION["error"] = $this -> error;
                header("Location: ControlForm.php?function=create");
            }
        }
        
    }

    $object = new ControlCreate();
    $object -> create();
?>