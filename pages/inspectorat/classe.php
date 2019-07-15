
<!DOCTYPE html>
<html>
<head>
	<title>Bienvenu sur la Classe</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body>
	<marquee><h2> Bienvenue sur la classe</h2></marquee>
	<div class="container-fluid" style="margin-top:10px;">
        <div class="row">
            <!-------------  CLASSE -------------------------- -->
            <div class="col-md-4 " > 
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 style="text-align:center">CLASSE</h2>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="nom">N°Code</label>
                                <input type="text" name="nom" class="form-control" placeholder="Yao" value="" required="">
                            </div>
                            <div class="form-group">
                                <label for="prenom">Libellé</label>
                                <input type="text" name="prenom" class="form-control" placeholder="EX:Kouassi ange" value="" required="">
                            </div>
                            <input type="submit" class=" btn btn-primary" name="envoyer" value="Envoyer" >
                            <input type="reset" name="" value="Annuler" class=" btn btn-danger">
                        </form>
                    </div>
                 </div>  
                </div>
                <!-------------  /CLASSE -------------------------- -->
                  <!-------------  FILIERE -------------------------- -->
                <div class="col-md-4 " > 
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 style="text-align:center">FILIERE</h2>
                        </div>
                        <div class="panel-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="nom">N°Code</label>
                                    <input type="text" name="nom" class="form-control" placeholder="Yao" value="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Libellé</label>
                                    <input type="text" name="prenom" class="form-control" placeholder="EX:Kouassi ange" value="" required="">
                                </div>
                                 <div class="form-group">
                                    <label >Type</label>
                                     <select name="typeFil" class="form-control">
                                            <option></option>
                                            <option>Industrielle</option>
                                            <option>Tertiaire</option>
                                     </select>
                                 </div>

                                <input type="submit" class=" btn btn-primary" name="envoyer" value="Envoyer" >
                                <input type="reset" name="" value="Annuler" class=" btn btn-danger">
                            </form>
                        </div>
                    </div>  
                 </div>
                 <!-------------  FILIERE -------------------------- -->

                <!-------------  PERSONNEL -------------------------- -->
                <div class="col-md-4 " > 
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 style="text-align:center">PERSONNEL</h2>
                        </div>
                        <div class="panel-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="numPers">N°Personnel</label>
                                    <input type="text" name="numPers" id="numPers" class="form-control" placeholder="001" value="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="nomPers">Nom</label>
                                    <input type="text" name="nomPers" class="form-control" placeholder="EX:Yao" value="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="prenomPers">Prenom</label>
                                    <input type="text" name="prenomPers" class="form-control" placeholder="EX:Kouassi Victorien" value="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="telPers">
                                    <input type="tel" name="telPers" class="form-control" placeholder="EX:57089563" value="" required="">
                                </div>
                                 <div class="form-group">
                                    <label for="fonctionPers">
                                    <input type="tel" name="fonctionPers" class="form-control" placeholder="secretaire" value="" required="">
                                </div>
                                <input type="submit" class=" btn btn-primary" name="envoyer" value="Envoyer" >
                                <input type="reset" name="" value="Annuler" class=" btn btn-danger">
                            </form>
                        </div>
                    </div>  
                 </div>
                </div>
               </div>
               
             <!-------------  /PERSONNEL -------------------------- -->
            </div>

        </div>
      </div>
    </div>
</body>
</html>