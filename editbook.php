<?php
include("config.php");
admin_only();

$id=$_GET['id'] ?? '';

$id=mysqli_real_escape_string($conn,$id);
$result=mysqli_query($conn,"SELECT * FROM books WHERE book_id='$id'");
$row=mysqli_fetch_array($result);

if(isset($_POST['update']))
{

$name=$_POST['name'];
$author=$_POST['author'];

mysqli_query($conn,"UPDATE books 
SET book_name='$name', author='$author'
WHERE book_id='$id'");

header("location:viewbook.php");

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Book | LibraryHub</title>

<link rel="stylesheet" href="assets/style.css">

<style>

body{
background:#f7f8fc;
}

/* form card */

.box{
width:400px;
background:white;
padding:30px;
margin:120px auto;
border-radius:10px;
text-align:center;
box-shadow:0 0 15px gray;
}

input{
width:90%;
padding:10px;
margin:10px;
border:1px solid #ccc;
border-radius:5px;
}

button{
padding:10px 20px;
background:#3498db;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#2980b9;
}

</style>

</head>

<body>

<div class="box">

<h2>Edit Book</h2>

<a href="viewbook.php" class="backbtn">← Back to catalog</a>

<form method="post">

<input type="text" name="name" required value="<?php echo e($row['book_name']); ?>">

<input type="text" name="author" required value="<?php echo e($row['author']); ?>">

<br>

<button name="update">Update Book</button>

</form>

</div>

</body>
</html>
