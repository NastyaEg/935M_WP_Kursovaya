<center><h2>Пользователи сайта</h2></center>	<br><br>
<?php 


echo  printAlphabet(48,57);
echo  printAlphabet();
echo"<br><br>";
			
$where = "";

if (isset($_GET['l'])){	
	$l = clearData($_GET['l']);
	$where = " WHERE upper(left(login,1)) = '".$l."' ";	
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
$query = "select count(id) as 'kol' from users ".$where;
$result = getOne($query);
$countAllrecords = $result['kol'];
// номер последней страницы
$lastPage = ceil($countAllrecords/$countView);	
viewPage($lastPage,$pageNum,"users");
		
?>
<br><br>
<table  class="lab1" border="1">
	<tr>
		<th bgcolor="#838283" align="center">ID</th>	
		<th bgcolor="#838283" align="center">Логин</th>				
		<th bgcolor="#838283" align="center">Email</th>	
	</tr>		
	<?php	
		$query = "SELECT  * FROM users ".$where." ORDER BY login ASC limit $startIndex,$countView";
		$rows = getAll($query);
		foreach ($rows as $item){
			echo "
				<tr>
					<td>".$item['id']."</td>
					<td>".$item['login']."</td>
					<td>".$item['email']."</td>					
				</tr>";
		}
	?>
</table>
<div align="left" style='margin-left:50px;'>
<br>
<?php 
$po = $startIndex+$countView;
if ($po>$countAllrecords) $po = $countAllrecords;
?>		
<span><?php echo "Показано с ".($startIndex+1)." по ".$po." из ".$countAllrecords." записей"; ?></span>
</div>
