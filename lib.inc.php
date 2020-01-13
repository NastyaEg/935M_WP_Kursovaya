<?php
	function getMenu($menu, $vertical=true)
	{
		$style = "";
		if(!$vertical)
		{
			$style = "display:inline";
		}
		echo '<ul style="list-style-type:none">';
		foreach ($menu as $link=>$href)
		{
			echo "<li style='$style'><a href=\"$href\">", $link, '</a></li>';
		}
		echo '</ul>';
	}

// return result in meters per second
	function calculateSpeed($way, $time)
	{
		if($time != 0) return $way / $time;
	}

	function toKilomitersPerHour($value)
	{
		return $value * 3.59999712;
	}

	function toMilePerHour($value)
	{
		return $value * 2.23694;
	}

	function showSpeedValue()
	{
		global $result;
		if($result){
			echo "<p>Result: </p>";
			echo "<p>$result.m/s</p>";
			echo "<p>" . toKilomitersPerHour($result) . " km/h</p>";
			echo "<p>" . toMilePerHour($result) . " mile/h</p>";
		}
	}

	function my_var_dump($array)
	{
		$i = 0;
		foreach ($array as $value) {
			if (is_array($value)) {
				my_var_dump($value);
			} else {
				echo "<p>[$i] =><p>";
				echo "<p>" . gettype($value) . "($value)</p>";
				$i++;
			}
		}
	}

	function clearData($data)
	{
		return trim(strip_tags($data));
	}

	function imageCheck()	
	{
		if ($_FILES['uploadfile']['type'] == "image/jpeg")
		{
			if ($_FILES['uploadfile']['size']<=1024000)
				return 1;
			else
				return "Размер файла не должен превышать 1000Кб";
		}
		else
			return "Файл должен иметь jpeg-расширение";	
	}

	function resize($file)
	{
		$tmp_path = 'tmp/';	
		// Ограничение по ширине в пикселях
		$max_size = 250;
		// Cоздаём исходное изображение на основе исходного файла
		$src = imagecreatefromjpeg($file['tmp_name']);
		// Определяем ширину и высоту изображения
		$w_src = imagesx($src);
		$h_src = imagesy($src);
		// Если ширина больше заданной
		if ($w_src > $max_size)
		{
			// Вычисление пропорций
			$ratio = $w_src/$max_size;
			$w_dest = round($w_src/$ratio);
			$h_dest = round($h_src/$ratio);
			// Создаём пустую картинку
			$dest = imagecreatetruecolor($w_dest, $h_dest);
			// Копируем старое изображение в новое с изменением параметров
			imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
			// Вывод картинки и очистка памяти
			imagejpeg($dest, $tmp_path . $file['name']);
			imagedestroy($dest);
			imagedestroy($src);				
			return $file['name'];
		}
		else
		{
			// Вывод картинки и очистка памяти
			imagejpeg($src, $tmp_path . $file['name']);
			imagedestroy($src);
			return $file['name'];
		}		
	}

	function debug_to_console( $data ) {
		$output = $data;
		if ( is_array( $output ) )
			$output = implode( ',', $output);
		echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	}

	function getId(){
		if (!isset($_SESSION['last_index'])){
			$_SESSION['last_index'] = 0;
		} 
		return ++$_SESSION['last_index'];
	}

	function getItemById($id){
		if (isset($_SESSION['Items'])){
			foreach($_SESSION['Items']  as $item){
				if ($item['id'] == $id){
					return $item;
					break;
				}
			}
		}
	}

	function createNewItem(){
		return createItem();  
	}

	function editItem(){
		//deleteItem($id);
		return createItem(); 
	}

	function createItem(){
		$item_array = array();
		
			//$item_array['id'] = $id;
			$item_array['name_model'] = clearData($_POST['name_model']);
			$item_array['description'] = clearData($_POST['description']);
			$item_array['strength'] = clearData($_POST['strength']);
			$item_array['weight'] = clearData($_POST['weight']);
			$item_array['price'] = clearData($_POST['price']);
			if (isset($_GET['id']))
				//$title = $item_array['strength']."_".$item_array['name_model'];
				$title = clearData($_GET['id']);
			else{
				$row = getOne("select id from items order by id desc");
				$title = $row['id']+1;
			}				
			$curuploadlink = clearData($_POST['curuploadlink']);		
			$item_array['uploadlink'] = clearData($_POST['curuploadlink']);
			if (!empty($_FILES['uploadfile']['name']))
			{
				$tmp_path = 'tmp/';
				$file_path = 'Images/';
				$result = imageCheck();			
				if ($result == 1)
				{
					$name = resize($_FILES['uploadfile']);					
					$uploadfile = $file_path . $name;
					if (@copy($tmp_path . $name, $file_path . $title . '.jpeg'))
						$uploadlink = "Images/". $title . '.jpeg';
					unlink($tmp_path . $name);
					$item_array['uploadlink'] = $uploadlink;
				}
				else
				{
					echo $result;
					exit;
				}
			}
		return $item_array;
	}

	function addItem($item){
		if (!isset($_SESSION['Items'])){
			$_SESSION['Items'] = array();
		}
		array_push($_SESSION['Items'], $item);
	}

	function deleteItem($id){
		if (isset($_SESSION['Items'])){
			for($i = 0; $i < count($_SESSION['Items']); ++$i) {
				if ($_SESSION['Items'][$i]['id'] == $id){
					array_splice($_SESSION['Items'], $i, 1);
				}
			}
		}
	}

	function is_numeric_array($array) 
	{ 
		if ($array != null)
		{ 
			foreach ($array as $elem) 
			{ 
				if (!is_numeric($elem)) 
				{ 
					return false; 
				} 
			} 
		} 
		else 
		{ 
			return false; 
		} 
		return true; 
	} 

	function sum($numbers) 
	{ 
		$sum = 0; 
		foreach ($numbers as $number) 
		{ 
			$sum += $number; 
		} 
		return $sum; 
	} 

	function avg($numbers) 
	{ 
		return sum($numbers)/count($numbers); 
	} 

	function multiple($numbers) 
	{ 
		$mult = 1; 
		foreach ($numbers as $number) 
		{ 
			$mult = $mult * $number; 
		} 
		return $mult; 
	} 

	function min_value($numbers) 
	{ 
		$min = $numbers[0]; 
		for ($i=1; $i < count($numbers); $i++) 
		{ 
			if ($min > $numbers[$i]) 
			{ 
				$min = $numbers[$i]; 
			} 
		} 
		return $min; 
	} 

	function max_value($numbers) 
	{ 
		$max = $numbers[0]; 
		for ($i=1; $i < count($numbers); $i++) 
		{ 
			if ($max < $numbers[$i]) 
			{ 
				$max = $numbers[$i]; 
			} 
		} 
		return $max; 
	}
	
	
		function viewPage($lastPage, $pageNum, $page)  // формирование пагенации принимает параметры $on_page - кол-во записей на странице, $count - всего записей , $page - страница на которой формируется пагенация
	{		
		/* Входные параметры */
		$count_pages = $lastPage;
		$active = $pageNum;
		$count_show_pages = 10;
		$url = "index.php?command=".$page;
		$url_page = "index.php?command=".$page."&nom=";
		if ($count_pages > 1) { // Всё это только если количество страниц больше 1
			/* Дальше идёт вычисление первой выводимой страницы и последней (чтобы текущая страница была где-то посредине, если это возможно, и чтобы общая сумма выводимых страниц была равна count_show_pages, либо меньше, если количество страниц недостаточно) */
			$left = $active - 1;
			$right = $count_pages - $active;
			if ($left < floor($count_show_pages / 2)) $start = 1;
			else $start = $active - floor($count_show_pages / 2);
			$end = $start + $count_show_pages - 1;
			if ($end > $count_pages) {
				$start -= ($end - $count_pages);
				$end = $count_pages;
			if ($start < 1) $start = 1;
		}
	?>
		 <!-- вывод пагинатора -->	  
				<?php if ($active != 1) { ?>					
						<a class="link" href="<?=$url?>" title="Первая страница">Первая</a>					
						<a class="link" href="<?php if ($active == 2) { ?><?=$url?><?php } else { ?><?=$url_page.($active - 1)?><?php } ?>" title="Предыдущая">Предыдущая</a>				
				<?php } ?>
				<?php for ($i = $start; $i <= $end; $i++) { ?>
				<?php if ($i == $active) { ?><a class="curpage" ><?=$i?></a><?php } else { ?><a class="link" href="<?php if ($i == 1) { ?><?=$url?><?php } else { ?><?=$url_page.$i?><?php } ?>"><?=$i?></a><?php } ?>
				<?php } ?>
				<?php if ($active != $count_pages) { ?>					
						<a class="link" href="<?=$url_page.($active + 1)?>" title="Следующая">Следующая</a>					
						<a class="link" href="<?=$url_page.$count_pages?>" title="Последняя страница">Последняя</a>				
				<?php } ?>		
			<?php } ?>
	<?php		
	}
	
		function printAlphabet($from = 65, $to = 90) {
		$tmp = '';
		$range = range($from, $to);
		foreach($range as $letter) {
			$tmp .= '<a class="link" href="index.php?command=users&l='.iconv('cp1251', 'utf-8', chr($letter)).'">'.iconv('cp1251', 'utf-8', chr($letter)).'</a> ';
		}
		return $tmp;
	}
	
	// функции для работы с БД
	
	
	$connect = false;
	function connectDB(){   // функция подключения к БД
		global $connect;
		include "base_reg.php";
		$connect = mysqli_connect($host, $user, $password, $database) or die("Не удалось подключиться к БД"); // подключение к базе данных			
		/* изменение набора символов на utf8 */
		mysqli_set_charset($connect,"utf8");
	}
	
	function getOne($query){ // функция получения одной записи из БД
		global $connect;
		connectDB();
		$result_set = mysqli_query($connect,$query) or die("Ошибка " . mysqli_error($connect));;
		closeDB();
		return $result_set->fetch_assoc();
	}	
	
	
	function getAll($query){ // функция получения нескольких записей из БД
		global $connect;
		connectDB();
		$result_set = mysqli_query($connect,$query) or die("Ошибка " . mysqli_error($connect));;
		closeDB();
		return resultSetArray($result_set);
	}
	
	function executeQuery($query){  // функция выполнения запросов, которые не возвращают данные (INSERT,UODATE,DELETE и т.д)
		global $connect;
		connectDB();
		$result_set = mysqli_query($connect,$query) or die("Ошибка " . mysqli_error($connect));;
		closeDB();		
	}	
	
	function resultSetArray($result_set){  // функция преобразования полученных данных из БД в ассоциативный массив
		$array =array();
		while (($row = $result_set->fetch_assoc()) !=false)
			$array[] = $row;
		return $array;
	}	
	
	
	function closeDB() {  // закрытие соединения с БД
		global $connect;
		mysqli_close($connect);
	}  
	


	
	

?>
