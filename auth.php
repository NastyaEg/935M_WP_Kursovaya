<?php
	include_once "lib.inc.php";
	//logining handler
	if (isset($_POST['login']) && isset($_POST['password']))
	{
		$login = clearData($_POST['login']);
		$password = clearData($_POST['password']);
		if ($login == $admin['login']){
			if ($password == $admin['password']){
				$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
				$_SESSION['user_login'] = "Admin";				
				$goal = $_SESSION['goal_url'];
				unset($_SESSION['goal_url']);
				header("Location: index.php");
				exit;
			}
			else{
				echo "<br><center><font color=red>Неверный пароль!</center></font>";
			}
		}
		else
		{			
			$password = md5(md5($password.'smart2020'));
			//ini_set('session.save_path', getcwd());
			session_start(); 
			$query ="SELECT id FROM users where login = '$login' and password = '$password'";	// проверяем есть ли пользователь с таким логином и паролем
			$result = getOne($query);
			if(!empty($result))
			{				
				$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
				$_SESSION['user_login'] = $login;
				$_SESSION['user_id'] = $result['id'];
				$goal = $_SESSION['goal_url'];
				unset($_SESSION['goal_url']);
				header("Location: index.php");
				exit;
			}
			else
				echo "<br><center><font color=red>Неверный логин или пароль!</center></font>";
		}
	}
?>

	<h2><p>Вход в систему</p></h2>
	<form method="POST" >
		<p>Логин:</p><p><input type="text" name="login"></p>
		<p>Пароль:</p><p><input type="password" name="password"></p>
		<p><input type="submit"><a href="index.php?command=registration" style="margin-left:10px;">Регистрация</a></p>		
	</form>
	

	

