<?php 
  session_start();
  if(!isset($_SESSION['authentification'])){
    header("Location: index.php");  
  }
  else
  {
    if($_SESSION['roleutil']!='client'){
      header("Location: index.php");
      exit;   
    }
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
      <link href="style.css" rel="stylesheet">
      <meta charset="utf-8">
        <title>UPARK <?php echo $_SESSION['membreid'];?></title>
    </head>
    <body>
      <!--INSERTION DU HEADER-->
      <?php include ('header.php'); ?>  

      <!--INSERTION DU MENU-->    
      <?php include('menuClient.php');?>

      <!--CORPS DE LA PAGE DE GESTION D'ABONNEMENT-->     
      <?php
      try
      {
        $bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
      }
      catch (Exception $e)
      {
            die('Erreur : ' . $e->getMessage());
      }
      ?>

      <?php
        $login = $_SESSION['membreid'];
        $reponse = $bdd->query("SELECT abonne FROM client WHERE login = '$login'");
        $donnees = $reponse->fetch();

      if($donnees['abonne'] == FALSE)
      {
      ?>
      <div class="container">
        <div class="alert btn-success alert-dismissable col-md-offset-3 col-md-6" style="margin-bottom: 10px;">
          <h5 style="margin-bottom: 10px;">Vous n'êtes toujours pas abonné à notre service. N'hésitez plus et profitez dès maintenant de nos tarifs préférentiels.</h5><br/>
          <form method="post" action="abonnement.php">
            <div class="form-group">
              <h5>Une carte d'abonnement coûte :</h5><br/>
              - 200€ pour 1 mois d'abonnenemt.<br/>
              - 175€ pour 3 mois d'abonnement.<br/>
              - 150€ pour 6 mois d'abonnement.<br/>
              - 100€ pour 1 an d'abonnement.<br/><br/>
              <h5>Prendre un abonnement pour une période de :</h5> 
            </div>
            <div class="form-group">
              <select name="periodeAbonnement" class="selectpicker form-control">
                <option>
                  1 mois  
                </option>
                <option>
                  3 mois
                </option>
                <option>
                  6 mois
                </option>
                <option>
                  1 an
                </option>    
              </select> 
            </div>
            <div class="form-group">
              <h5>Moyen de paiement pour le réglement :</h5>
            </div>  
            <div class="form-group">         
              <select name="modePaiement" class="selectpicker form-control">
                <option>
                  Carte bancaire  
                </option>
                <option>
                  Liquide
                </option>
              </select> 
            </div>  
            <div class="form-group">
              <input type="date" name="anniversaire">
              <button type="submit" class="btn btn-primary form-control">Je m'abonne!</button>
            </div>
          </form>
        </div>
      </div>
      <?php
      }
      else
      {
      ?>
      <div class="container">
        <div class="alert btn-success alert-dismissable col-md-offset-3 col-md-6" style="margin-bottom: 10px;">
          <h5 style="margin-bottom: 10px;">C'est bien mec t'es abonné!.</h5>
          <form method="post" action="desabonnement.php">
            <div class="form-group">
              <button type="submit" class="btn btn-primary form-control">Je me désabonne!</button>
            </div>
          </form>  
        </div>
      </div>
      <?php
      }
      ?>
    </body>
</html>