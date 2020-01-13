<?php
	
	function getСolumnNameWithMeta ($connect)
	{
		$query = "SELECT * FROM suppliers,shipments WHERE 1 = 0";
		if (!($result = mysqli_query ($connect,$query)))
			return (FALSE);
		echo "<table border='1' align='center'>";
		echo "<tr><th>Таблица</th><th>Поле</th><th>Тип</th><th>Длинна</th></tr>";
		for ($i = 0; $i < mysqli_num_fields ($result); $i++)
		{
			if ($field = mysqli_fetch_field ($result))
				echo "<tr>";
				echo "<td>".$field->table."</td>";
				echo "<td>".$field->name."</td>";
				echo "<td>".$field->type."</td>";
				echo "<td>".$field->length."</td>";
				echo "</tr>";
		}
		echo "</table>";
		mysqli_free_result ($result);
	}	
	
	
	function insertDataAndView($connect)
	{
		mysqli_query($connect,"INSERT INTO suppliers(name,country,city,telephone) values ('HocoRus','Россия','Москва','(8453) 79-10-01 ')");
		mysqli_query($connect,"INSERT INTO suppliers (name,country,city) values ('CREDO','Китай','Гонконг') ");
		mysqli_query($connect,"INSERT INTO suppliers (name,country,city,telephone) values ('ИП Фофанов И.М.','Россия','Санкт-Петербург','(812) 346-68-70') ");
		mysqli_query($connect,"INSERT INTO suppliers (name,country,city,telephone) values ('IPHONE MSK','Россия','Москва',' (8482) 75-80-00') ");
		mysqli_query($connect,"INSERT INTO suppliers (name,country,city) values ('E-tiger','Китай', 'Шанхай') ");
		
		$rows = resultSetArray(mysqli_query($connect,"SELECT * FROM suppliers ORDER BY id ASC"));			
		echo "<br>Таблица suppliers:<br>";		
		echo "<table border='1' align='center' width='600'>";
		echo "<tr><th>ID</th><th>Название</th><th>Страна</th><th>Город</th><th>Телефон</th></tr>";
		foreach ($rows as $item)
		{
			echo "<tr>";
			echo "<td>".$item['id']."</td>";
			echo "<td>".$item['name']."</td>";
			echo "<td>".$item['country']."</td>";
			echo "<td>".$item['city']."</td>";
			echo "<td>".$item['telephone']."</td>";
			echo "</tr>";
		}
		echo "</table><br>";
		
		mysqli_query($connect,"INSERT INTO shipments (id_suppliers,tovar,kol,price,data) values ('1','HONOR V 30 + HONOR BAND 5',113,599,'2019.11.10')");
		mysqli_query($connect,"INSERT INTO shipments (id_suppliers,tovar,kol,price,data) values ('1','XIAOMI MI NOTE 10 + XIAOMI 8 T',76,399,'2018.11.22')");
		mysqli_query($connect,"INSERT INTO shipments (id_suppliers,tovar,kol,price,data) values ('3','ONEPLUS 7T',15,399,'2019.09.12')");
		mysqli_query($connect,"INSERT INTO shipments (id_suppliers,tovar,kol,price,data) values ('4','iPHONE 11 64 Gb',50,649,'2018.09.10')");
		mysqli_query($connect,"INSERT INTO shipments (id_suppliers,tovar,kol,price,data) values ('5','HUAWEI MATE 30 PRO + HUAWEI WATCH GT 2',70,699,'2018.11.22')");
		mysqli_query($connect,"INSERT INTO shipments (id_suppliers,tovar,kol,price,data) values ('1','ONEPLUS 7T',89,499,'2019.09.12')");
		mysqli_query($connect,"INSERT INTO shipments (id_suppliers,tovar,kol,price,data) values ('4','iPHONE XS 128 Gb Dual SIM',36,699,'2020.01.01')");
		
		$rows = resultSetArray(mysqli_query($connect,"SELECT shipments.*,suppliers.name,shipments.kol*shipments.price as 'summa' FROM shipments LEFT JOIN suppliers ON suppliers.id=shipments.id_suppliers ORDER BY id ASC"));	echo "<br>Таблица shipments:<br>";		
		echo "<table border='1' align='center' width='600'>";
		echo "<tr><th>Поставщик</th><th>Товар</th><th>Кол-во</th><th>Цена(USD)</th><th>Дата поставки</th><th>Сумма</th></tr>";
		foreach ($rows as $item)
		{
			echo "<tr>";
			echo "<td>".$item['name']."</td>";
			echo "<td>".$item['tovar']."</td>";
			echo "<td>".$item['kol']."</td>";
			echo "<td>".$item['price']."</td>";
			echo "<td>".$item['data']."</td>";
			echo "<td>".$item['summa']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	function showShipmentsHocoRus2019Over3000($connect)
	{
		echo "<br><b>Запрос №1:</b> Вывести все поставки HocoRus в 2019 году на сумму более 30000 USD и отсортировать по дате по возрастанию<br>";
		$rows = resultSetArray(mysqli_query($connect,"SELECT shipments.*,suppliers.name,shipments.kol*shipments.price as 'summa' FROM shipments LEFT JOIN suppliers ON suppliers.id=shipments.id_suppliers 
														WHERE id_suppliers=1 AND shipments.kol*shipments.price>30000 AND year(data)=2019 ORDER BY data ASC"));			
		echo "<table border='1' align='center' width='600'>";
		echo "<tr><th>Поставщик</th><th>Товар</th><th>Кол-во</th><th>Цена(USD)</th><th>Дата поставки</th><th>Сумма</th></tr>";
		foreach ($rows as $item)
		{
			echo "<tr>";
			echo "<td>".$item['name']."</td>";
			echo "<td>".$item['tovar']."</td>";
			echo "<td>".$item['kol']."</td>";
			echo "<td>".$item['price']."</td>";
			echo "<td>".$item['data']."</td>";
			echo "<td>".$item['summa']."</td>";
			echo "</tr>";
		}
		echo "</table>";
		
	}
	
	function allShipmentsBySupplier($connect)
	{
		echo "<br><b>Запрос №2:</b> Вывести общую стоимость поставок по поставщикам по годам и отсортировать по году и поставщику по возрастанию<br>";		
		$rows = resultSetArray(mysqli_query($connect,"SELECT name,id_suppliers,round(sum(price*kol),2) as 'summa',year(data) as 'god'  FROM shipments,suppliers WHERE shipments.id_suppliers = suppliers.id GROUP BY 			shipments.id_suppliers,year(data)  ORDER BY year(data),name ASC"));			
		echo "<table border='1' align='center' width='600'>";
		echo "<tr><th>Поставщик</th><th>Сумма</th><th>Год</th></tr>";
		foreach ($rows as $item)
		{
			echo "<tr>";
			echo "<td>".$item['name']."</td>";
			echo "<td>".$item['summa']."</td>";
			echo "<td>".$item['god']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}

	
	function delDB($connect){		
		$query = "DROP DATABASE lab4 ";
		if (mysqli_query($connect,$query)) {
			echo "<br><br>База данных успешно удалена<br><br>";
		} else {
			echo '<br><br>Ошибка при удалении базы данных: ' . mysqli_error($connect) . "<br></br>";
		}		
		mysqli_close($connect);
	}
	
	
	
	$host = "localhost";
	$users = "root";
	$password = "";
	$database = "lab4";	
	$connect = mysqli_connect($host, $user, $password);	
	if (!$connect) {
		die('Ошибка соединения: ' . mysqli_error($connect));
	}	
	
	$query = "CREATE DATABASE IF NOT EXISTS ".$database." ";
	if (mysqli_query($connect,$query)) {
		echo "База '$database' успешно создана <br>";
	} else {
		echo 'Ошибка при создании базы данных: ' . mysqli_error($connect) . "\n";
	}
	
	mysqli_select_db($connect,$database);
	
	$query = "CREATE TABLE IF NOT EXISTS suppliers (
        id integer not null auto_increment primary key,
        name varchar(65) not null,
        country integer not null,
		city varchar(50) not null)";
	
	if (mysqli_query($connect,$query)) {
		echo "Таблица suppliers успешно создана <br>";
	} else {
		echo 'Ошибка при создании таблицы suppliers: ' . mysqli_error($connect) . "\n";
	}
	
	$query = "CREATE TABLE IF NOT EXISTS shipments (
        id integer not null auto_increment primary key,
		id_suppliers integer not null,
        tovar varchar(70) not null,
        kol integer not null,
		price float not null,
		data date not null)";
	
	if (mysqli_query($connect,$query)) {
		echo "Таблица shipments успешно создана <br>";
	} else {
		echo 'Ошибка при создании таблицы shipments: ' . mysqli_error($connect) . "\n";
	}	
	
	echo "<br>Структура базы данных";
	getСolumnNameWithMeta($connect);    // выводим структуру БД до изменения
	echo "<br><br>";
	
	

	
	
	
	$query = "ALTER TABLE suppliers MODIFY country varchar(40) not null, ADD telephone varchar(20)";	
	if (mysqli_query($connect,$query)) {
		echo "Структура таблицы suppliers успешно изменена\n";
	} else {
		echo 'Ошибка при изменении таблицы suppliers: ' . mysqli_error($connect) . "\n";
	}	
	echo "<br>";
	
	$query = "ALTER TABLE shipments ADD CONSTRAINT `FK_suppliers_suplier` FOREIGN KEY(id_suppliers) REFERENCES suppliers(id)";	
	if (mysqli_query($connect,$query)) {
		echo "Структура таблицы shipments успешно изменена\n";
	} else {
		echo 'Ошибка при изменении таблицы shipments: ' . mysqli_error($connect) . "\n";
	}	
	
	echo "<br>Измененная структура базы данных";
	getСolumnNameWithMeta($connect);	         // выводим структуру БД после изменения
	insertDataAndView($connect);                     // заполняем таблицы и выводим их
	showShipmentsHocoRus2019Over3000($connect);      // запрос №1
	allShipmentsBySupplier($connect);                                // запрос №2
	
	//mysqli_query($connect,"DROP TABLE IF EXISTS suppliers, shipments");
	//mysqli_close($connect);
	delDB($connect);
?>
