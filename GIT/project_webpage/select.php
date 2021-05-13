<?php
    $servername = "localhost";
    $username = "michal";
    $password = "123456789";
    $dbname = "mydb";
    $con=mysqli_connect($servername, $username, $password, $dbname);

    if (isset($_POST['save'])) {
        $checkbox = $_POST['check'];
        for ($i = 0; $i < count($checkbox); $i++) {
            $del_id = $checkbox[$i];
            mysqli_query($con,"DELETE FROM user_data WHERE id='".$del_id."'");
            $message = "Data deleted sucesfully";
        }
    }

    $result = mysqli_query($con, "SELECT user_data.id, concat(user_data.meno, ' ', user_data.priezvisko)as Name, rok_narodenia, IF(suhlas = 0, 'N', 'A') 'suhlas', poznamka, title, country 
FROM user_data INNER JOIN states ON user_data.state_id=states.id INNER JOIN titles ON user_data.title_id=titles.id ;");
?>

<html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
    <div>
        <?php if (isset($message)) {echo $message;} ?>
    </div>

    <form action="" method="post">
        <table class="table table_bordered">
            <thead>
            <tr>
                <th><input type="checkbox" id="checkAl"> Select All</th>
                <th>ID</th>
                <th>Titul</th>
                <th>Meno a  Priezvisko</th>
                <th>rok narodenia</th>
                <th>Súhlas</th>
                <th>Štát</th>
                <th>Poznámka</th>
            </tr>
            </thead>

            <?php
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {

            ?>
            <tr>
                <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row["id"]; ?>"></td>
                <td><?php echo $row["id"]; ?></td>
                <td> <?php echo $row["title"]; ?></td>
                <td><a href="edit.php?id=<?php echo $row['id']; ?>"><?php echo $row["Name"]; ?> </a></td>
                <td><?php echo $row["rok_narodenia"]; ?></td>
                <td><?php echo $row["suhlas"]; ?></td>
                <td><?php echo $row["country"]; ?></td>
                <td><?php echo $row["poznamka"]; ?></td>
            </tr>

            <?php
            $i++;
            }
            ?>
        </table>
        <p align="center"><button type="submit" class="btn btn-success" name="save">DELETE</button></p>
    </form>

    <script>
        $("#checkAl").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>

    </body>
</html>
