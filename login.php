<?php
    include("config.php");
    session_start();
    $_SESSION = array();
    $error = 0;
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mail']) && isset($_POST['password']) ) {
        $mail = mysqli_real_escape_string($db, $_POST['mail']);
        $password = mysqli_real_escape_string($db, $_POST['password']); 
        $sql = "SELECT * FROM user WHERE mail = '$mail' and password = '$password'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        if($count == 1) {
            $_SESSION['user'] = $user;
            $_SERVER['type'] = $row['type'];
            mysqli_close($db);
            if ($_SESSION['type'] == 1) header("location: menuClient.php");
            else header("location: menuCleaner.php");
        }
        else { 
            $error = 1;
        }
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
        <br></br>
        <?php
            if ($error == 1) {
                echo '
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
                        <strong>Error</strong> Usuario o contraseña incorrecto.
                    </div>';
            }
        ?>
        <h2 class="text-center">Iniciar Sesion</h2>
        <form  action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <div class="form-group">
                <label for="user">Usuario:</label>
                <input type="text" class="form-control" id="mail" name="mail" required>
            </div>
            <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary col-12">Iniciar Sesion</button>
        </form>
        <br>
        <form  action = "singup.php" method="POST">
            <button type="submit" class="btn btn-primary col-12">Crear Cuenta</button>
        </form>
    </div>
</body>
</html>
