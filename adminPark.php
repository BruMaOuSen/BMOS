<?php 



// Cette page ne sert a rien pour le moment, nous avons reussi a renvoyer les donnees directement dans la page adminCreation

  session_start();
   
    $_SESSION['nomzone'] = $_POST['zone'];
    header("Location: adminCreation.php"); 
    exit; 
?>
