<?php
    include("config.php");
    session_start();
    $error = 0;
    if (!(isset($_SESSION['type']) && $_SESSION['type']==1)){
        $_SESSION = array();
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Menu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="alert.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <br>
        <div>
            <form  action = "newService.php" method="POST">
                <button type="submit" class="btn btn-primary col">Nuevo Servicio</button>
            </form>
        </div>
        <br>
        <div>
            <form  action = "history.php" method="POST">
                <button type="submit" class="btn btn-success col">Historial</button>
            </form>
        </div>
        <br>
        <div>
            <form  action = "login.php" method="POST">
                <button type="submit" class="btn btn-primary col">Salir</button>
            </form>
        </div>
    </div>
</body>
</html>
