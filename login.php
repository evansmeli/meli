<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php
if(isset($_POST['login'])){
   if(!empty($_POST['username']) && !empty($_POST['password'])){
$username=$_POST['username'];
$password=$_POST['password'];
//to prevent mysql injection
$username=stripcslashes($username);
$password=stripcslashes($password);
mysql_connect("localhost","root","");
mysql_select_db("realestate");
$result=mysql_query("SELECT * FROM users WHERE username='$username' && password='$password'")
or die("Failed to query database".mysql_error());
$row =mysql_fetch_array($result);
if($row['username']==$username && $row['password']==$password && $row['type']=='buyer')
{
   $_SESSION["name"]=$username;
   $_SESSION["message"]="Login Succesful";
 header("Location:buyer.php");
}
else if($row['username']==$username && $row['password']==$password && $row['type']=='seller')
{
   $_SESSION["name"]=$username;
   $_SESSION["message"]="Welcome"+$username+"You can now post Your Property";
 header("Location:selleruploads.php");
}
else{
$sms="password or username incorrect";
  echo "<script type='text/javascript'>alert('$sms');</script>";
 
}
}
else{
   $_SESSION["message"]="Please fill ALL fields to continue";
    header("location:login.php");
 die();
}
}
?>
<html>
<head>
  <script type="text/javascript" href="userverify.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
   <script href="resources/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.min.css">
	<script type="text/javascript" src="resources/js/bootstrap.min.js"></script>
	<title></title>
	<style type="text/css">
.frm{
border:solid gray 1px;
width:40%;
border-radius:5px;
margin:100px auto;
padding:5px;
background-image:url("images/pex.jpeg");
}
	</style>
</head>
<body>

	<?php
if(isset($message)) {
echo $message;
}
?>
	<div class="frm">
	<form name ="myform" method="post" action="login.php">
		<div class="form-group">
      <label for="username" class="col-sm-2 control-label">Username</label>
      <div class="col-sm-10">
         <input type="email" class="form-control" name="username" 
            placeholder="Enter email">
      </div>
   </div>
   <div class="form-group">
      <label for="password" class="col-sm-2 control-label">password</label>
      <div class="col-sm-10">
         <input type="password" class="form-control" name="password" 
            placeholder="Enter Your password">
      </div>
   </div>
	<div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <div class="checkbox">
            <label>
               <input type="checkbox"> Remember me
            </label>
         </div>
      </div>
   </div>

   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <span class="glyphicon glyphicon-envelope"></span><button type="submit"  name="login" class="btn btn-default" >Sign in</
         </button> 
      </div>
   </div>
     <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <a href="registration.php">Register</a>
      </div>
   </div>
	</form>
</div>
<div id="error"></div>
</body>
</html>
