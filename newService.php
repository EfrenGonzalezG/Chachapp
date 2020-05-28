<?php
    include("config.php");
    session_start();
    $error = 0;
    if (!(isset($_SESSION['type']) && $_SESSION['type']==1)){
        $_SESSION = array();
        header("location: login.php");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" 
            && isset($_POST['name'])
            ){
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $amount = mysqli_real_escape_string($db, $_POST['amount']);
        $idClient = mysqli_real_escape_string($db, $_SESSION['id']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $time = mysqli_real_escape_string($db, $_POST['time']);
        $idCleaner = mysqli_real_escape_string($db, -1);
        $score = mysqli_real_escape_string($db, -1);
        $sql = "INSERT INTO task (id, address, amount, idClient, name, phone, time, idCleaner, score)
        VALUES (NULL, '$address', '$amount', '$idClient', '$name', '$phone', '$time', '$idCleaner', '$score');";
        if (mysqli_query($db, $sql)) {
            $sql = "SELECT MAX(id) FROM task WHERE idClient = $idClient";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_assoc($result);
            $id = $row['MAX(id)'];
            for ($i = 0; $i<count($_FILES["images"]["tmp_name"]); $i++){
                $image_file = addslashes(file_get_contents($_FILES["images"]["tmp_name"][$i]));
                $sql = "INSERT INTO image (id, idTask, image) VALUES (NULL, '$id', '$image_file');";
                mysqli_query($db, $sql);
            }
            mysqli_close($db);
            header("location: menuClient.php");
        }
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
        <h2 class="text-center">Servicio</h2>
        <form  action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
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
                <label for="phone">Cantidad:</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>
            <div class="form-group">
                <label for="time">Fecha:</label>
                <input type="datetime-local" class="form-control" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="date">Imagenes:</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple accept=".jpg, .png" required>
            </div>
            <button type="submit" class="btn btn-primary col-12">Solicitar</button>
        </form>
        <br>
        <div>
            <form  action = "menuClient.php" method="POST">
                <button type="submit" class="btn btn-primary col">Salir</button>
            </form>
        </div>
    </div>
</body>
</html>
