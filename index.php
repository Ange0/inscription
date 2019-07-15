<?php
/**--------------------
 *DEVELOPPER PAR ANGELO
 *COPYRIGHT 22-JUIN-2019
 *COPYRIGHT 29-JUIN-2019
 *----------------------
 */
session_start();
require('html2pdf/vendor/autoload.php');// chargement pour les classes de HTML2PDF
require('vendor/autoload.php');// chargement pour de mes propres classe
$page=scandir("pages/admin");
if(isset($_GET["page"])&&!empty($_GET["page"])&& in_array($_GET["page"].".php",$page)){
    $page=$_GET["page"];
}else{
    $page="etudiant";
}
include_once("pages/admin/".$page.".php");
?>
