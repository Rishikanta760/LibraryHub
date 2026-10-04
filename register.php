<?php
include("config.php");

$msg="";

if(isset($_POST['register']))
{
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $roll = $_POST['roll_no'];
    $dob  = $_POST['dob'];

    // Check if username already exists
    $check = mysqli_query($conn, "SELECT * FROM students WHERE username='$user'");

    if(mysqli_num_rows($check) > 0)
    {
        $msg = "Username already exists";
    }
    else
    {
        mysqli_query($conn, "INSERT INTO students(username,password,roll_no,dob) 
        VALUES('$user','$pass','$roll','$dob')");

        $msg = "Registration Successful";
    }
}
?>

<html>
<head>
<title>Student Registration</title>

<style>
body{
    background-image:url("librarybg.jpg");
    background-size:cover;
    font-family:arial;
}

.box{
    width:350px;
    background:rgba(255,255,255,0.9);
    padding:30px;
    margin:120px auto;
    text-align:center;
    border-radius:10px;
}

input{
    width:90%;
    padding:10px;
    margin:8px 0;
}

button{
    padding:10px 20px;
    background:green;
    color:white;
    border:none;
    cursor:pointer;
}

.msg{
    color:green;
    font-weight:bold;
}
</style>

</head>

<body>

<div class="box">

<h2>Student Registration</h2>

<p class="msg"><?php echo $msg; ?></p>

<form method="post">

<input type="text" name="username" placeholder="Username" required><br>

<input type="password" name="password" placeholder="Password" required><br>

<input type="text" name="roll_no" placeholder="Roll Number" required><br>

<input type="date" name="dob" required><br>

<button name="register">Register</button>

</form>

<br>

<a href="index.php">Back to Login</a>

</div>

</body>
</html>