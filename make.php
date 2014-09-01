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
if(
<html>
<head>
<title>Kontrol Panel</title>
<link href='base.css' rel='stylesheet' type='text/css' />
</head>
<body>
<div>
<h1>Welcome to the Kontrol Panel</h1>
<span class="focus">Here you can edit files, and create new ones.</span>
<h2>Edit existing files</h2>
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
<input type="submit" value="Submit"/>
</form>
</div>
</body>
</html>
