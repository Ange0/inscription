<?php
use App\DB;
  $active="disabled";
    $connexion=Db::getDb();
    if($connexion==true){
       var_dump($_POST);
        if(isset($_POST["envoyerFil"]) && !empty($_POST["envoyerFil"])){
           extract($_POST);
             $req=$connexion->prepare("INSERT INTO filiere(codeFil,libFil,typeFil) VALUES(?,?,?)");
              $req->execute([$codeFil,$libFil,$typeFil]);
              if($req){
                echo "donnee enregistrer";
              }
            }else{
              $message="code incorecte...........";
            }
    }
    else
    {
        echo "connexion echouer";
    }
    
?>
<!DOCTYPE html>                                                                 
<html>
<head>
	<title>Bienvenu sur la Classe et filiere</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
    <!------------------ MENU ------------------------------------->
     <nav class="navbar navbar-default navbar-fixed-top" style="background:#fff">
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

    <marquee> <h1 style="margin-top:;margin-top: 80px;color: grey">BIENVENUE SUR VOTRE PAGE DE PAIEMENT</h1></marquee>
    <?= $message= isset($message)?$message:""?>
    <!------------------ /MENU ------------------------------------->
	<div class="container-fluid" style="margin-top:10px;">
        <div class="row">
            <!-------------  FILIERE -------------------------- -->
            <div class="col-md-4 col-md-offset-2 " > 
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background:#0768d7">
                       <img width="50px" src="images/symbole.png"> <span style="text-align:center;margin-left:100px;font-size:1.4em" >FILIERE</span>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST">
                        <div class="form-group">
                                    <label for="codeFil">Code Filiere</label>
                                    <select name="codeFil"  class="form-control">
                                      <option></option>
                                    <optgroup label="INDUSTRIELLE">
                                      <option>IDA</option>
                                      <option>RIT</option>
                                      <option>2MA</option>
                                      <option>MSP</option>
                                    </optgroup>
                                    <optgroup label="TERTIARE">
                                      <option value="">RHC1</option>
                                      <option>RHC</option>
                                      <option>GEC</option>
                                      <option>FCG</option>
                                    </optgroup>
                                 </select>
                            </div>
                                <div class="form-group">
                                <label >Libellé</label>
                                 <select name="libFil"value="<?=$libFil=isset($libFil)?$libFil:''?>"  class="form-control">
                                    <option></option>
                                    <option >Informatique Developpeur D' Application</option>
                                    <option>Reseau Informatique et Telecomunication</option>
                                    <option>Maintenance des Systeme de Production</option>
                                    <option>RH...........</option>
                                 </select>
                             </div>
                              <div class="form-group">
                                <label >Type</label>
                                 <select name="typeFil"value="<?=$typeFil=isset($typeFil)?$typeFil:''?>"  class="form-control">
                                    <option></option>
                                    <option >Industrielle</option>
                                    <option>Tertiaire</option>
                                 </select>
                             </div>
                            
                            <input type="submit" class=" btn btn-primary"  name="envoyerFil" value="Envoyer" >
                            <input type="reset" name="" value="Annuler" class=" btn btn-danger">
                            
                         
                        </form>
                    </div>
                 </div>  
              </div>
               <!-------------  /FILIERE-------------------------- -->
                      <!-------------  CLASSE -------------------------- -->
            <div class="col-md-4  " > 
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background:#0768d7">
                       <img width="50px" src="images/symbole.png"> <span style="text-align:center;margin-left:100px;font-size:1.4em" >CLASSE</span>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST">
                        <div class="form-group">
                                <label for="codeClas">Code Classe</label>
                                    <select <?= $active?> name="codeFil"  class="form-control">
                                      <option></option>
                                    <optgroup label="INDUSTRIELLE">
                                      <option>IDA1</option>
                                      <option>IDA2</option>
                                      <option>RIT1</option>
                                      <option>RIT2</option>
                                      <option>2MA1</option>
                                      <option>2MA2</option>
                                      <option>MSP1</option>
                                      <option>MSP2</option>
                                    </optgroup>
                                    <optgroup label="TERTIARE">
                                      <option value="">RHC1</option>
                                      <option>RHC1</option>
                                      <option>RHC2</option>
                                      <option>GEC1</option>
                                      <option>GEC2</option>
                                      <option>FCG1</option>
                                      <option>FCG2</option>
                                    </optgroup>
                                 </select>
                            </div>
                                <div class="form-group">
                                <label >Libellé</label>
                                 <select <?= $active?> name="codeClas"value="<?=$libClas=isset($libClas)?$libClas:''?>"  class="form-control">
                                    <option></option>
                                    <option >Informatique Developpeur D' Application</option>
                                    <option>Reseau Informatique et Telecomunication</option>
                                    <option>Maintenance des Systeme de Production</option>
                                    <option>RH...........</option>
                                 </select>
                             </div>
                            <input type="submit" <?= $active?> class=" btn btn-primary" name="envoyerClas"  value="Envoyer" >
                            <input type="reset" <?= $active?> name="" value="Annuler" class=" btn btn-danger">
                             
                         
                        </form>
                    </div>
                 </div>  
            </div>
               <!-------------  /CLASSE-------------------------- -->
            </div>
               

          
            
          </div>   
               
         </div>
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="alert alert-success alert-dismissable  " style="text-align:center">
		 				<button class="close" data-dissmis="alert" aria-hidden="true">
														 &times;
						</button>
					     Success ! Well done its submitted
                </div>
                
            </div>
        </div>
</body>
</html>