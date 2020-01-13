
	<?php 
		$id_item = clearData($_GET['id']);	
		$id_user = $_SESSION['user_id'];		
		$query = "select strength,model from items where id = ".$id_item;
		$res = getOne($query);
		$item = $res['strength']." ".$res['model'];
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{		
			$query="select count(id) as kol from anketa where id_user = ".$id_user." and id_item = ".$id_item;
			$res = getOne($query);		
			if ($res['kol']>0)
				echo "<p><font color='red'>Вы уже оставляли анкету на данный товар!</font></p>";
			else{			
				$fio = clearData($_POST['fio']);
				$age = clearData($_POST['age']);
				$sex = clearData($_POST['sex']);
				$city = clearData($_POST['city']);
				$telephone = clearData($_POST['telephone']);
				$marka = clearData($_POST['marka']);
				$quality = clearData($_POST['quality']);
				$internet="No";
				if (isset($_POST['internet']))
					$internet = clearData($_POST['internet']);
				$store="No";
				if (isset($_POST['store']))
					$store = clearData($_POST['store']);
				$other="No";
				if (isset($_POST['other']))
					$other = clearData($_POST['other']);			
				$buy = clearData($_POST['buy']);
				$buycoffee = clearData($_POST['buycoffee']);
				$improve = clearData($_POST['improve']);
				$query="insert into anketa (id_user,id_item,fio,age,sex,city,telephone,marka,quality,internet,store,other,buy,buycoffee,improve) values
						('$id_user','$id_item','$fio','$age','$sex','$city','$telephone','$marka','$quality','$internet','$store','$other','$buy','$buycoffee','$improve') ";
				executeQuery($query);
				echo "<p><font color='green'>Спасибо за то что приняли участие в анкетирование!</font></p>";
			}
		}	
	?>

			<h2><b></b></h2>	
			<center>			
			<h3><b>АНКЕТА, ПРЕДНАЗНАЧЕННАЯ ДЛЯ МАРКЕТИНГОВОГО ИССЛЕДОВАНИЯ ТОВАРА</b></h3>
			<h3><?php echo $item; ?></h3>
			</center>
			<div>
			<form action="index.php?command=lab1&id=<?php echo $id; ?>" method="POST">
				<p>
					<b>ФИО:</b> 
					<input type="text" name="fio" maxlength="70" size="35" placeholder="Введите ФИО" required />
				</p>
				<p>
					<b>Возраст:</b> 
					<input type="number" name="age" min="0"  size="2" required />
				</p>
				<p>
					<b>Пол:</b>
					<input type="radio" name="sex" value="Мужской" checked>Мужской 
					<input type="radio" name="sex" value="Женский">Женский
				</p>
				<p>
					<b>Город проживания:</b>
					<input type="text" name="city" maxlength="70" size="35" placeholder="Город" required /> 
				</p> 
				<p>
					<b>Мобильный телефон:</b> 
					<input type="text" name="telephone" maxlength="20" size="20" placeholder="Введите номер телефона" required />
				</p>
				<p>
					<b>Какую марку техники обычно покупаете:</b> 
					<select name="marka">
						<option value="Samsung" selected>Samsung</option>
						<option value="Huawei">Huawei</option>
						<option value="LG">LG</option>
						<option value="Nokia">Nokia</option>
						<option value="Alcatel">Alcatel</option>
						<option value="Asus">Asus</option>
						<option value="Xiaomi">Xiaomi</option>
						<option value="Apple">Apple</option>
						<option value="HTC">HTC</option>
						<option value="Honor">Honor</option>
						<option value="Lenovo">Lenovo</option>
						<option value="ZTE">ZTE</option>
					</select>
				  </p> 
				   <p>
					  <b>Как Вы бы оценили качество смартфона по данной цене:</b>
					  <input type="radio" name="quality" value="Хорошее" checked>Хорошее 
					  <input type="radio" name="quality" value="Отвечающее">Отвечающее
					  <input type="radio" name="quality" value="Плохое">Плохое
				   </p>
				   <p>
					 <b>Где Вы делали покупку:</b> 
					 <input type="checkbox" name="internet" value="yes">Интернет-магазин 
					 <input type="checkbox" name="store" value="yes">Магазин
					 <input type="checkbox" name="other" value="yes">Другое 
				  </p>
				  <p>
					 <b>Причина покупки телефона:</b>
					 <input type="radio" name="buy" value="Для себя" checked >Для себя 
					 <input type="radio" name="buy" value="В подарок">В подарок
					 <input type="radio" name="buy" value="Коммерческие цели">Коммерческие цели
					 <input type="radio" name="buy" value="Другое">Другое
				  </p>
				  <p>
					 <b>Вы бы осуществили покупку на нашем сайте снова:</b>
					 <input type="radio" name="buycoffee" value="Несомненно да" checked>Несомненно да
					 <input type="radio" name="buycoffee" value="Возможно да">Возможно да
					 <input type="radio" name="buycoffee" value="Я не уверен/а">Я не уверен/а
					 <input type="radio" name="buycoffee" value="Несомненно нет">Несомненно нет
				  </p>
				  <p>
					 <b>Что нам следует улучшить, чтобы при следующей покупке Вы остались довольны?</b> <br/>
					 <textarea name="improve" cols="70" rows="5" placeholder="Введите текст" required></textarea>
				  </p>
					 <input type="submit" style="margin: 10px" value="Отправить"/>
			</form>
			</div>

