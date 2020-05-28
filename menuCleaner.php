<?php
    include("config.php");
    session_start();
    $error = 0;
    if (!(isset($_SESSION['type']) && $_SESSION['type']!=1)){
        $_SESSION = array();
        header("location: login.php");
    }
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE id = $id;";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $phone = $row['phone'];
    $count = 0;
    $money = 0;
    $score = 0;
    $sql = "SELECT * FROM task WHERE idCleaner = $id;";
    $result = mysqli_query($db, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $money += $row['amount'];
        if ($row['score'] == -1) $score += 10;
        else $score += $row['score'];
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
        <h2> Información </h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Servicios Completados</th>
                    <th>Puntaje</th>
                    <th>Dinero Acumulado</th>
                </tr>
                <tbody>
                    <td><?php echo $name;?></td>
                    <td><?php echo $phone;?></td>
                    <td><?php echo $count;?></td>
                    <td><?php echo $score;?></td>
                    <td><?php echo $money;?></td>
                </tbody>
            </thead>
        </table>
        <br>
        <h2> Servicios Disponibles </h2>
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
                $sql = "SELECT * FROM task WHERE idCleaner = -1;";
                $result = mysqli_query($db, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    echo 
                        '<tr>'.
                            '<td>'.$row["address"].'</td>'.
                            '<td>'.$row["time"].'</td>'.
                            '<td>'.
                                '<form  action = "select.php" method="POST">'.
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
        <h2> Servicios Completados </h2>
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
                $id = $_SESSION['id'];
                $sql = "SELECT * FROM task WHERE idCleaner = $id;";
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

        <div>
            <form  action = "login.php" method="POST">
                <button type="submit" class="btn btn-primary col">Salir</button>
            </form>
        </div>
    </div>
</body>
</html>
