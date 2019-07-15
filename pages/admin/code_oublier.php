<?php
//var_dump($_POST);

use App\DB;
$message;
    
    if(isset($_POST["envoyerCode"]) && !empty($_POST["envoyerCode"])){
      $connexion=Db::getDb();
      extract($_POST);// extraction de toutes les cle de la variable globale
      $req=$connexion->prepare("SELECT keyEtu FROM Etudiant WHERE matEtu=?");
      $req->execute([$matEtu]);
      if($req->rowCount()){
          $message="code correcte";
          $data=$req->fetch(PDO::FETCH_ASSOC);
          var_dump($data);
          $message=$data["keyEtu"];
          $_SESSION['codePaie']=$data['keyEtu'];
          $verify=true;
        //var_dump($_SESSION['codePaie']);*/
      }else{
        $message="code Incorrecte !!!";
        $verify=false;
        
      }
    }
?>
<!DOCTYPE html>                                                                 
<html>
<head>
	<title>Bienvenu sur Votre paiement</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
    <!------------------ MENU ------------------------------------->
     <nav class="navbar navbar-default" style="background:#fff">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img width="120px" src="images/logo.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="?page=etudiant">Inscription</a></li>
            <li><a href="?page=codeInscription">Votre fiche</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">Default</a></li>
            <li><a href="../navbar-static-top/">Static top</a></li>
            <li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <marquee> <h1 style="margin-top: 80px;color: grey">BIENVENUE SUR VOTRE PAGE DE CODE OUBLIER</h1></marquee>
    <?php //$message= isset($message)?$message:"";
    // var_dump($keyPaie);
    //var_dump($message);
    ?>

    <!------------------ /MENU ------------------------------------->
	<div class="container-fluid" style="margin-top:10px;">
        
        <div class="row">
            <!-------------  PAIEMENT -------------------------- -->
            <div class="col-md-4 col-md-offset-4 " > 
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background:#0768d7">
                       <img width="50px" src="images/symbole.png"> <span style="text-align:center;margin-left:70px;font-size:1.4em" > Code OUBLIER ??</span>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="codePaie">Matricule</label>
                                <input type="text" name="matEtu" autofocus="" class="form-control" placeholder="" value="<?=$matEtu=isset($matEtu)?$matEtu:''?>" required="">
                            </div>
                            <input type="submit" class=" btn btn-primary btn-block" name="envoyerCode" value="Envoyer" >
                        </form>
                    </div>
                   
                 </div>  
              </div>
              <?php
                    if(!empty($message) AND $verify==false){?> 
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <div class="alert alert-danger alert-dismissable  " style="text-align:center">
                            <button class="close" data-dissmis="alert" aria-hidden="true">
                                    &times;
                            </button>
                            <strong> <?= $message?></strong>
                            </div>
                                
                            </div>
                        </div>
                    <?php
                    }else
                    if(!empty($message) AND $verify==true)
                    {?>
                     
                     <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <div class="alert alert-success alert-dismissable  " style="text-align:center">
                            <button class="close" data-dissmis="alert" aria-hidden="true">
                                    &times;
                            </button>
                            <strong> VOTRE CODE EST : <?= $message?></strong>
                            <a href="index?page=codeInscription"><strong class="pull-right" style="color:#b51c55">Tirer ma fiche</strong></a>
                            </div>
                                
                            </div>
                        </div>
                     <?php
                    }
                ?>
      
     

</body>
</html>