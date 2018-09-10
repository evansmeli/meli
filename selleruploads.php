
<?php
$msg="";
if(isset($_POST['add'])){
$target="images/".basename($_FILES['image']['name']);
$target="images/".basename($_FILES['imagever']['name']);
$type=$_POST["proptype"];
$propname=$_POST['propname'];
$proploc=$_POST['proploc'];
$price=$_POST['price'];
$number=$_POST['number'];
$image=$_FILES['image']['name'];
$imagever=$_FILES['imagever']['name'];
define('host','127.0.0.1');
define('username', 'root');
define('password', '');
define('dbname', 'realestate');

$conn=new mysqli(host, username, password, dbname);	
$insert ="INSERT INTO `realestate` (`type`,`propname`,`proploc`,`price`,`number`,`image`,`imagever`)VALUES('$type','$propname','$proploc','$price','$number','$image','$imagever')";
$result=$conn->query($insert); 
if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
	$msg="image uploaded successfully";
echo "<script type='text/javascript'>alert('$msg');</script>";
}
else{
	$msg="there was a problem uploading your image";
	echo "<script type='text/javascript'>alert('$msg');</script>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="../dhis2/resource/jquery.min.js"></script>
	<title></title>
	<style type="text/css">
#frm{
border:solid gray 1px;
width:40%;
height: 40%;
border-radius:5px;
margin:50px auto;
background:green;
padding:80px;

}
#btn{
color:#fff;
background:#337ab7;
padding:1px;
margin-left:70%;
}
body{
	background-color: #e5e4d7;
}
</style>	
</head>
</body>
</html>
<body>
	<div id="frm">
<form action="selleruploads.php" method="post" enctype="multipart/form-data">
Property Type:<select name="proptype">
		<option name="rentals">Houses To let</option>
		<option name="Land">Land</option>
		<option name="housesforsale">Houses for sale</option>
	</select>
	<br><br>
Property Name<input type="text" name="propname"><br><br>
Location:<input type="text" name="proploc"><br><br>
Price<input type="text" name="price"><br><br>
Number:<input type="text" name="number"><br><br>
Property Image<input type="file" name="image"><br><br>
Property Document<input type="file" name="imagever"><br><br>
<input type="submit" name="add" value="Add">
</form>
</div>
</body>
</html>/ml