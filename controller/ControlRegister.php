<?php
    namespace controller;

    use model\ModelUser;
    require_once("../model/ModelUser.php");

    class ControlRegister {

        public $name, $email, $password;

        public function __construct(){
            $this -> name = $_POST["name"];
            $this -> email = $_POST["email"];
            $this -> password = $_POST["password"];
        }

        public function register() {
            $error = "";

            if($this -> name == "" && $this -> email == "" && $this -> password == "") {
                $error = "Verifica los Campos";
            } else {
                if($this -> name == "") {
                    $error = "Verifica el Nombre". "<br>";
                }

                if($this -> email == "") {
                    $error .= "Verifica el Correo". "<br>";
                }

                if($this -> password == "") {
                    $error .= "Verifica la Contraseña";
                }
            }

            session_start();

            if($error == "") {
                $model = new ModelUser();

                $user = [
                    "name" => $this -> name,
                    "email" => $this -> email,
                    "password" => $this -> password
                ];

                $result = $model -> create($user);

                if($result != "") {
                    $_SESSION["result"] = "Usuario Registrado con Exito";
                } else {
                    $_SESSION["error"] = "El Correo ya se Encuentra Registrado";
                }
            } else {
                $_SESSION["error"] = $error;
            }

            header("Location: ../register.php");
        }
        
    }

    $object = new ControlRegister();
    $object -> register();
?>