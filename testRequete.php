<?php

    require("Voiture.class.php");
    
// connexion BDD ParcAuto
    $hote = 'localhost';
    $port = '3306';
    $nom_bd = 'parcauto';
    $utilisateur = 'utilParcAuto';
    $mot_passe = 'parcAutoUtil';
    try {
        
        $dsn = "mysql:host=$hote; port=$port; dbname=$nom_bd; charset=utf8" ;
        $connexion = new PDO ($dsn, $utilisateur, $mot_passe,
                                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $sql = "SELECT nom, immatriculation, couleur, puissance, places, assure "
                . "FROM voiture v INNER JOIN chauffeur c ON "
                . "v.immatriculation = c.vehicule "
                . "ORDER BY immatriculation ASC";

        // Envoyer la requete
        $rs = $connexion->query($sql);

    } catch (PDOException $e) {
        die("Exception PDO :"."<br>".$e->getMessage());
    }
    
    //if (!$rs) die("Erreur au traitement de la requete :");
    
    //var_dump($rs);
    $records = $rs->fetchAll(PDO::FETCH_OBJ);
    
    $rs->closeCursor();
        
?>    
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste des Véhicules</title>
    </head>
    <body>
        <h1>Test requetes sur ParcAuto</h1>
        <?php
            foreach($records as $tLigne){
                $msg = $tLigne->nom." ".$tLigne->immatriculation." ".$tLigne->couleur." ".
                        ($tLigne->assure ? "Oui" : "Non").
                        "<br>" ;
                echo $msg;
            }
            
            $nomChauffeur = "Amstram";
            
            $sql = "SELECT * "
                . "FROM voiture v INNER JOIN chauffeur c ON "
                . "v.immatriculation = c.vehicule "
                . "WHERE c.nom = :chauffeur";
            try {
                
                $rs = $connexion->prepare($sql);

                $rs->execute(array(':chauffeur' => $nomChauffeur));
                
                $record = $rs->fetch(PDO::FETCH_OBJ);
                
                $voiture = new Voiture($record->immatriculation, 
                        $record->couleur,
                        $record->poids,
                        $record->puissance,
                        $record->reservoir,
                        $record->essence,
                        $record->places,
                        $record->assure,
                        $record->message);
                
                var_dump($voiture);
                
                $voiture->setAssure(true);
                
                var_dump($voiture);
                
                $sql = "UPDATE voiture SET assure = :assure, message = :message ".
                        "WHERE immatriculation = :immatriculation";
                
                $rs = $connexion->prepare($sql);

                $rs->execute(array(':assure' => $voiture->getAssure(),
                             ':message' => $voiture->getMessage(),
                             ':immatriculation' => "hhhhh"));

                if ($rs->rowCount() != 1){
                    die("Pas de MAJ ...");
                }

                echo $rs->rowCount(). " Enreg modifié";

            } catch (PDOException $e) {
                die("Exception PDO :"."<br>".$e->getMessage());
            } catch (Exception $e) {
                die("Exception :"."<br>".$e->getMessage());
            }
        ?>
    </body>
</html>
