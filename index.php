<?php
	session_start();
	ob_start();
	//ini_set('display_errors',1);
	include_once "lib.inc.php";
	//ini_set('session.save_path', getcwd());
		
	//filter
	//if session is empty and command isn't login then redirict
	if(isset($_GET['command'])){
		if(!isset($_SESSION['user_login']) && $_GET['command'] != 'registration'){
			if ($_GET['command'] != 'login') {
				$_SESSION['goal_url'] = $_SERVER['REQUEST_URI'];
				header("Location: index.php?command=login");
				exit;
			} 
		}
	}
	//logout handler
	if(isset($_GET['command'])){
		if($_GET['command'] == 'logout'){
			session_destroy();
			header("Location: index.php");
		}
	}
	if (isset($_COOKIE['visitDate'])) $visitDate = $_COOKIE['visitDate'];
	setcookie('visitDate',date('Y-m-d H:i:s'),time()+0xFFFFFFF);
	include_once "base_reg.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Главная</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

	<div id="container">
	<?php include "top.inc.php" ?>
	<?php include "menu.inc.php" ?>
		<div id="content">
		<?php
			//someting like command controller
			if(!empty($_GET['command'])){
				$command = $_GET['command'];
				switch($command)
				{	
					case 'registration': include 'registration.php'; break;
					case 'login': include 'auth.php'; break;
					case 'lab1': include 'lab_rab1.php'; break;
					case 'lab2': include 'lab_rab2.php'; break;
					case 'lab3': include 'lab_rab3.php'; break;				
					case 'lab4': include 'lab_rab4.php'; break;	
					case 'catalog': include 'catalog.php'; break;	
					case 'add': include 'add.php'; break;
					case 'item': include 'item.php'; break;	
					case 'edit': include 'edit.php'; break;		
					case 'users': include 'users.php'; break;	
					case 'ankets': include 'ankets.php'; break;		
					case 'anketa': include 'anketa.php'; break;						
				}
			} else {?>
			
			<h2><b>ДОБРО ПОЖАЛОВАТЬ В ИНТЕРНЕТ-МАГАЗИН СМАРТФОНОВ И ПЛАНШЕТОВ Technolight!</b></h2>
			<p><img src="Images/tele.jpg" width="150" height="195" class="leftimg"> Интернет-магазин смартфонов и планшетов Technolight рад познакомить
				вас с большим ассортиментом современных гаджетов из разных уголков мира! Бренд Technolight уже многим известен в качестве надёжного
				поставщика электроники, работающего только с лучшими мировыми компаниями. Заказывать подобные товары в сети намного удобнее: можно сразу посмотреть обзор, 
				прочитать характеристики и инструкцию,изучить все возможные варианты и сравнить с другими моделями. Но чтобы покупать с удовольствием, нужно сначала 
				выбрать хороший сайт.
</p>
			<p>Мы гарантируем высокое качество сервиса и продукции и будем рады, если и вы оцените ассортимент электроники в интернет-магазине!
</p>
			<p>В нашем ассортименте представлены такие бренды как Samsung Huawei,LG,Nokia,Alcatel,Vivo,Motorola,Sony,ZTE,Lenovo,Honor,HTC,Apple,
			   Xiaomi,Asus,Sony Ericsson,Micromax и многие другие! Также у нас вы найдёте все необходимые аксессуары к вашим гаджетам
</p>
		<?php 
		}
		?>
		</div>

		<div id="clear">
		</div>

		<?php include "bottom.inc.php" ?>
	</div>

</body>

</html>