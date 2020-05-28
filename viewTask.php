<?php
    include("config.php");
    session_start();
    $error = 0;
    if (!(isset($_SESSION['type']))){
        $_SESSION = array();
        header("location: login.php");
    }
    if ($_SESSION['type'] == 1) $menu = 'history.php';
    else $menu = 'menuCleaner.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"
            && isset($_POST['idTask'])
            ){
        $idTask = $_POST['idTask'];
        $_SESSION['idTask'] = $idTask;
        $sql = "SELECT * FROM task WHERE id = $idTask";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
    }

    $id = $row['idCleaner'];
    $sql = "SELECT * FROM user WHERE id = $id;";
    $result = mysqli_query($db, $sql);
    $row2 = mysqli_fetch_assoc($result);

    $name = $row2['name'];
    $phone = $row2['phone'];
    $count = 0;
    $money = 0;
    $score = 0;
    $sql = "SELECT * FROM task WHERE idCleaner = $id;";
    $result = mysqli_query($db, $sql);
    while($row2 = mysqli_fetch_assoc($result)){
        $count++;
        $money += $row2['amount'];
        if ($row2['score'] == -1) $score += 10;
        else $score += $row2['score'];
    }
    $score /= $count;

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
        <h2> Información </h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Servicios Completados</th>
                    <th>Puntaje</th>
                </tr>
                <tbody>
                    <td><?php echo $name;?></td>
                    <td><?php echo $phone;?></td>
                    <td><?php echo $count;?></td>
                    <td><?php echo $score;?></td>
                </tbody>
            </thead>
        </table>
        <br>
        <h2 class="text-center">Servicio</h2>
        <form  action = "<?php echo $menu;?>" method="POST" enctype="multipart/form-data">
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
                        while($row2 = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="col-md-2" style="margin-bottom:16px;">
                                <img src="data:image/jpeg;base64,'.base64_encode($row2["image"]).'" class="img-thumbnail" />
                            </div>
                            ';
                        }
                    }
                ?>
            </div>
            <div class="form-group">
                <label for="score">Calificación:</label>
                <input type="range" class="form-control-range" id="score" name="score" min="0" max="10" disabled value="<?php echo $row["score"];?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Comentarios:</label>
                <textarea class="form-control" id="review" name="review" rows="3" disabled><?php echo $row['review'];?></textarea>
            </div>
            <button type="submit" class="btn btn-primary col-12">Regresar</button>
        </form>
    </div>
</body>
</html>
