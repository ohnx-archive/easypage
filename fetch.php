<?php
if(isset($_REQUEST['id'])){
$id = $_REQUEST['id'];
$pwd = $_POST['pwd'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title><?php echo $id;?></title>
<link href='base.css' rel='stylesheet' type='text/css' />
<?php
if(isset($_POST['pwd'])&&($_POST['usepwd']=="yes")){
//Begin portion crudely copied from alphacrypt website
//I really need to learn JavaScript one day, it'll probably help with ajax
?>
<script type="text/javascript" src="alphac/alphac.js"></script>
<script type="text/javascript" src="alphac/md5.js"></script>
<script type="text/javascript" src="alphac/timer.js"></script>
<script type="text/javascript">
function process(on) {
var fe = document.fe;
var ke = fe.key.value;
var re = fe.re;
var f = timer(function() {
re.value = alphac(re.value, ke, md5(ke), on)
});
var t = f();
var d = re.value.length;
}
</script>
</head>
<body onload="process(0)">
<form action="?" name="fe"
onsubmit="process(window.a=!window.a); return false">
<div align="center">
<textarea rows="12" cols="64" name="re">
<?php
$path_to_text="files/".$id.".md";
echo file_get_contents($path_to_text);
?>
</textarea>
<p>
Key: <input type="text" name="key" size="24" value="<?php echo $pwd;?>"/>
</p>
</div>
</form>
<hr />
Read another:
<?php
} else {
?>
</head>
<body>
<div>
<?php
$path_to_text="./files/".$id.".md";
echo file_get_contents($path_to_text);
if($_GET['hide']!="true"){
?>
<hr />
Read another:<br />
<?php
}
}
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Enter ID</title>
<link href='base.css' rel='stylesheet' type='text/css' />
</head>
<body>
<div>
Please enter the ID of the document you would like to access, as well as the password to decrypt it, if needed.
<?php
}
if($_GET['hide']!="true"){
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
ID: <input type="text" name="id"><br />
Password: <input type="password" name="pwd"><br />
<input type="checkbox" name="usepwd" value="yes">Use password (for encrypted files)<br />
<input type="submit" value="Submit">
</form>
</div>
</body>
</html>
<?php
}
?>
