<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'database.php';
    
    try{
      $title = $_POST['title'];
      $description = $_POST['description'];
      $slug = $_POST['slug'];
      $pagetext = $_POST['pagetext'];

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO `pages` (`title`, `description`, `slug`, `pagetext`) VALUES ('$title', '$description', '$slug', '$pagetext') ";
      $conn->exec($sql);
    }catch(PDOException $e){
      echo $e->getMessage();
    }
    
    $conn = null;
    header('location:admin.php');
  }