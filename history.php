<?php
    include("config.php");
    session_start();
    $error = 0;
    if (!(isset($_SESSION['type']) && $_SESSION['type']==1)){
        $_SESSION = array();
        header("location: login.php");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"
            && isset($_POST['idTask'])
            ){
        $id = $_POST['idTask'];
        $sql = "DELETE FROM task WHERE id = $id;";
        mysqli_query($db, $sql);
    }
    /*$sql = "SELECT * FROM image;";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="col-md-2" style="margin-bottom:16px;">
                <img src="data:image/jpeg;base64,'.base64_encode($row["image"]).'" class="img-thumbnail" />
            </div>
            ';       
        }
    }*/
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
        <h2> Servicios pendientes </h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Dirección</th>
                    <th>Fecha</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM task WHERE idCleaner = -1;";
                $result = mysqli_query($db, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    echo 
                        '<tr>'.
                            '<td>'.$row["address"].'</td>'.
                            '<td>'.$row["time"].'</td>'.
                            '<td>'.
                                '<form  action = "history.php" method="POST">'.
                                    '<input type="hidden" id="idTask" name="idTask" value="'.$row['id'].'">'.
                                    '<button type="submit" class="btn btn-success col">  Eliminar  </button>'.
                                '</form>'.
                            '</td>'.
                        '</tr>';
                }
                ?>
            </tbody>
        </table>
        <br>
        <h2> Servicios sin calificación </h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Dirección</th>
                    <th>Fecha</th>
                    <th>Calificar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM task WHERE idCleaner != -1 AND score = -1;";
                $result = mysqli_query($db, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    echo 
                        '<tr>'.
                            '<td>'.$row["address"].'</td>'.
                            '<td>'.$row["time"].'</td>'.
                            '<td>'.
                                '<form  action = "review.php" method="POST">'.
                                    '<input type="hidden" id="idTask" name="idTask" value="'.$row['id'].'">'.
                                    '<button type="submit" class="btn btn-success col">  Calificar  </button>'.
                                '</form>'.
                            '</td>'.
                        '</tr>';
                }
                ?>
            </tbody>
        </table>
        <br>
        <h2> Servicios pasados </h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Dirección</th>
                    <th>Fecha</th>
                    <th>Ver más</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM task WHERE idCleaner != -1 AND score != -1;";
                $result = mysqli_query($db, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    echo 
                        '<tr>'.
                            '<td>'.$row["address"].'</td>'.
                            '<td>'.$row["time"].'</td>'.
                            '<td>'.
                                '<form  action = "viewTask.php" method="POST">'.
                                    '<input type="hidden" id="idTask" name="idTask" value="'.$row['id'].'">'.
                                    '<button type="submit" class="btn btn-success col">  Ver más  </button>'.
                                '</form>'.
                            '</td>'.
                        '</tr>';
                }
                ?>
            </tbody>
        </table>
        <br>
        <div>
            <form  action = "menuClient.php" method="POST">
                <button type="submit" class="btn btn-primary col">Salir</button>
            </form>
        </div>
    </div>
</body>
</html>
