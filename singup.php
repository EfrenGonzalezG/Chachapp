<?php
    include("config.php");
    session_start();
    $_SESSION = array();
    $error = 0;
    if($_SERVER["REQUEST_METHOD"] == "POST"
            && isset($_POST['name'])
            && isset($_POST['mail'])
            && isset($_POST['password'])
            && isset($_POST['phone'])
            && isset($_POST['address'])
            && isset($_POST['type'])
            ) {
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $mail = mysqli_real_escape_string($db, $_POST['mail']);
        $password = mysqli_real_escape_string($db, $_POST['password']); 
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $type = mysqli_real_escape_string($db, $_POST['type']);
        $sql = "SELECT * FROM user WHERE mail = '$mail';";
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) > 0){
            $error = 1;
            $messageError = "Ya existe el correo";
        }
        if ($error == 0){
            $sql = "INSERT INTO user (id, mail, password, name, phone, address, type)
                    VALUES (NULL, '$mail', '$password', '$name', '$phone', '$address', '$type');";
            if (mysqli_query($db, $sql)) {
                mysqli_close($db);
                header("location: login.php");
            } else {
                $error = 1;
                $messageError = "Error: " . $sql . "<br>" . mysqli_error($db);
            }
        }
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Crear Cuenta</title>
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
        <?php
            if ($error == 1) {
                echo '
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
                        <strong>Error</strong> '.$messageError.
                    '</div>';
            }
        ?>
        <br>
        <h2 class="text-center">Registro</h2>
        <form  action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="mail">Correo:</label>
                <input type="mail" class="form-control" id="mail" name="mail" required>
            </div>
            <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="phone">Telefono:</label>
                <input type="number" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="phone">Direccion:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="type">Tipo:</label>
                <select class="form-control" id="type" name="type">
                    <option value='1'>Cliente</option>
                    <option value='2'>Socio</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary col-12">Crear Cuenta</button>
        </form>
    </div>
</body>
</html>