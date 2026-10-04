<?php
include("config.php");
admin_only();

$id=$_GET['id'] ?? '';
$id=mysqli_real_escape_string($conn,$id);

mysqli_query($conn,"DELETE FROM books WHERE book_id='$id'");
?>

<!DOCTYPE html>
<html>
<head>

<title>Delete Book</title>

<style>

body{
background-image:url("librarybg.jpg");
background-size:cover;
background-position:center;
font-family:Arial;
}

/* message box */

.box{
width:350px;
background:rgba(255,255,255,0.9);
padding:30px;
margin:150px auto;
border-radius:10px;
text-align:center;
box-shadow:0 0 15px gray;
}

button{
padding:10px 20px;
background:#e74c3c;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#c0392b;
}

</style>

</head>

<body>

<div class="box">

<h2>Book Deleted Successfully</h2>

<a href="viewbook.php">
<button>Back to Book List</button>
</a>

</div>

</body>
</html>
