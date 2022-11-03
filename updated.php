<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: upated.php");
}

require_once "config.php";
$myid =  $_SESSION['id'];

$email = $mobileno = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = trim($_POST['email']);
    $mobileno = trim($_POST['mobileno']);
    
    // If there were no errors, go ahead and insert into the database
   
    $sql = "UPDATE student SET mobileno = '$mobileno', email = '$email' WHERE stdid = '$myid'";
    $result = $conn->query($sql);

    echo "Updated !";

    $conn->close();
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Update Profile</title>
</head>

<body>

    <div class="container mt-4">
        <h3>Fill Details:</h3>
        <hr>
        <form action="" method="post">
            <div class="form-group col-md-6">
                <label for="inputPassword4">Mobile No</label>
                <input type="number" class="form-control" name="mobileno">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Email</label>
                <input type="email" class="form-control" name="email">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <hr>
    <a class="nav-link" href="logout2.php">Logout</a>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>