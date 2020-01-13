<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//filter
	if (empty($_POST['name_model']) | empty($_POST['description']) | 
	empty($_POST['strength']) | empty($_POST['weight']) |
	empty($_POST['price'])){
		echo 'Полностью заполните форму!';	
	} 
	else {
		if(!is_numeric($_POST['price'])){
			echo 'Цена должна быть числовым значением!';
		} 
		else{
			$item = createNewItem();
			//addItem($item);
			$name_model = $item['name_model'];
			$description = $item['description'];
			$strength = $item['strength'];
			$weight = $item['weight'];
			$price = $item['price'];
			$uploadlink = $item['uploadlink'];			
			$cheakID = getOne("SELECT id FROM items WHERE model = '$name_model' and strength = '$strength' ");				
			if (count($cheakID) == 0)
			{
				executeQuery("INSERT INTO items (strength,model,weight,price,description,uploadlink) VALUES ('$strength','$name_model','$weight','$price','$description','$uploadlink')");					
				header("Location: index.php?command=catalog");
				exit;
			}			
			else 
				echo  '<br><center><font color="red">Запись с таким названием уже существует!</font></center>';
		}
	}
}
?>
<div>	
	<h3>Добавить запись</h3>
	<?php include "item_form.php" ?>
</div>