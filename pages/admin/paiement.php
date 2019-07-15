<?php
/**
 * ---------------------------------------------------------------
 * UTILISATION DE LA CLASSE DB QUI SE TROUVE DANS LE NAMESPACE APP
 * ---------------------------------------------------------------
 */
use App\DB;
    $connexion=Db::getDb();
   /**
    * Undocumented function
    *------------------------------------------------
    * PETITE FONCTION PERMETTANT DE DEBOGUER
    *-----------------------------------------------
    * @param [type] $string
    * @return void
    */
    function dd($string){
      var_dump($string);
      die();
     }
    /**
     * ----------------------------
     * LISTE DES VARIABLES UTILISEE
     * ----------------------------
     */
    $tt=null;
    $_SESSION["ok"]="";
    //$_SESSION["m"]="";
    $matEtu=$_SESSION['matEtu'];
    $aff=false;
    $afff=false;
    $affiRest=true;
    $couleur="";
    $couleurr="";
    //$t=['toto','tata'];
    //dd(count($t));
    if(empty($matEtu)){
      /**-----------------------------------
       * LE MATRICULE DE L'ETUDIANT EST VIDE 
       * -----------------------------------
       */
      header('location:index?page=etudiant'); 
      /**---------------------------------
       * REDIRECTION VERS LA PAGE ETUDIANT
       * ---------------------------------
       */
    }else{// SINON 
      
      /**--------------------------------------------------
       * GESTION DES INFORMATIONNS DE L'ETUDIANT
       * --------------------------------------------------
       */
      $req=$connexion->prepare("SELECT * FROM Etudiant WHERE matEtu=?");
      $req->execute([$matEtu]);
      $datas=$req->fetch(PDO::FETCH_OBJ);

      /**
       * ---------------------------------------------------------
       * GESTION DU MATRICULE DEPUIS LA TABLE PAIEMENT
       * ---------------------------------------------------------
       */
      $req=$connexion->prepare("SELECT * FROM paiement WHERE matEtu=? ORDER BY datePaie ASC ");
      $req->execute([$matEtu]);
      $re=$req->fetchAll(PDO::FETCH_OBJ);
      
      //dd($re);
       /**
        *-----------------------------------------
        * TEST SI L'PAIEMENT EXISTE 
        *-----------------------------------------
        */
    if($req->rowCount()>0){
      //$re[0]->codePe=(int)$re[0]->codePe;
      if($re[0]->codePe==1){
        
        /*
        *---------------------------------------
        * L' ETUDIANT A DEJA FAIRE UN PAIEMENT
        *---------------------------------------
        */
        $rest=$re[0]->montantRestPaie;
        $re[0]->statutPaie=(int) $re[0]->statutPaie;
        $_SESSION['codePaie']=$re[0]->codePaie;
        if($re[0]->statutPaie==0){
        /**
        * -----------------------------------------------------
        *LE STATUS DU PREMIER PAIEMENT
        *------------------------------------------------------
        */
              $mon_statut="en attente";
              $aff=false;
              $affiRest=false;
              $couleur="#c9302c";
          }
          else
           {
            if($re[0]->statutPaie==1){ 
              
              /**
              * -----------------------------------------------------
              *LE STATUS DU PREMIER PAIEMENT
              *------------------------------------------------------
              */
                $mon_statut="validé";
                $rest=$re[0]->montantRestPaie;
               $couleur="#449d44";
                $aff=true;
                $affiRest=true;
            } 
            
      
      }
}
/*--------------------------------------
 *SI LE CODE DE LA PERIODE N'EST PAS VIDE
 * -------------------------------------
 */
if(!empty($re[1]->codePe)){
  if($re[1]->codePe==2){
    
    /**
     * -------------------------------------
     * L' ETUDIANT A DEUX PAIEMENT
     * -------------------------------------
     */
   
        $rest=$re[1]->montantRestPaie;
        $re[1]->statutPaie=(int) $re[1]->statutPaie;
        /*--------------------------------------------------------------------------------
         * ENREGISTREMENT DU  CODE DE PAIEMENT DANS LA VARIABLE SESSION AVEC CLE CodePaiee
         *----------------------------------------------------------------------------------
         */
        $_SESSION['codePaiee']=$re[1]->codePaie;
        if($re[1]->statutPaie==0){// si le statut l'etudiant est 0
          /*------------------------------
           * LE STATUT DU PAIEMENT N°2 EST A ZERO
           * ------------------------------
           */
              $mon_statutt="en attente";
              $afff=false;
              $affiRest=false;
              $couleurr="#c9302c";
          }
          else
           {
            
            if($re[1]->statutPaie==1){ 
              /*------------------------------------
              * LE STATUT DU PAIEMENT N°2 EST A ZERO
              * ------------------------------------
              */
                $mon_statutt="validé";
                $rest=(int)$re[1]->montantRestPaie;
               $couleurr="#449d44";
                $afff=true;
                $affiRest=true;
                $desac="disabled";
            } 
     
      }
  
    }
  }

  
 }
}
  /*-----------------------------------------------------------------------------------------------------
   * ============================= AU CLICK SUR LE BOUTTON VALIDE =======================================
   *-----------------------------------------------------------------------------------------------------
  */
    if(isset($_POST["envoyerPaie"])){
      /**-------------------------
       * LE BOUTTON ENVOYER EXISTE
       * --------------------------
       */
      extract($_POST);  
      /**---------------------------
       * LES VARIABLES SONT EXTRAIRE
       * ---------------------------
       */
     if($montantPaie>0){
       $_SESSION['m']="";
        //dd($_POST["montantPaie"]);
      
      $datePaie=date('Y/m/d H:i:s');
     
       
      $veri=$connexion->prepare("SELECT matEtu,montantPaie,montantTotalPaie,montantRestPaie FROM paiement WHERE matEtu=?"); // recuperation des information depuis paiement
      $veri->execute([$matEtu]);
      $re=$veri->fetch(PDO::FETCH_OBJ);
      if($veri->rowCount()==1){
       /**---------------------------------
        * NOUS PASSONS AU DEUXIEME PAIEMENT
        * ---------------------------------
        */
       $montantPaie=(int)$montantPaie;
       $re->montantRestPaie=(int)$re->montantRestPaie;
      
       if($montantPaie==$re->montantRestPaie){
         /**
          * ----------------------------
          * LE MONTANT ENTRER EST EGALE
          * -----------------------------
          */
         $rest=$montantPaie-$re->montantRestPaie;
         $re=$connexion->prepare("INSERT INTO Paiement(codePaie,naturePaie,
         datePaie,montantPaie,matEtu,codePe,numTelTransac,montantRestPaie)VALUES(?,?,?,?,?,?,?,?)") ;
         $re->execute([$codePaie,$naturePaie,$datePaie,$montantPaie,$matEtu,2,$numTelTransac,$rest]);
         $re=$connexion->prepare("SELECT naturePaie,codePaie,datePaie,montantPaie,statutPaie,montantRestPaie  FROM Paiement WHERE codePaie=?");
         $re->execute([$codePaie]);
         $re=$re->fetch(PDO::FETCH_OBJ);
         /**---------------------------------------------------------------------------------------
          * RECUPERATION DES DONNEES JUSTE APRES L'INSERTION DES DONNEES DU DEUXIEME ENREGISTREMENT
          * ---------------------------------------------------------------------------------------
          */
         $re->statutPaie=(int)$re->statutPaie;
         $mon_statutt="en attente";
         $rest= (int)$re->montantRestPaie;
         $afff=false;
         $affiRest=true;
         $couleur="#c9302c";
         $_SESSION['ok']="ok";
         $_SESSION['m']="";
         header("location:index?page=etudiant");
         /**
          * ----------------------------------
          * REDIRECTION VERS LA PAGE ETUDIANT
          * ----------------------------------
          */

       }else{
        /**-------------------------------------------------
         * ERREUR SURVENU LORS DU PAIEMENT DU DEUXIEME RESTE  
         * -------------------------------------------------
         */
         $_SESSION['ok']="ok";
         $_SESSION['m']="Erreur survenue au niveau du reste a payer ";
         
         header("location:index?page=etudiant");
        // dd($_SESSION['m']);
         /**
          * ----------------------------------
          * REDIRECTION VERS LA PAGE ETUDIANT
          * ---------------------------------
          */
       }


      
      }else{// SINON
        $montantPaie=(int)$montantPaie;
        if($montantPaie<=85000){
        /**
         * ---------------------------
         *C 'EST SON PREMIER PAIEMENT
         *----------------------------
         */
        
        $_SESSION['m']="";
        $rest=85000 -$montantPaie;
        $re=$connexion->prepare("INSERT INTO Paiement(codePaie,naturePaie,
         datePaie,montantPaie,matEtu,codePe,numTelTransac,montantRestPaie)VALUES(?,?,?,?,?,?,?,?)") ;
        $re->execute([$codePaie,$naturePaie,$datePaie,$montantPaie,$matEtu,1,$numTelTransac,$rest]);
         /**------------------------------------------
          * INSERTION DES DONNEES DU PREMIER PAIEMENT
          * ------------------------------------------
          */
        $re=$connexion->prepare("SELECT naturePaie,codePaie,datePaie,montantPaie,statutPaie,montantRestPaie  FROM Paiement WHERE codePaie=?");
        $re->execute([$codePaie]);
         /**------------------------------------------
          * SELECTION DES DONNEES DU PREMIER PAIEMENT
          * ------------------------------------------
          */
        $re=$re->fetch(PDO::FETCH_OBJ);
        $re->statutPaie=(int)$re->statutPaie;
        $mon_statut="en attente";
        $rest=$re->montantRestPaie;
        $rest=(int)$rest;
        $aff=false;
        $affiRest=false;
        $couleur="#c9302c";
        $_SESSION['ok']="ok";
         header("location:index?page=etudiant");
        }else{
          $_SESSION['m']="le montant total a payer est 85000";
        }
       }
     }else{
       $_SESSION['m']="Erreur fatale , Veuillez renseigner un montant correcte";
     }
  }
  else
    {
    /**---------------
    * ERREUR DE SAISIR
    * ----------------
    */
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Bienvenue sur votre site d'inscription en de scolarité</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="icon" href="images/favicon.png">
</head>

<style>
	body{
		background:#FFF;
        font-size:12px;
	}

	.box{
		height:400px;
		border:1px solid #fff;
		background:#FFF;
		margin:0 auto;
		box-shadow:0 0 8px #CCC;
		border-radius:3px;
	}

	.bgk img{
		width:100%;
		height:100%;
	}

	.box-l{
		position:fixed;
		top:0;
		bottom:0;
		left:0;
		width:70%;
	}

    .box-l-1{
		position:fixed;
		top:0;
		bottom:0;
		left:0;
		width:35%;
	}

    .box-l-2{
		position:fixed;
		top:0;
		bottom:0;
		left:35%;
		width:35%;
        border-left:1px solid #ccc;
       
	}

    .box-l-2:hover{
        overflow: auto;
    }

    .box-l-1:hover{
        overflow: auto;
    }

	.box-r{
		position:fixed;
		top:0;
		bottom:0;
		right:0;
		width:30%;
        border-left:1px solid #ccc;
        overflow: auto;
	}


    .image{
        border-radius:3px;
        height:150px;
        width:130px;
        border:1px solid #CCC;
    }
.valeur{
  color:#b51c55;
}
.entete{
  color:#b51c55;
}
</style>

<body>

<?php
        ?>
<div id="container">
    <div class="box-l">
        <div class="box-l-1">
              <div class="col-sm-12 p-0">
				<h4 class="pt-3 pl-3 entete" >Profil de l'etudiant<a class="fa fa-home " style="margin-left:180px;color:#fd7e14" title="Accueil" href="index?page=etudiant.php"></a></h4>
       
        <hr>
        
				<div class="col-sm-12" style="font-size:1.7em">
        <!-------------------------------------------------------- -->
        <?php // var_dump($re);?>
        <span style="font-size:1.1em; color:#00a0e3"  > Etudiant <i class="fa fa-graduation-cap"></i> <img style="margin-left:250px;margin-bottom:10px" width="50px" height="50px" src="<?=$datas->photoDestEtu?>" alt=""></span>
      <table class="table table" >
        
        <thead style="font-size:0.7em">
        <tr class="">
          <th>Matricule</th>
          <th>Nom</th>
          <th> Prenom</th>
          <th>Sexe</th>
       </tr>
        </thead>
        <tbody style="font-size:0.7em">
            <tr >
                <td><?= $datas->matEtu?></td>
                <td><?=$datas->nomEtu?></td>
              <td><?=$datas->prenomEtu?></td>
              <td><?= $datas->genreEtu?></td>
          </tr>

    </tbody>
</table>
<table class="table " >
        
        <thead style="font-size:0.6em">
        <tr class="">
          <th>Fliere</th>
          <th>Email</th>
          <th>Tel</th>
          <th>Statut</th>
       </tr>
        </thead>
        <tbody style="font-size:0.7em">
            <tr >
                <td><?= $datas->codeFil?></td>
                <td><?=$datas->emailEtu?></td>
              <td><?=$datas->telEtu?></td>
              <td><?= $datas->statutEtu?></td>
          </tr>

    </tbody>
</table>
<span style="font-size:1.1em;color:#00a0e3"  >Parent <i class="fa fa-users"></i></span>
<table class="table table-bordered" >
        
        <thead style="font-size:0.6em">
        <tr class="success">
         
          <th>Nom</th>
          <th> Prenom</th>
          <th>Ville</th>
          <th>Profession</th>
          <th>Tel</th>
       </tr>
        </thead>
        <tbody style="font-size:0.8em">
            <tr >
                <td><?= $datas->nomParEtu?></td>
                <td><?=$datas->prenomParEtu?></td>
              <td><?=$datas->villeParEtu?></td>
              <td><?= $datas->professionParEtu?></td>
              <td><?= $datas->telEtu?></td>
          </tr>

    </tbody>
</table>
<span style="font-size:1.1em;color:#00a0e3" >Corespondant <i class="fa fa-phone"></i></caption>
<table class="table table-bordered" >
        
        <thead style="font-size:0.6em">
        <tr class="warning">
          <th>Nom</th>
          <th> Prenom</th>
          <th>Ville</th>
          <th>Profession</th>
          <th>Tel</th>
       </tr>
        </thead>
        <tbody style="font-size:0.6em">
            <tr >
                <td><?= $datas->nomCoresEtu?></td>
                <td><?=$datas->prenomCoresEtu?></td>
              <td><?=$datas->villeCoresEtu?></td>
              <td><?= $datas->professionCoresEtu?></td>
              <td><?= $datas->telCoresEtu?></td>
          </tr>

    </tbody>
</table>
        <!--------------------------------------------------------- --->

        <?php   // var_dump($rest);//var_dump($rest); //var_dump( $montantPayer);  var_dump($_POST); var_dumpre) ;var_dump($re->statutPaie); //var_dump($tt['codePaie']);// var_dumpre['naturePaie'])?>
              
                  

				</div>
      </div>
    </div>
    <div class="box-l-2">
            <div class="col-sm-12 p-0">
	  <h4 class="pt-3 pl-3 entete" >Tableau des versements</h4>
        
        <div class="col-sm-12">
          <table class="table">
					<thead>
						<tr style="color:#0056b3">
						<th scope="col"><i class="fa fa-bookmark"></i>Type</th>
						<th scope="col"><i class="fa fa-eye"></i>référence</th>
						<th scope="col"><i class="fa fa-clock-o"></i>Date</th>
						<th scope="col"><span class="fa fa-dollar"></span>Montant</th>
						<th scope="col"><i class="fa fa-lightbulb-o"></i> Statut</th>
						</tr>
					</thead>
					<tbody>
            <!-- ====================AUTOMATISATION DES VERSEMENT ====================== -->
              
                  <tr>
                      <th scope="row"><?=$naturePaie=!empty($re[0]->naturePaie)? $re[0]->naturePaie: ""?></th>
                      <td><?=$codePaie=!empty($re[0]->codePaie)?$re[0]->codePaie: ""?></td>
                      <td>
                      <?=$datePaie=!empty($re[0]->datePaie)? $re[0]->datePaie: ""?>
                      </td>
                      <td>
                      <?=$montantPaie=!empty($re[0]->montantPaie)? $re[0]->montantPaie: ""?>							
                      </td>
                      <!-- ---------------GESTION DES STATUS---------------------   -->
                      <td>
                        <?php //dd($couleur)?>
                            <span class="badge " style="font-size:1.2em;color:#fff; background :<?=$coul=!empty($couleur)?$couleur:'#fff';?>"> <?=$mm=!empty($mon_statut)? $mon_statut:"" ?></span> <!-- danger=#c9302c succes=#449d44 -->
                                                    
                      </td>
                    <!-- ---------------/GESTION DES STATUS---------------------   -->
                  </tr>
                  <tr>
                      <th scope="row"><?=$naturePaie=!empty($re[1]->naturePaie)? $re[1]->naturePaie: ""?></th>
                      <td><?=$codePaie=!empty($re[1]->codePaie)?$re[1]->codePaie: ""?></td>
                      <td>
                      <?=$datePaie=!empty($re[1]->datePaie)? $re[1]->datePaie: ""?>
                      </td>
                      <td>
                      <?=$montantPaie=!empty($re[1]->montantPaie)? $re[1]->montantPaie: ""?>							
                      </td>
                      <!-- ---------------GESTION DES STATUS---------------------   -->
                      <td>
                        <?php //var_dump($couleur)?>
                            <span class="badge " style="font-size:1.2em;color:#fff; background :<?=$coul=!empty($couleurr)?$couleurr:'#fff';?>"> <?=$mm=!empty($mon_statutt)? $mon_statutt:"" ?></span> <!-- danger=#c9302c succes=#449d44 -->
                                                    
                      </td>
                    <!-- ---------------/GESTION DES STATUS---------------------   -->
                  </tr>
             
              <!-- ==================== /AUTOMATISATION DES VERSEMENT ====================== -->
              <tbody>
            
						</tbody>
					</table>
          <hr>
          <?php// var_dump($aff)?>
					<p  style="display:<?=$af=($aff)?'block' :'none'?>;">Cliquer sur le bouton ci-dessous pour imprimer votre reçu de paiement</p>
					<a target="_bank" type="button"  href="index?page=codeInscription&recu=1" style="display:<?=$af=($aff)?'block' :'none'?>;width:200px;margin-left:0px" class="btn btn-success btn-sm" >Imprimer le 1er reçu</a>
          <a target="_bank" type="button"  href="index?page=codeInscription&recu=2" style="display:<?=$aff=($afff)?'block' :'none'?>;width:200px;margin-top:.-10px" class="btn btn-success btn-sm pull-right" >Imprimer le 2ème reçu</a>
        </div>
        
        </div>   
      <div   style="color:red;margin-left:0px;margin-top:150px;border-radius:0px 0px 0px 0px">
                  <?php 
                 // var_dump($titi);
                  //  die();
                  ?>
                 
           <span class="alert alert-danger "style="width:250px;display:<?=$re=($affiRest==true)?'block':'none'?>;text-align:center;font-size:1.2em">Reste à payer: <strong> <?=$rest=isset($rest)?$rest:"85000";?> Fcfa</strong> </span> 
           
      </div> 
     <img id="logo" style="margin-top:40px;margin-left:120px" src="images/logo.png"/>
    </div>
    
	</div>
  
	<div class="box-r">
			<div class="col-sm-12 p-0">
				<h4 class="pt-3 pl-3 entete">Formulaire de paiement</h4>
        <hr>    
      </div>
            <div class="col-sm-12">
            <form autocomplete="off" action="" method="POST">  
            <div  style="display:<?=$mym=!empty($_SESSION['m'])?"block":"none"?>" class="alert alert-danger">
              <?=$m=isset($_SESSION['m'])?$_SESSION['m']:""?>
                
            </div>              
            <div class="alert alert-info">
                 choisissez votre mode de paiement
            </div>
            
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" <?=$desac=!empty($desac)?$desac:""?> checked name="naturePaie" value="banque" id="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1"><i class="fa fa-cc-mastercard"></i> virement bancaire</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" <?=$desac=!empty($desac)?$desac:""?> name="naturePaie" value="mobile" id="customRadioInline2" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2"><i class="fa fa-phone"></i> virement électronique</label>
                </div>
                <label for="basic-url" class="mt-3">Entrer la reférence de paiment</label>
                <div class="input-group mb-6 col-md-12">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">reférence de paiement</span>
                </div>
                <input type="text" <?=$desac=!empty($desac)?$desac:""?> required value=""  name="codePaie"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div>
                <label for="basic-url">Entrer le numéro de tétéphone</label><br>
                <small><i class="fa fa-tablet"></i> Celui avec lequel vous avez effectuer le paiement</small>
                <div class="input-group mb-3 col-md-12">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">  Téléphone</span>
                </div>
                <input type="text"   minlength="8" maxlength="8"<?=$desac=!empty($desac)?$desac:""?> required value="" name="numTelTransac" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div>
                <label for="basic-url"><i class="fa fa-dollar"></i> Entrer le montant viré</label>
                <div class="input-group mb-6 col-md-12">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Montant</span>
                </div>
                <input type="text" <?=$desac=!empty($desac)?$desac:""?> aria-required="" required  value=""  name="montantPaie"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div><br>
                <input type="submit"   <?=$desac=!empty($desac)?$desac:""?> name="envoyerPaie" value="valider le paiement" class="btn btn-primary">
                </form>
            </div>
	</div>
</div>
</body>
    <script src="http://localhost/projet_hibi/assets/js/jquery-3.4.1.min.js"></script>
    <script src="http://localhost/projet_hibi/assets/js/bootstrap.min.js"></script>
    <script src="http://localhost/projet_hibi/assets/js/html2canvas.js"></script>
    <script src="http://localhost/projet_hibi/assets/js/jspdf.js"></script>
    <script>
        $(document).ready(function(){
          function toto(){
            $('#logo').fadeOut(1000);
            $('#logo').fadeIn(1000);
          }
         
          setInterval(toto,1000);
        });
    </script>
</html>