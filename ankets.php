<center><h2>Анкеты пользователей</h2></center>	<br>
<?php 
		
if (isset($_POST['delete'])){
	$del = $_POST['delId'];
	if (!empty($del)){
		foreach ($del as $d){
			$query = "delete from anketa where id = ".$d;
			executeQuery($query);
		}		
	}
	else
		echo "<center><font color='red'>Отметьте записи которые необходимо удалить</font><br><br></center>";
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
$query = "select count(id) as 'kol' from anketa ";
$result = getOne($query);
$countAllrecords = $result['kol'];
// номер последней страницы
$lastPage = ceil($countAllrecords/$countView);	
viewPage($lastPage,$pageNum,"ankets");
		
?>
<form action="index.php?command=ankets" method="POST">
<input type="submit" value="Удалить" name="delete"><br><br>
<table  class="lab1" border="1">
	<tr>
		<th bgcolor="#838283" align="center">Id анкеты</th>	
		<th bgcolor="#838283" align="center">Логин</th>				
		<th bgcolor="#838283" align="center">Email</th>	
		<th bgcolor="#838283" align="center">Товар</th>	
		<th bgcolor="#838283" align="center"></th>	
	</tr>		
	<?php	
		$query = "SELECT  anketa.id,users.login,users.email,items.strength,items.model FROM anketa 
				  left join users on users.id=anketa.id_user left join items on items.id=anketa.id_item  ORDER BY login ASC limit $startIndex,$countView";
		$rows = getAll($query);
		foreach ($rows as $item){
			echo "
				<tr>
					<td><a href='index.php?command=anketa&id=".$item['id']."'>".$item['id']."</a></td>
					<td>".$item['login']."</td>
					<td>".$item['email']."</td>	
					<td>".$item['strength']." ".$item['model']."</td>	
					<td><input type='checkbox' name='delId[]' value='".$item['id']."'></td>						
				</tr>";
		}
	?>
</table>
</form>
<div align="left" style='margin-left:50px;'>
<br>
<?php 
$po = $startIndex+$countView;
if ($po>$countAllrecords) $po = $countAllrecords;
?>		
<span><?php echo "Показано с ".($startIndex+1)." по ".$po." из ".$countAllrecords." записей"; ?></span>
</div>
