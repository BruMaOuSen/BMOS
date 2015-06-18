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
        $bdd = new PDO('pgsql:host=tuxa.sme.utc;dbname=dbnf17p136', 'nf17p136', '6hQyKlYO');
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
              <button type="submit" class="btn btn-primary form-control">Je m'abonne!</button>
            </div>  
          </form>
        </div>
      </div>
      <?php
      }
      else
      {
        $login = $_SESSION['membreid'];
        $reponse1 = $bdd->query("SELECT * FROM transac WHERE client = '$login' and type_t = 'abonnement'");
        $donnees1 = $reponse1->fetch();
      ?>
        <div class="container">
          <div class="alert btn-success alert-dismissable col-md-offset-3 col-md-6" style="margin-bottom: 10px;">
            <h5 style="margin-bottom: 10px;">Vous êtes abonné à nos parkings.</h5>
            <div>                                          
              L'abonnement est effectif depuis le : <?php echo $donnees1['date_debut'];?> et se terminera le : <?php echo $donnees1['date_fin'];?>
            </div>
            <br/>
            <form method="post" action="desabonnement.php">
              <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Je me désabonne!</button>
              </div>
            </form>  
          </div>
        </div>
      <?php
      }
      $reponse1->closeCursor();
      $reponse->closeCursor();
      $login = $_SESSION['membreid'];
      $reponse2 = $bdd->query("SELECT * FROM transac WHERE client = '$login'");
      ?>
      <section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
        <table class="table table-bordered table-striped">
          <caption>
            <h4 style="text-align: center">Historique des transactions liées au compte client : <?php echo $login; ?></h4>
          </caption>
          <thead>
            <tr>
              <th style="text-align: center">Type de transaction</th>
              <th style="text-align: center">Prix</th>
              <th style="text-align: center">Moyen de paiement</th>
              <th style="text-align: center">date d'achat</th>
            </tr>
          </thead>
          <tbody> 
          <?php
              while ($donnees2 = $reponse2->fetch())
              {
          ?>  
                <tr>  
                  <th style="text-align: center"><?php echo $donnees2['type_t'];?></th> 
                  <th style="text-align: center"><?php echo $donnees2['prix'];?></th>
                  <th style="text-align: center"><?php echo $donnees2['moyen_p'];?></th>
                  <th style="text-align: center"><?php echo $donnees2['date_achat'];?></th>
                </tr> 
          <?php
              }
         ?>
          </tbody>
        </table>
      </section>
    </body>
</html>