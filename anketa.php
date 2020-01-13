
	<?php 
		$id = clearData($_GET['id']);	
		$query="select anketa.*,items.strength,items.model,users.login,users.email from anketa left join items on items.id = anketa.id_item left join users on users.id = anketa.id_user";
		$row = getOne($query);			
		$item=$row['strength']." ".$row['model'];
		$login = $row['login'];
		$email = $row['email']; 		
		$fio = $row['fio'];
		$age = $row['age'];
		$sex = $row['sex'];
		$city = $row['city'];
		$telephone = $row['telephone'];
		$marka = $row['marka'];
		$quality = $row['quality'];
		$internet=$row['internet'];	
		$store=$row['store'];
		$other=$row['other'];			
		$buy = $row['buy'];
		$buycoffee = $row['buycoffee'];
		$improve = $row['improve'];
	?>

			<h2><b></b></h2>	
			<center>			
			<h3><b>АНКЕТА, ПРЕДНАЗНАЧЕННАЯ ДЛЯ МАРКЕТИНГОВОГО ИССЛЕДОВАНИЯ ТОВАРА</b></h3>
			<h3><?php echo $item; ?></h3>
			</center>
			<div>
			<form >
				<p>
					<b>Пользователь:</b> 
					<input type="text" name="login" size="15"  value="<?php echo $login; ?>"/>
				</p>
				<p>
					<b>Email:</b> 
					<input type="text" name="email"  size="30"  value="<?php echo $email; ?>"/>
				</p>
				<p>
					<b>ФИО:</b> 
					<input type="text" name="fio" maxlength="70" size="35" placeholder="Введите ФИО" value="<?php echo $fio; ?>"/>
				</p>
				<p>
					<b>Возраст:</b> 
					<input type="number" name="age" min="0"  size="2" value="<?php echo $age; ?>"/>
				</p>
				<p>
					<b>Пол:</b>
					<input type="radio" name="sex" value="Мужской" <?php if($sex == "Мужской") echo "checked"; ?>>Мужской 
					<input type="radio" name="sex" value="Женский"  <?php if($sex == "Женский") echo "checked"; ?>>Женский
				</p>
				<p>
					<b>Город проживания:</b>
					<input type="text" name="city" maxlength="70" size="35" placeholder="Город" value="<?php echo $city; ?>" /> 
				</p> 
				<p>
					<b>Мобильный телефон:</b> 
					<input type="text" name="telephone" maxlength="20" size="20" placeholder="Введите номер телефона" value="<?php echo $telephone; ?>" />
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
					  <input type="radio" name="quality" value="Хорошее" <?php if($quality == "Хорошее") echo "checked"; ?>>Хорошее 
					  <input type="radio" name="quality" value="Отвечающее" <?php if($quality == "Отвечающее") echo "checked"; ?>>Отвечающее
					  <input type="radio" name="quality" value="Плохое" <?php if($quality == "Плохое") echo "checked"; ?>>Плохое
				   </p>
				   <p>
					 <b>Где Вы делали покупку:</b> 
					 <input type="checkbox" name="internet" value="yes" <?php if($internet=="yes") echo "checked" ?>>Интернет-магазин 
					 <input type="checkbox" name="store" value="yes" <?php if($store=="yes") echo "checked" ?>>Магазин
					 <input type="checkbox" name="other" value="yes" <?php if($other=="yes") echo "checked" ?>>Другое 
				  </p>
				  <p>
					 <b>Причина покупки телефона:</b>
					 <input type="radio" name="buy" value="Для себя" <?php if($buy=="Для себя") echo "checked" ?>>Для себя 
					 <input type="radio" name="buy" value="В подарок" <?php if($buy=="В подарок") echo "checked" ?>>В подарок
					 <input type="radio" name="buy" value="Коммерческие цели"<?php if($buy=="Коммерческие цели") echo "checked" ?>>Коммерческие цели
					 <input type="radio" name="buy" value="Другое" <?php if($buy=="Другое") echo "checked" ?>>Другое
				  </p>
				  <p>
					 <b>Вы бы осуществили покупку на нашем сайте снова:</b>
					 <input type="radio" name="buycoffee" value="Несомненно да" <?php if($buycoffee=="Несомненно да") echo "checked" ?>>Несомненно да
					 <input type="radio" name="buycoffee" value="Возможно да" <?php if($buycoffee=="Возможно да") echo "checked" ?>>Возможно да
					 <input type="radio" name="buycoffee" value="Я не уверен/а" <?php if($buycoffee=="Я не уверен/а") echo "checked" ?>>Я не уверен/а
					 <input type="radio" name="buycoffee" value="Несомненно нет" <?php if($buycoffee=="Несомненно нет") echo "checked" ?>>Несомненно нет
				  </p>
				  <p>
					 <b>Что нам следует улучшить, чтобы при следующей покупке Вы остались довольны?</b> <br/>
					 <textarea name="improve" cols="70" rows="5" placeholder="Введите текст" ><?php echo $improve; ?></textarea>
				  </p>				
			</form>
	</div>

