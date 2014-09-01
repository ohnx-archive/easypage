<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Please login"');
    header('HTTP/1.0 401 Unauthorized');
echo <<<FIN
<html>
<head>
<title>Unauthorized</title>
<link href='base.css' rel='stylesheet' type='text/css' />
</head>
<body>
<div>
Sorry, you're not allowed here.
Please go to <a href="./">here</a>
</div>
</body>
</html>
FIN;
exit;
} else {
include("settings.php");
if(true||($user==$_SERVER['PHP_AUTH_USER'])&&($passwd==$_SERVER['PHP_AUTH_PW'])){
} else {
echo <<<FIN
<html>
<head>
<title>Unauthorized</title>
<link href='base.css' rel='stylesheet' type='text/css' />
</head>
<body>
<div>
Sorry, you're not allowed here.
Please go to <a href="./">here</a>
</div>
</body>
</html>
FIN;
exit;
}
}
//The user has been sucessfully authenticated, continue on to do stuff
?>
<html>
<head>
<title>Kontrol Panel</title>
<link href='base.css' rel='stylesheet' type='text/css' />
</head>
<body>
<div>
<h1>Welcome to the Kontrol Panel</h1>
<span class="focus">Here you can edit files, and create new ones.</span>
<?php
if(!isset($_REQUEST['option'])){
?>
<h2>Edit or delete existing files</h2>
<!-- Yeah, I'm actually using a TABLE here, but it's  a logical use for it, in my opinion :3 -->
<table align="center" style="font-size:1em;">
<tr style="background-color:gray;color:white;font-style:bold;">
<td>Filename</td>
<td>Edit</td>
<td>Delete</td>
</tr>
<?php
$arr = array_diff(scandir('./files'), array('..', '.'));
foreach ($arr as $value) {
    echo "<tr><td>$value</td><td><a href='?option=edit&file=$value'>Edit</a></td><td><a href='?option=delete&file=$value'>Delete</a></td>";
}
?>
</table>
<h2>Create a new file</h2>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
Filename: <input name="file" type="text"/>.md
<input name="option" value="edit" type="hidden"/>
<input name="new" value="true" type="hidden"/>
<input type="submit" value="Submit"/>
</form>
<?php
}
else if($_GET['option']=="delete"){
?>
<h2>Delete a file</h2>
<div class="focus">You have requested to delete the file <b><?php echo $_GET['file'];?></b>. Are you sure you want to do this?</p>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
<input name="option" value="delc" type="hidden"/>
<input name="file" value="<?php echo $_GET['file'];?>" type="hidden"/>
<input name="hash" value="<?php echo md5($_GET['file']);?>" type="hidden"/>
<input type="submit" value="Yes"/>
<button onclick="window.history.back()">No</button>
</form>
<?php
}
//using POST here to force the user to go through the form, sort of
else if($_POST['option']=="delc"){
if(md5($_POST['file'])==$_POST['hash']){
unlink('./files/'.$_POST['file']);
echo "<br />Deleted file.";
} else {
echo "<br />The file and hash did not match. Please try again.";
}
?>
<br />
<a href="<?php echo $_SERVER['PHP_SELF'];?>">Go Back</a>
<?php
} else if($_GET['option']=="edit"){
//using POST due to large file size
?>
<h2>Edit a file</h2>
<div class="focus">You are currently editing <b><?php echo $_GET['file'];?></b>.</p>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
<input name="option" value="save" type="hidden"/>
<input name="new" value="<?php echo $_GET['new'];?>" type="hidden"/>
<input name="file" value="<?php echo $_GET['file'];?>" type="hidden"/>
<textarea name="value" rows=63 cols=112>
<?php echo file_get_contents('./files/'.$_GET['file']);?>
</textarea>
<br />
<input type="submit" value="Save"/>
<button onclick="window.location.assign('<?php echo $_SERVER['PHP_SELF'];?>')">Go back</button>
</form>
<?php
} else if($_POST['option']=="save"){
if($_POST['new']=="true"){
$fname='./files/'.$_POST['file'].'.md';
} else {
$fname='./files/'.$_POST['file'];
}
file_put_contents($fname, $_POST['value']);
?>
<h2>Saved file.</h2>
<button onclick="window.location.assign('<?php echo $_SERVER['PHP_SELF'];?>')">Main home</button>
<?php
}
?>
</div>
</body>
</html>
