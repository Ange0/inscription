<?php
//echo(trim($_SESSION['photoDestEtu']));
//die();
//var_dump($_SESSION);
//var_dump(session_id());
//die();

//header("Location:index.php?page=paiement");
//require('html2pdf/vendor/autoload.php');// chargement pour les classes de HTML2PDF
//require('vendor/autoload.php');// chargement pour de mes propres classe
////////////////////////////////////
use Spipu\Html2Pdf\Html2Pdf;

////////////////////////////////////

ob_start();
?>
<style>
    table{
        width:100%;
        /*color: #717375;*/
        font-family:  Helvetica, sans-serif;
        height: 150%;
        
    }
    
</style>

<page backtop="20mm" backbottom="10mm" backleft="10mm" backright="20mm" footer="page;date;heure,cm"> 

    <page_header> 
      <!--Moi je suis l'entete -->
    </page_header> 
    <page_footer> 
        <!--je suis le bas de la page -->
    </page_footer> 
    <table style="border:1px solid #e6e4e4 vertical-align:top">
       <tr>
           <td style="width:43%">
                <span><img src="images/im2.png" alt=""></span>
            </td>
            <td style="width:34%">
                <H1 style="color:#00a0e3">IHBI 2018-2019</H1>
                <h6 style="font-size:0.4em;color:#b51c55;text-align:center">Fiche d'inscription des etudiants de IHBI</h6>
            </td>
           <td style="width:23%; height:20px;text-align:center"> <img style="height:100px"src="<?=($_SESSION['photoDestEtu'])?>"alt=""></td>
       </tr>
    </table>
    <table style="vertical-align:top;margin-top:20px;">
       <tr>
           <td style="width:100%;border:1px solid #e6e4e4;height:20px;text-align:center;padding-top:20px;">
               <span style="font-weight: bold;color:#fab102"><?= $_SESSION['codeFil'];?> / <?=strtoupper($_SESSION['libFil']);?></span> 
            </td>
       </tr>
    </table>
    
    <table style="width:80%">
       <tr style="height:100px">
           
           
            <td style="width:40%;margin-top:100px">
              <strong style="color:#5cb85c">Montant Payé:</strong> <?=$_SESSION["montantPaie"];?>
                Fcfa
            </td>
            <td style="width:47%;">
              <strong>Code de Paiement :</strong> <?=$_SESSION["keyEtu"];?>
            </td>
            <td style="width:40%;margin-top:100px">
              <strong>Date de Paiement :</strong> <?=$_SESSION["datePaie"];?>
            </td>

            
       </tr>
       <tr>
       <td style="width:40%;margin-top:100px">
              <strong style="color:#d9534f">Reste à Payé:</strong> <?=$_SESSION["montantRestPaie"];?>
              Fcfa
        </td>
       <td style="width:40%;margn-left:70%;">
              <strong>N° tel de transaction :</strong><?= $_SESSION["numTelTransac"];?>
        </td>
        
        
       </tr>
       <tr>
       <td style="width:40%;margin-top:100px">
              <strong style="color:#f0ad4e">Montant Totale:</strong> <?=$_SESSION["montantTotalPaie"];?>
              Fcfa
        </td>
       </tr>
    </table>
    
    <h4 style="font-size:0.9em;margin-top:40px;color:#b51c55">IDENTIFICATION DE L'ETUDIANT</h4>
    <hr style="margin-top:-20px; padding:14%;color:#e6e4e4" >
    <table style="width:100%">
    <tr style="padding-left:20px;height:100px">
           <td style="width:127px;height:20px;"> <strong>Matricul:</strong> </td>
           <td><?= strtoupper( $_SESSION['matEtu']);?></td>
       </tr>
       <tr style="padding-left:20px;height:100px">
           <td style="width:127px;height:20px"><strong>Nom :</strong> </td>
           <td><?= strtoupper( $_SESSION['nomEtu']);?></td>
       </tr>
        <br>
       <tr style="padding-top:150px;">
       <td style="width:20%;height:20px"><strong>Prénom :</strong></td>
       <td><?= strtoupper( $_SESSION['prenomEtu']);?></td>
        
       </tr>
       <tr style="padding-top:150px;margin-top:60px">
           <td style="width:20%;height:20px;"><strong>Filère :</strong> </td>
           <td style="width:60%;"><?= $_SESSION['codeFil'];?></td>
       </tr>
       <tr style="padding-top:150px">
           <td style="width:40%;"><strong>Status :</strong> </td>
           <td><?= ucfirst(strtolower( $_SESSION['statutEtu']));?></td>
       </tr>
       <tr style="padding-top:150px">
           <td style="width:20%"> <strong>E-mail :</strong></td>
           <td><?= $_SESSION["emailEtu"]?></td>
       </tr>
    </table>
    <h4 style="font-size:0.9em;margin-top:40px;color:#b51c55">PARENT</h4>
    <hr style="margin-top:-20px; padding:14%;color:#e6e4e4" >
    <table style="width:100%">
       <tr style="width:100px">
           <th style="width:127px;height:20px"><strong>Nom</strong> </th>
           <th style="width:250px;"><strong>Penom</strong> </th>
           <th style="width:100px"><strong>Telephone</strong> </th>
           <th><strong>Profession</strong> </th>
       </tr>
       <tr style="height:100px">
           <td><?= $_SESSION["nomParEtu"] ?></td>
           <td><?= $_SESSION['prenomParEtu'] ?></td>
           <td><?= $_SESSION['telParEtu'] ?></td>
           <td><?= $_SESSION['professionParEtu'] ?></td>
       </tr>
    </table>
    <h4 style="font-size:0.9em;margin-top:40px;color:#b51c55">CORESPONDANT(E)</h4>
    <hr style="margin-top:-20px; padding:14%;color:#e6e4e4" >
    <table style="width:100%">
    <tr style="width:100px">
           <th style="width:127px;height:20px"><strong>Nom</strong> </th>
           <th style="width:250px;"><strong>Penom</strong> </th>
           <th style="width:100px"><strong>Telephone</strong> </th>
           <th><strong>Profession</strong> </th>
       </tr>
       <tr style="width:100px">
       <td><?= $_SESSION['nomCoresEtu'] ?></td>
           <td><?= $_SESSION['prenomCoresEtu'] ?></td>
           <td><?= $_SESSION['telCoresEtu'] ?></td>
           <td><?= $_SESSION['professionCoresEtu'] ?></td>
       </tr>
      
    </table>
    <h6 style="font-size:0.9em;margin-top:40px;"> <i style="font-size:0.8em">NB:l'inscription n'est valide qu'après le depot des dossiers à l'inspectorat</i> </h6>
    <hr style="margin-top:-20px; padding:14%;color:#e6e4e4" >
</page> 

<?php
$contenu=ob_get_clean();
try {
	$pdf=new Html2Pdf("P","A4","fr");
	$pdf->pdf->setDisplayMode('fullpage');
	$pdf->writeHtml($contenu);
	$pdf->Output('test.pdf');
	
} catch (HTML2PDF_exception $e) {
	die($e);
}
?>