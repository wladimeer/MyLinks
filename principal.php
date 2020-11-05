<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="icon/icon_link.svg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <title>Principal</title>
</head>
<body>
    <div class="container">
        <div class="allContent">
            <header class="header">
                <div class="header__title">
                    <h1 class="header__h1">Mis Enlaces</h1>
                </div>

                <div class="header__function">
                    <div class="header__operation operation--new">
                        <a href="controller/ControlForm.php?function=create" class="header__a label__a">Nuevo Enlace</a>
                    </div>

                    <div class="header__operation operation-signoff">
                        <a href="controller/ControlSignOff.php" class="header__a label__a">Cerrar Sesión</a>
                    </div>
                </div>
            </header>

            <section class="content">
                <?php
                    session_start();

                    if(isset($_SESSION["code"])) {
                        echo $_SESSION["code"];
                    } else {
                        echo (
                            '<h3 class="content__h3">
                                Selecciona una Operación
                            </h3>'
                        );
                    }

                    unset($_SESSION["code"]);  
                ?>
            </section>

            <section class="result">
                <p class="result__success">
                        <?php
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

            <section class="table">
                <table class="table__content" border>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Enlace</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($_SESSION["links"]) >  0) { ?>
                            <?php foreach($_SESSION["links"] as $item) { ?>
                                <tr>
                                    <td><?= $item["nombre"] ?></td>
                                    <td><?= $item["link"] ?></td>
                                    <td><a href="controller/ControlForm.php?function=delete&id=<?= $item["id"] ?>">Eliminar</a></td>
                                    <td><a href="controller/ControlForm.php?function=update&id=<?= $item["id"] ?>">Actualizar</a></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                            
                        <?php if(count($_SESSION["links"]) == 0) { ?>
                            <tr>
                                <td class="table__td" colspan="4">No Hay Enlaces para Mostrar</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>