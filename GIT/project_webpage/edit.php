<?php
    $servername = "localhost";
    $username = "michal";
    $password = "123456789";
    $dbname = "mydb";

    $con = new mysqli($servername, $username, $password, $dbname);

    if ($con->connect_error) {
        die("Conection failed:". $con->connect_error);
    }


$id = $_GET['id'];

$qry = mysqli_query($con,"select * from user_data where id=$id");

$data = mysqli_fetch_array($qry);

if(isset($_POST['update']))
{
    $name = $_POST['fullname'];
    $surname = $_POST['second'];
    $title = $_POST['title'];
    $year_born = $_POST['year_born'];
    $gdpr = $_POST['gdpr'];
    $note = $_POST['note'];
    $state = $_POST['state'];


    $edit = mysqli_query($con,"update user_data set meno='$name', priezvisko = '$surname', title_id ='$title',
 rok_narodenia = '$year_born', suhlas='$gdpr', poznamka='$note', state_id='$state' WHERE id='$id'");

    if(!$edit) {
        echo mysqli_error();
    }
    else {
        mysqli_close($con);
        header("location:select.php");
        exit;
    }
}
?>
<html>
<head><link rel="stylesheet" href="style_insert.css"></head>
</html>
<h3>Update Data</h3>

<form method="POST">


    <label for="titul">Titul</label>
            <select name="title" id="title" value=" ?>">
                <option value="1" <?php if($data['title_id'] == 1){echo 'selected';} ?> >Ing.</option>
                <option value="2" <?php if($data['title_id'] == 2){echo 'selected';} ?> >Mgr.</option>
                <option value="3" <?php if($data['title_id'] == 3){echo 'selected';} ?> >Doc.</option>
                <option value="4" <?php if($data['title_id'] == 4){echo 'selected';} ?> >None</option>
                <option value="5" <?php if($data['title_id'] == 5){echo 'selected';} ?> >MUDr.</option>
            </select>
        <br>
    <label for="firstName">Meno</label>
    <input type="text" name="name" value="<?php echo $data['meno'] ?>" placeholder="Enter Full Name" Required>
    <br>
    <label for="Surname">Priezvisko</label>
    <input type="text" name="second" id="lastName" value="<?php echo $data['priezvisko'] ?>">
    <br>
    <label for="rokNarodenia">Rok Narodenia</label>
    <input type="text" name="year_born" id="rokNarodenia" value="<?php echo $data['rok_narodenia'] ?>">
    <br>
    <legend>Spracovanie osobných údajov</legend>

    <input type="radio" id="suhlas" name="gdpr" value="1" <?php if ($data['suhlas'] == 1) {echo 'checked';} ?> >
    <label for="suhlas">Áno</label>
    <input type="radio" id="suhlas_2" name="gdpr" value="0" <?php if ($data['suhlas'] == 0) {echo 'checked';} ?>>
    <label for="suhlas">Nie</label>
    <br>
    <label for="poznamka">Poznámka</label>
    <textarea name="note" id="poznamka" cols="30" rows="10" maxlength="255" ><?php echo $data['poznamka'] ?></textarea>
    <br>
    <label for="stat">Štát</label>
    <select name="state" id="stat" >
        <option value="1" <?php if($data['state_id'] == 1){echo 'selected';} ?> >Slovenská Republika</option>
        <option value="2" <?php if($data['state_id'] == 2){echo 'selected';} ?> >Česká Republika</option>
        <option value="3" <?php if($data['state_id'] == 3){echo 'selected';} ?> >Nemecko</option>
    </select>
    <br>
            <input type="submit" name="update" value="update">


</form>

