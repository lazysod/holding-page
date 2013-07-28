<?php
include_once('includes/config.php');
include_once('includes/functions.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<?php include_once('includes/meta.php'); ?> 
<meta name="robots" content="index,follow,noodp,noydir" />

<title><?php echo $title_block; ?></title>

</head>

<body>
<?php include_once('includes/analytics.php'); ?>
<div id="mac">


<div id="box"><h1 align="center">Welcome to <?php echo $_SERVER['HTTP_HOST']; ?></h1>
<?php echo '<h2 align="center">Your IP address is <font color="#ff7c7c">'.$_SERVER['REMOTE_ADDR'].'</font></h2>'; 

echo '<p><strong>Browser:</strong> '.$obj->showInfo('browser').'</p>';

// get browser version
echo '<p><strong>Version:</strong> '.$obj->showInfo('version').'</p>';

// get Operating system
echo '<p><strong>OS:</strong> '.getOS($_SERVER['HTTP_USER_AGENT']).'</p>';

echo '<p><strong>You are from:</strong> '.$country.'</p>';
echo '<p><strong>You arrived on the:</strong> '.$date.' at: '.$nTime.'</p>';

?>


</div>
</div>
<div align="center" class="msgH1"></div>
<p align="center"><?php echo $welcome_block; ?></p>
<p align="center" class="footer"><?php echo $copyright_block; ?></p>
</body>
</html>
