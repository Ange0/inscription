<?php
	use App\DB;
  $message="";
  
  if(isset($_SESSION['ok'])&& $_SESSION['ok']=="ok"){
    header("location:index?page=paiement");
  }
	if(isset($_POST["Envoyer"]) && !empty($_POST["Envoyer"])){
		$connexion=Db::getDb();
		$matEtu=$_POST['matEtu'];
		$req=$connexion->prepare("SELECT matEtu FROM Etudiant WHERE MatEtu=?");
		$req->execute([$matEtu]);
		if($req->rowCount()){
			$message="code trouver";
			$donnee=$req->fetch(PDO::FETCH_OBJ);
			$_SESSION['matEtu']=$donnee->matEtu;
			var_dump($_SESSION['matEtu']);
      $display="none";
      header("location:index?page=paiement");
      

		}else{
      $message="Matricule introuvable,Veuillez renseigner votre matricule ou contacter votre administrateur.";
      $display="block";
		}
	}
	



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.png">

    <title>Bienvenu à IHBI</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">

 

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link href="css/carousel.css" rel="stylesheet">
  </head>

  <body style="background:url(images/slide02.jpg) no-repeat;width:100%" >
<?php // var_dump($message)?>
    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">
				<div style="display:<?=$d=!empty($display)? $display: "none"?>" class="row" class="margin-top:10px">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable  " style="text-align:center">
                <button class="close" data-dissmis="alert" aria-hidden="true">
                        &times;
                </button>
                  <?= $message?>
                  </div>
                    
                </div>
        </div>

          <div class="masthead clearfix">
            <div class="inner">
              <span class="masthead-brand"> <img width="100px" src="images/im3.png" alt=""></span>
              <nav>
                <ul class="nav masthead-nav">
                  <!--<li class="active"><a href="#">Acceuil</a></li> -->
                 <!-- <li><a href="#">Paiement</a></li>
                  <li><a href="#">Contact</a></li>-->
                </ul>
              </nav>
            </div>
          </div>

          <div class="">
            <h1 class="cover-heading"  style="color:#b51c55;font-size:2.8em;color:#f24e8b">BIENVENU SUR VOTRE ESPACE ETUDIANT</h1>
            <p class="" ><marquee>Envue de la validation et du paiement de votre inscription vueillez saisir votre numero de  matricule dans le champs ci-dessous</marquee></p>
           	<form  autocomplete="off" action="" method="Post" class="form ">
							 <input class="form-control" type="text" placeholder=" EX:101XXX94" name="matEtu">
							 <input style="margin-top:10px" type="submit" name="Envoyer" class="btn btn-primary" value="Envoyer">
						 </form>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>Creer <a href="http://getbootstrap.com">Ihbi site</a>, by <a href="https://twitter.com/mdo">AngeloDev</a>.</p>
            </div>
          </div>
					
				</div>
			

			</div>
			

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
