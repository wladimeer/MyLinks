<?php
    namespace controller;

    use model\ModelLink;
    require_once("../model/ModelLink.php");

    class ControlForm {
        
        public $operation;

        public function __construct(){
            $this -> operation = $_GET["function"];
        }
        
        public function redirect() {
            session_start();
            
            $model = new ModelLink();

            if($this -> operation == "create") {
                $_SESSION["code"] = ('
                    <form action="controller/ControlCreate.php" class="content__form" method="post">
                        <div class="inputs">
                            <label class="content__label">Nombre:</label>
                            <input type="text" name="name" class="content__input">
                        </div>

                        <div class="inputs">
                            <label class="content__label">Enlace:</label>
                            <input type="text" name="link" class="content__input">
                        </div>

                        <div class="function">
                            <button name="button" class="function__button">Añadir</button>
                        </div>
                    </form>
                ');

                header("Location: ../principal.php");
            } else if($this -> operation == "update") {
                $link = $model -> search($_GET["id"]);
                
                $_SESSION["code"] = ('
                    <form action="controller/ControlUpdate.php" class="content__form" method="post">
                        <input type="hidden" name="id" value='.$link[0]["id"].'>
                    
                        <div class="inputs">
                            <label class="content__label">Nombre:</label>
                            <input type="text" name="name" class="content__input" value='.$link[0]["nombre"].'>
                        </div>

                        <div class="inputs">
                            <label class="content__label">Enlace:</label>
                            <input type="text" name="link" class="content__input" value='.$link[0]["link"].'>
                        </div>

                        <div class="content__function">
                            <button name="button" class="function__button">Actualizar</button>
                        </div>
                    </form>
                ');

                header("Location: ../principal.php");
            } else if($this -> operation == "delete") {
                header("Location: ControlDelete.php?id=".$_GET["id"]."");
            }
        }

    }

    $object = new ControlForm();
    $object -> redirect();
?>