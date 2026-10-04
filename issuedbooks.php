<?php
session_start();
include("config.php");

// ✅ Admin sees ALL records (NO WHERE condition)
$result = mysqli_query($conn, "SELECT * FROM issue_book");
?>

<!DOCTYPE html>
<html>
<head>
<title>All Issued Books (Admin)</title>

<style>
body{
    background-image:url('librarybg.jpg');
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    font-family:Arial;
}

.box{
    width:1000px;
    background:rgba(255,255,255,0.9);
    padding:30px;
    margin:50px auto;
    border-radius:10px;
    box-shadow:0 0 15px gray;
}

h2{
    text-align:center;
}

/* table */
table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#2c3e50;
    color:white;
    padding:10px;
}

td{
    padding:10px;
    border:1px solid #ccc;
    text-align:center;
}

tr:nth-child(even){
    background:#f2f2f2;
}

.status-issued{
    color:red;
    font-weight:bold;
}

.status-returned{
    color:green;
    font-weight:bold;
}

button{
    padding:8px 15px;
    background:#3498db;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}
</style>
</head>

<body>

<div class="box">
<h2>All Issued and Returned Books (Admin)</h2>

<table>
<tr>
<th>Book ID</th>
<th>Student Name</th>
<th>Issue Date</th>
<th>Return Date</th>
<th>Status</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
    $status = $row['return_date'] ? "Returned" : "Issued";

    echo "<tr>
    <td>".$row['book_id']."</td>
    <td>".$row['student_name']."</td>
    <td>".$row['issue_date']."</td>
    <td>".$row['return_date']."</td>
    <td>";

    if($status == "Returned")
        echo "<span class='status-returned'>Returned</span>";
    else
        echo "<span class='status-issued'>Issued</span>";

    echo "</td></tr>";
}
?>

</table>

<br>

<center>
<a href="admin_dashboard.php">
<button>Back to Dashboard</button>
</a>
</center>

</div>

</body>
</html>