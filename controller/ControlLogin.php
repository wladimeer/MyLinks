<?php
    namespace controller;

    use model\ModelUser;
    use model\ModelLink;

    require_once("../model/ModelUser.php");
    require_once("../model/ModelLink.php");

    class ControlLogin {
        
        public $email, $password;

        public function __construct(){
            $this -> email = $_POST["email"];
            $this -> password = $_POST["password"];
        }

        public function login() {
            $error = "";

            if($this -> email == "" && $this -> password == "") {
                $error = "Verifica los Campos";
            } else {
                if($this -> email == "") {
                    $error = "Verifica el Correo";
                }

                if($this -> password == "") {
                    $error = "Verifica la Contraseña";
                }
            }

            session_start();

            if($error == "") {
                $model = new ModelUser();

                $result = $model -> search(
                    $this -> email
                );
                
                if(count($result) == 1) {
                    if($result[0]["clave"] == md5($this -> password)) {
                        $model = new ModelLink();
                        
                        $_SESSION["user"] = $result[0];

                        $_SESSION["links"] = $model -> read(
                            $this -> email
                        );
                        
                        unset($_SESSION["result"]);
                        header("Location: ../principal.php");
                    } else {
                        $_SESSION["error"] = "La Contraseña Ingresada no es Valida";
                        header("Location: ../index.php");
                    }
                } else {
                    $_SESSION["error"] = "El Correo no se Encuentra Registrado";
                    header("Location: ../index.php");
                }
            } else {
                $_SESSION["error"] = $error;
                header("Location: ../index.php");
            }
        }

    }

    $object = new ControlLogin();
    $object -> login();
?>