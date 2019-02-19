<?php
	require_once 'database.php';
	
	if(ISSET($_POST['update'])){
		try{
			$id = $_GET['id'];
		    $title = $_POST['title'];
            $description = $_POST['description'];
            $slug = $_POST['slug'];
            $pagetext = $_POST['pagetext'];

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `pages` SET `title` = '$title', `description` = '$description', `slug` = '$slug', `pagetext` = '$pagetext' WHERE `id` = '$id'";
			$conn->exec($sql);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		
		$conn = null;
		header('location:admin.php');
	}
?>