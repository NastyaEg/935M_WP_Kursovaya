<?php

if (!isset($_SESSION['user_login']))
	$menu = array("Главная"=>"index.php");
else{
	if ($_SESSION['user_login'] == "Admin")
		$menu = array( 
			"Главная"=>"index.php", 
			"Приход товара"=>"index.php?command=lab4",
			"Каталог"=>"index.php?command=catalog",
			"Пользователи"=>"index.php?command=users",
			"Анкеты"=>"index.php?command=ankets"
			
		);
	else
		$menu = array( 
			"Главная"=>"index.php", 			
			"Каталог"=>"index.php?command=catalog"
		);
}		
?>

<ul id="menu">
    <?php getMenu($menu);?>
</ul>
