<?php
function parse($toParse){
$toParse = nl2br($toParse);
//images
$toParse = str_replace("-img-","<img src='",$toParse);
$toParse = str_replace("_img_","' />",$toParse);
//bold
$toParse = str_replace("-b-","<b>",$toParse);
$toParse = str_replace("_b_","</b>",$toParse);
//italics
$toParse = str_replace("-i-","<i>",$toParse);
$toParse = str_replace("_i_","</i>",$toParse);
//underline
$toParse = str_replace("-u-","<u>",$toParse);
$toParse = str_replace("_u_","</u>",$toParse);
//strikethrough
$toParse = str_replace("-s-","<span style='text-decoration:line-through'>",$toParse);
$toParse = str_replace("_s_","</span>",$toParse);
//pre
$toParse = str_replace("-pre-","<pre>",$toParse);
$toParse = str_replace("_pre_","</pre>",$toParse);
//red
$toParse = str_replace("-red-","<span style='color:#ED0000;'>",$toParse);
$toParse = str_replace("_red_","</span>",$toParse);
//blue
$toParse = str_replace("-blue-","<span style='color:#00BFFF;'>",$toParse);
$toParse = str_replace("_blue_","</span>",$toParse);
//green
$toParse = str_replace("-green-","<span style='color:#00ED00;'>",$toParse);
$toParse = str_replace("_green_","</span>",$toParse);
//pink
$toParse = str_replace("-pink-","<span style='color:#FF8F8F;'>",$toParse);
$toParse = str_replace("_pink_","</span>",$toParse);
//custom style
$toParse = str_replace("-style-","<div style='",$toParse);
$toParse = str_replace("=style=","'>",$toParse);
$toParse = str_replace("_style_","</div>",$toParse);
//ul
$toParse = str_replace("-ul-","<ul>",$toParse);
$toParse = str_replace("_ul_","</ul>",$toParse);
//ol
$toParse = str_replace("-ol-","<ol>",$toParse);
$toParse = str_replace("_ol_","</ol>",$toParse);
//list
$toParse = str_replace("--","<li>",$toParse);
$toParse = str_replace("==","</li>",$toParse);
//link
$toParse = str_replace("-a-","<a href='",$toParse);
$toParse = str_replace("=a=","'>",$toParse);
$toParse = str_replace("_a_","</a>",$toParse);
return $toParse;
}
if(isset($_REQUEST['id'])){
$id = $_REQUEST['id'];
$pwd = $_POST['pwd'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title><?php echo $id;?></title>
<link href='base.css' rel='stylesheet' type='text/css' />
</head>
<body>
<div>
<?php
$path_to_text="./files/".$id.".md";
echo parse(file_get_contents($path_to_text));
if($_GET['hide']!="true"){
?>
<hr />
Read another:<br />
<?php
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
<!--<div id="wrapper">
 
<div id="sidebar-wrapper">
<ul class="sidebar-nav" style="text-align:center;">-->
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
