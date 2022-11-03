<?php
require_once "config.php";

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT stdid FROM student WHERE stdid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);

    // Check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } else {
        $password = trim($_POST['password']);
    }

    // If there were no errors, go ahead and insert into the database
    if (empty($username_err) && empty($password_err)) {
        $sql = "INSERT INTO student (stdid, password,stdname,age,department,mobileno,email,doj) VALUES (?, ? ,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssisiss", $param_username, $param_password,$param_stdname,$param_age,$param_dept,$param_mobile,$param_email,$param_doj);
            //,$param_age,$param_dept,$param_mobile,$param_email
            // Set these parameters
            $param_username = $username;
            $param_password = $password;
            $param_stdname=$_POST['stdname'];
            $param_doj=$_POST['doj'];
            $param_age=$_POST['age'];
            $param_dept=$_POST['department'];
            $param_mobile=$_POST['mobileno'];
            $param_email=$_POST['email'];

            // Try to execute the query
            if (mysqli_stmt_execute($stmt)) {
                echo "User Added !";
            } else {
                echo "Something went wrong...!";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}

?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Registartion</title>
</head>

<body>

    <div class="container mt-4">
        <h3>Please Register Here:</h3>
        <hr>
        <form action="" method="post">

            <div class="form-group col-md-6">
                <label for="inputEmail4">Student ID </label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Name</label>
                <input type="text" class="form-control" name="stdname">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Date of Joining</label>
                <input type="date" class="form-control" name="doj">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Age</label>
                <input type="number" class="form-control" name="age">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Department</label>
                <input type="text" class="form-control" name="department">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Mobile No</label>
                <input type="number" class="form-control" name="mobileno">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Email</label>
                <input type="email" class="form-control" name="email">
            </div>

            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>
    <hr>
    <a class="nav-link" href="login.php">Login</a>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>