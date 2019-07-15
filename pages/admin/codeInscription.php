<?php
use App\DB;
$connexion=Db::getDb();

//die();
//var_dump($keyEtu);

$_GET['recu']=(int)$_GET['recu'];
//var_dump($_GET);
//var_dump($_SESSION['codePaie']);
//die();
if(is_null($_SESSION['codePaie']) && is_null($_SESSION['codePaiee']) ){
    header("location:index?page=paiement");
}
else{
    if($_GET['recu']===1 && isset($_SESSION['codePaie'])){
        $keyEtu=$_SESSION['codePaie'];
        header("location:index?page=fiche");
    }else{
      if($_GET['recu']===2 && isset($_SESSION['codePaiee'])){
        $keyEtu=$_SESSION['codePaiee'];
        header("location:index?page=fiche");
      }
      else
      {
        header("location:index?page=paiement");
      }
    
      
    }
  
  //$keyEtu=isset($_SESSION['codePaie'])?$_SESSION['codePaie']:$_SESSION['codePaiee'];
}
$sel=$connexion->prepare("
SELECT Paiement.codePaie,Etudiant.matEtu,Etudiant.nomEtu,Paiement.datePaie,Etudiant.photoDestEtu, Paiement.numTelTransac,Etudiant.prenomEtu,Filiere.codeFil,Filiere.libFil,Etudiant.statutEtu,
Etudiant.nomParEtu,Etudiant.prenomParEtu,Etudiant.telParEtu,Etudiant.professionParEtu,
Etudiant.nomCoresEtu,Etudiant.prenomCoresEtu,Etudiant.telCoresEtu,Etudiant.professionCoresEtu,Etudiant.emailEtu,
Paiement.montantPaie,Paiement.montantRestPaie,Paiement.montantTotalPaie
FROM Paiement,Etudiant,Filiere
WHERE Etudiant.matEtu=Paiement.matEtu AND Etudiant.codeFil=Filiere.codeFil AND paiement.codePaie=?
");
$sel->execute([$keyEtu]);
$donnees=$sel->fetch(PDO::FETCH_OBJ);
$_SESSION["keyEtu"]=$donnees->codePaie;
$_SESSION["matEtu"]=$donnees->matEtu;
$_SESSION["nomEtu"]=$donnees->nomEtu;
$_SESSION["prenomEtu"]=$donnees->prenomEtu;
$_SESSION['photoDestEtu']=$donnees->photoDestEtu;
$_SESSION["codeFil"]=$donnees->codeFil;
$_SESSION["libFil"]=$donnees->libFil;
$_SESSION["emailEtu"]=$donnees->emailEtu;
$_SESSION['statutEtu']=$donnees->statutEtu;
$_SESSION['datePaie']=$donnees->datePaie;
$_SESSION['numTelTransac']=$donnees->numTelTransac;
$_SESSION['libFil']=$donnees->libFil;

////////////////////////////////////

/////////////
$_SESSION["nomParEtu"]=$donnees->nomParEtu;
$_SESSION['prenomParEtu']=$donnees->prenomParEtu;
$_SESSION['professionParEtu']=$donnees->professionParEtu;
$_SESSION['telParEtu']=$donnees->telParEtu;
////////////////
$_SESSION["nomCoresEtu"]=$donnees->nomCoresEtu;
$_SESSION['prenomCoresEtu']=$donnees->prenomCoresEtu;
$_SESSION['professionCoresEtu']=$donnees->professionCoresEtu;
$_SESSION['telCoresEtu']=$donnees->telCoresEtu;
var_dump($donnees);

/////////////////////////////////////
$_SESSION["montantPaie"]=$donnees->montantPaie;
$_SESSION["montantRestPaie"]=$donnees->montantRestPaie;
$_SESSION["montantTotalPaie"]=$donnees->montantTotalPaie;
/////////////////////////////////////////
//echo session_id();

