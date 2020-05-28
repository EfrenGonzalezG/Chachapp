<?php
    include("config.php");
    session_start();
    $error = 0;
    if (!(isset($_SESSION['type']) && $_SESSION['type']!=1)){
        $_SESSION = array();
        header("location: login.php");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"
            && isset($_POST['idTask'])
            ){
        $idTask = $_POST['idTask'];
        $_SESSION['idTask'] = $idTask;
        $sql = "SELECT * FROM task WHERE id = $idTask";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"
            ){
        $id = $_SESSION['idTask'];
        $idCleaner = $_SESSION['id'];
        $sql = "UPDATE task SET 
            idCleaner = '$idCleaner' WHERE id = '$id';";
        echo $sql;
        mysqli_query($db, $sql);
        header("location: menuCleaner.php");
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
        <form  action = "select.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" disabled value="<?php echo $row['name'];?>">
            </div>
            <div class="form-group">
                <label for="phone">Telefono:</label>
                <input type="number" class="form-control" id="phone" name="phone" disabled value=<?php echo $row['phone'];?>>
            </div>
            <div class="form-group">
                <label for="phone">Direccion:</label>
                <input type="text" class="form-control" id="address" name="address" disabled value=<?php echo $row['address'];?>>
            </div>
            <div class="form-group">
                <label for="phone">Cantidad:</label>
                <input type="number" class="form-control" id="amount" name="amount" disabled value=<?php echo $row['amount'];?>>
            </div>
            <div class="form-group">
                <label for="time">Fecha:</label>
                <input type="text" class="form-control" id="time" name="time" disabled value="<?php echo $row['time'];?>">
            </div>
            <div class="form-group">
                <label for="date">Imagenes:</label>
                <?php
                    $sql = "SELECT * FROM image WHERE idTask = $idTask;";
                    $result = mysqli_query($db, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="col-md-2" style="margin-bottom:16px;">
                                <img src="data:image/jpeg;base64,'.base64_encode($row["image"]).'" class="img-thumbnail" />
                            </div>
                            ';
                        }
                    }
                ?>
            </div>
            <button type="submit" class="btn btn-primary col-12">Seleccionar</button>
        </form>
        <br>
        <div>
            <form  action = "menuCleaner.php" method="POST">
                <button type="submit" class="btn btn-primary col">Salir</button>
            </form>
        </div>
    </div>
</body>
</html>
