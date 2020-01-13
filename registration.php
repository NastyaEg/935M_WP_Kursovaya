<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {		
        if (!empty($_POST['password_main']) && !empty($_POST['password_confirm']) && !empty($_POST['login']) && !empty($_POST['email'])) 
        {
            if ($_POST['password_main'] == $_POST['password_confirm'])
            {           
                $password = md5(md5(clearData($_POST['password_main']).'smart2020'));   // хэшируем пароль 
                $login = clearData($_POST['login']);
				$email = clearData($_POST['email']);  				
				$query ="SELECT id FROM users where login = '$login' or email = '$email'";		// проверяем нет ли в таблице пользователя с таким логином или емаилом
				$result = getOne($query);
				if(!empty($result))
				{		
					echo "<br><center><font color=red>Пользователь с таким логином или email уже существует!</center></font>";
				}
				else 
				{
					$query ="INSERT INTO users (login,password,email) VALUES ('$login','$password','$email')";			
					executeQuery($query);
					header("Location: index.php?command=login&login=".$login); 	
							
				}				                      
            }
            else echo '<br><center><font color=red>Пароли не совпадают!</center></font>';
        }
        else echo '<br><center><font color=red>Заполните все обязательные поля!</center></font>';
    }
?>
<br><br>
<center>
	<table>
		<tr>
			<td>		
				<h2 align="center">Регистрация</h2>
				<form method="POST">
					<table>
						<tr >
							<td>Логин</td>
							<td><input type="text" name="login" required></td>
						</tr>
						<tr >
							<td>Пароль</td>
							<td><input type="password" name="password_main" required></td>
						</tr>
						<tr >
							<td>Повторите пароль</td>
							<td><input type="password" name="password_confirm" required></td>
						</tr>
						</tr>      
						<tr >
							<td>Email</td>
							<td><input type="text" name="email" size="25" required></td>
						</tr>
					</table>
					<p >
						<center><input type="submit" value="Зарегистрироваться"></center>
					</p>
				</form>
			</td>
		</tr>
	</table>
</center>
