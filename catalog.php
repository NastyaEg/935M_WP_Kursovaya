
<form method="GET" action="index.php">	
	<input type='hidden' name='command' value='catalog'>
	<table class="search">
		<tr>
			<td>Модель гаджета:</td>
			<td><input id="model"  name="model" type="text" size="30" value="<?php if (isset($_GET['model'])) echo clearData($_GET['model']); ?>"></td>
		</tr>	
		<tr>
			<td>Название:</td>
			<td>	
				<select name="strength">
					<option value="" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "") echo "selected"; ?> >Все марки</option>
					<option value="Samsung" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "Samsung") echo "selected"; ?> >Samsung</option>
					<option value="Huawei" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "Huawei") echo "selected"; ?>>Huawei</option>
					<option value="LG" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "LG") echo "selected"; ?> >LG</option>
					<option value="Nokia" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "Nokia") echo "selected"; ?> >Nokia</option>
					<option value="Alcatel" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "Alcatel") echo "selected"; ?> >Alcatel</option>
					<option value="Asus" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "Asus") echo "selected"; ?> >Asus</option>
					<option value="Xiaomi" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "") echo "selected"; ?> >Xiaomi</option>
					<option value="Apple" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "Xiaomi") echo "selected"; ?> >Apple</option>
					<option value="HTC" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "HTC") echo "selected"; ?> >HTC</option>
					<option value="Honor" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "Honor") echo "selected"; ?> >Honor</option>
					<option value="Lenovo" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "Lenovo") echo "selected"; ?> >Lenovo</option>
					<option value="ZTE" <?php if (isset($_GET['strength']) && clearData($_GET['strength']) == "ZTE") echo "selected"; ?> >ZTE</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type='submit' value='Поиск' name='search' ></td>
		</tr>				
	</table>		
</form><br>

<?php
	//Инициализация переменных
	$name_model = "";
	$description = "";
	$strength = "";
	$weight = "";
	$price	 = "";
	$uploadlink = "";

	if (isset($_POST['delete']))
	{
		if (!empty($_POST['delId'])){			    
			foreach($_POST['delId'] as $val)
			{
				$row = getOne("select uploadlink from items where id = '$val'");
				executeQuery("DELETE FROM items WHERE id = '$val'"); // удаляем записи из таблицы items				
				@unlink($row['uploadlink']);   					
			}
		}
		else echo "<br><center><font color='red'>Отметьте записи, которые необходимо удалить!</font><br></center>";
	}	
	
	$where = "";
	if (isset($_GET['search']))
	{
		$model = clearData($_GET['model']);
		$strength = clearData($_GET['strength']);				
		$where = "WHERE model LIKE '%".$model."%' AND strength LIKE '%".$strength."%'";						
	}
	
	
	$countView = 5; // количество материалов на странице	
	// номер страницы
	if(isset($_GET['nom'])){
		$pageNum = (int)$_GET['nom'];
	}else{
		$pageNum = 1;
	}
	$startIndex = ($pageNum-1)*$countView; // с какой записи начать выборку
	// получение полного количества новостей
	$query = "select count(id) as 'kol' from items ".$where;
	$result = getOne($query);	
	$countAllrecords = $result['kol'];
	// номер последней страницы
	$lastPage = ceil($countAllrecords/$countView);	
	

if ($_SESSION['user_login']=="Admin")
	{	
?>
		<button id="add" class='btn' style='margin: 5px' onclick="location.href='index.php?command=add';">Добавить</button><br><br>
<?php 
	} 
	viewPage($lastPage,$pageNum,"catalog&model=".$model."&strength=".$strength); 
?>
<br/><br/>

<form method='POST'>
<table class="lab1" border="1">
	<tr>
		<th width="20%" bgcolor="#838283" align="center">Модель гаджета</th>
		<th width="20%" bgcolor="#838283" align="center">Название</th>
		<th width="20%" bgcolor="#838283" align="center">Ёмкость аккумулятора,мАч</th>
		<th width="20%" bgcolor="#838283" align="center">Цена</th>
		<th width="2%" bgcolor="#838283" align="center"></th>
	</tr>
	<?php 
	$query = "SELECT * FROM items ".$where." ORDER BY id ASC limit $startIndex,$countView";					
	$rows = getAll($query); 
	if (!empty($rows)) {
		foreach ($rows as $item){
			$name_model = $item['model'];
			//$description = $item['description'];
			$strength = $item['strength'];
			$weight = $item['weight'];
			$price = $item['price'];
			$id = $item['id'];
		echo 
		"<tr>
		<td> <a href='index.php?command=item&id=$id';' style='color:black; display:inline;'> $name_model </a> </td>
		<td>$strength</td>
		<td>$weight</td>
		<td>$price</td>
		<td>
			<input type='checkbox' name='delId[]' value=$id/>
		</td>
		</tr>";
		}
	}
	?>
	
	</table>
	<?php 
		if ($_SESSION['user_login']=="Admin"){
	?>
			<input id='delete' class='btn' style='margin: 5px' type='submit' class='button' name='delete' value='Удалить'/>
	<?php 
		}
	?>
</form>
<div align="left" >
	<br>
	<?php 
		$po = $startIndex+$countView;
		if ($po>$countAllrecords) $po = $countAllrecords;
	?>		
	<span><?php echo "Показано с ".($startIndex+1)." по ".$po." из ".$countAllrecords." записей"; ?></span>
</div>
