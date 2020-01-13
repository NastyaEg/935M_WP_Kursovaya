<?php
	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$id = clearData($_GET['id']);		
		$item = getOne("SELECT * FROM items WHERE id = '$id'");  // получаем всю информацию из items по данному id	
		$name_model = $item['model'];
		$description = $item['description'];
		$strength = $item['strength'];
		$weight = $item['weight'];
		$price = $item['price'];
		$uploadlink = $item['uploadlink'];
	}
?>
<br/>
<a href='index.php?command=catalog' class="item-ref">Назад</a>
<?php if ($_SESSION['user_login']=="Admin") 
	  { 
?>
			<a href='index.php?command=edit&id=<?=$id?>' class="item-ref">Редактировать</a>
<?php 
	  }
	  else{	  
?>
		<a href='index.php?command=lab1&id=<?=$id?>' class="item-ref" style="margin-left:20px;">Оставить анкету покупателя</a>
<?php 
	  }
?>
<br/><br/>
<table class="lab1" border="1">
	<tr>
		<th width="15%" bgcolor="#838283">Модель гаджета</th>
		<td colspan="2" width="45%" style="padding:0px 0px 0px 5px;"><?= $name_model ?></td>
		<td rowspan="5"><img src="<?php if(!empty($uploadlink)) echo $uploadlink; else echo "Images/no-image.jpg"; ?>" width="100%" height="100%"></td>
	</tr>
	<tr height="250">
		<th width="15%" bgcolor="#838283">Описание</th>
		<td colspan="2" style="padding:0px 0px 0px 5px;"><?= $description ?></td>
	</tr>
	<tr>
		<th width="15%" bgcolor="#838283">Название</th>
		<td colspan="2" style="padding:0px 0px 0px 5px;"><?= $strength ?></td>
	</tr>
	<tr>
		<th width="15%" bgcolor="#838283">Ёмкость аккумулятора, мАч</th>
		<td colspan="2" style="padding:0px 0px 0px 5px;"><?= $weight ?></td>
	</tr>
	<tr>
		<th width="15%" bgcolor="#838283">Цена</th>
		<td colspan="2" style="padding:0px 0px 0px 5px;"><?= $price ?> руб.</td>
	</tr>
</table>
<br/>
