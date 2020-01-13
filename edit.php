<?php
	
	$id = clearData($_GET['id']);
	$item = getOne("SELECT * FROM items WHERE id = '$id'");  // получаем всю информацию из items по данному id	
	$name_model = $item['model'];
	$description = $item['description'];
	$strength = $item['strength'];
	$weight = $item['weight'];
	$price = $item['price'];
	$uploadlink = $item['uploadlink'];
	

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//filter	
		if (empty($_POST['name_model']) | empty($_POST['description']) | 
		empty($_POST['strength']) | empty($_POST['weight']) |
		empty($_POST['price'])) {
			echo 'Полностью заполните форму!';	
		} 
		else{
			if(!is_numeric($_POST['price'])){
				echo 'Цена должна быть числовым значением!';
			} 
			else{
				//$id = clearData($_POST['id']);
				$temp = editItem();				
				//addItem($temp);
				$name_model = $temp['name_model'];
				$description = $temp['description'];
				$strength = $temp['strength'];
				$weight = $temp['weight'];
				$price = $temp['price'];
				$uploadlink = $temp['uploadlink'];			
				$cheakID = getOne("SELECT id FROM items WHERE model = '$name_model' and  strength = '$strength' and id<>'$id'");				
				if (count($cheakID) == 0){
						executeQuery("UPDATE items SET strength = '$strength', model = '$name_model', weight = '$weight', price = '$price', description = '$description', uploadlink ='$uploadlink' WHERE id = '$id'");				
						header("Location: index.php?command=catalog");
						exit;
				}
				else 
					echo '<center><br><font color="red">Запись с таким названием уже существует!</font></center>';	
			}
		}
	}
?>
	
<div>
	<h3>Редактировать запись</h3>
	<?php include "item_form.php" ?>
</div>
