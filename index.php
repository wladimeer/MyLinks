<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="icon/icon_link.svg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <title>Mis Enlaces</title>
</head>
<body>
    <div class="container">
        <div class="allContent">
            <header class="header">
                <div class="header__title">
                    <h1 class="header__h1">Mis Enlaces</h1>
                </div>

                <div class="header__function">
                    <h4 class="header__h4">Guarda tus Páginas Web</h4>
                </div>
            </header>

            <section class="content">
                <form action="controller/ControlLogin.php" class="content__form" method="post">
                    <div class="inputs">
                        <label class="content__label">Correo:</label>
                        <input type="email" name="email" class="content__input">
                    </div>

                    <div class="inputs">
                        <label class="content__label">Contraseña:</label>
                        <input type="password" name="password" class="content__input">
                    </div>

                    <div class="function">
                        <button class="function__button">Iniciar Sesión</button>
                    </div>
                </form>
            </section>

            <section class="register">
                <span class="register__span">
                    <a href="register.php" class="register__a label__a">¿No tienes una cuenta? Registrate aquí</a>
                </span>
            </section>

            <section class="result">
                <p class="result__success">
                    <?php
                        session_start();

                        if(isset($_SESSION["result"])) {
                            echo $_SESSION["result"];
                        }

                        unset($_SESSION["result"]);
                    ?>
                </p>

                <p class="result__error">
                    <?php
                        if(isset($_SESSION["error"])) {
                            echo $_SESSION["error"];
                        }

                        unset($_SESSION["error"]);
                    ?>
                </p>
            </section>
        </div>
    </div>
</body>
</html>