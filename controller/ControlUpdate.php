<?php
    namespace controller;

    use model\ModelLink;
    require_once("../model/ModelLink.php");

    class ControlLink {

        public $name, $link, $id;
        public $error = "";

        public function __construct(){
            $this -> name = $_POST["name"];
            $this -> link = $_POST["link"];
            $this -> id = $_POST["id"];
        }

        public function update() {
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
                
                $result = $model -> update(
                    $this -> name,
                    $this -> link,
                    $this -> id
                );

                if($result != "") {
                    $_SESSION["links"] = $model -> read(
                        $_SESSION["user"]["email"]
                    );
                    $_SESSION["result"] = "Enlace Actualizado";  
                    header("Location: ../principal.php");
                } else {
                    $_SESSION["result"] = "El Enlace no Pudo Ser Actualizado";
                    header("Location: ControlForm.php?function=update");
                }
            } else {
                $_SESSION["result"] = $this -> error;
                header("Location: ControlForm.php?function=update");
            }
        }
        
    }

    $object = new ControlLink();
    $object -> update();
?>