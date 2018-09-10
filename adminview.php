<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
<script src="resources/js/bootstrap.min.js"></script>
 <script src="/resources/js/jquery.min.js"></script>
    <title></title>
    <style type="text/css">
        .user-img{width:40px;float:left;position:relative;margin:0 10px 15px 0}
    </style>
</head>
<body>

</body>
</html>

<?php

//include('resources.html');

require_once('dbconn.php');

$query = "SELECT * FROM realestate";
$results = @mysqli_query($conn, $query);

if ($results) {

echo '<table   class="table table-striped table-hover table-responsive">

    <tr>
        <td>Type</td>
        <td> Property Name</td>
        <td> Property Location</td>
        <td>price</td>
        <td>number</td>
        <td>photo</td>
        <td>Edit</td>
        <td>Delete</td>
    </tr>
';

while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){

    echo '<tr>
    <td>'. $row['type'] .'</td>
    <td>'. $row['propname'] .'</td>
    <td>'. $row['proploc'] .'</td>
    <td>'. $row['price'] .'</td>
    <td>'. $row['number'] .'</td>
   <td><div class="user-img"><img  alt="Avatar" width="40px" height="40px" src="images/'. $row['image'] .'"></div></td>
    <td><a href="update.php?id=' .$row['id']. '">Edit</a></td>
    <td><a href="delete.php?id=' .$row['id']. '">Delete</a></td>
    </tr>
';

}
}
else{
	echo "unsuccessful".mysqli_error($conn);
}

?>