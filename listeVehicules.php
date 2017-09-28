<?php

				//Parametre de connexion
				$PARAM_hote = 'localhost';
				$PARAM_port = '3306';
				$PARAM_nom_bd = 'ParcAuto';
				$PARAM_utilisateur = 'utilParcAuto';
				$PARAM_mot_de_passe = 'parcAutoUtil';
				$PARAM_dsn = "mysql:host=$PARAM_hote; port=$PARAM_port; dbname=$PARAM_nom_bd; charset=utf8";

				/* Declaretion de la connexion
					* Leve une exception en cas d'erreur SQL */
				try	{
								$connexion = new PDO($PARAM_dsn, $PARAM_utilisateur, $PARAM_mot_de_passe, 
																array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				}	catch	(PDOException	$exc)	{
								die("Erreur requete SQL : ".$exc->getMessage());
				}
				
				//Preparation de la requete pour recupérer toutes les voitures
				$sql = "SELECT nom, immatriculation, couleur, puissance, places, assure "
												. "FROM voiture v "
												. "LEFT OUTER JOIN chauffeur c "
												. "ON v.immatriculation = c.vehicule "
												. "ORDER BY immatriculation ASC";

				//recuperation du result set apres envoi de la requete
				$rs = $connexion->query($sql);
				if	(!$rs){die("Erreur requete SQL.");};
				
				
				$nomChauffeur = "Amstram";
				//Preparation de la requete pour recupérer la voiture d'un chauffeur
				$sql = "SELECT * "
								. "FROM voiture v "
								. "LEFT OUTER JOIN chauffeur c "
								. "ON v.immatriculation = c.vehicule "
								. "WHERE c.nom = :chauffeur "
								. "ORDER BY immatriculation ASC";
				
				try {
								$rsNomChauffeur = $connexion->prepare($sql);
								$rsNomChauffeur->execute(array(':chauffeur' => $nomChauffeur));
								$resultarRsNomC = $rsNomChauffeur->fetch(PDO::FETCH_OBJ);
								$voiture1 = new Voiture($resultarRsNomC->immatriculation,	
																$resultarRsNomC->couleur,	
																$resultarRsNomC->poids,	
																$resultarRsNomC->puissance,	
																$resultarRsNomC->reservoir,	
																$resultarRsNomC->essence,	
																$resultarRsNomC->places,	
																$resultarRsNomC->assure,	
																$resultarRsNomC->message);
								$voiture1->setChauffeur($nomChauffeur);
								if($voiture1->getAssure() == 'TRUE'){
												$voiture1->setAssure(1);
								}else{
												$voiture1->setAssure(0);
								}
								var_dump($voiture1);
				}	catch	(PDOException	$exc)	{
								die("Erreur requete SQL : ".$exc->getMessage());				
				}	catch	(Exception	$exc)	{
								die("Erreur : ".$exc->getMessage());				
				}
				
				//Preparation pour l'update
				$sql = "UPDATE voiture "
								. "SET assure = :assure, message = :message "
								. "WHERE immatriculation = :immatriculation";
				
				try {
								$rsUpdateVoiture = $connexion->prepare($sql);
								$resultatUpdate = $rsUpdateVoiture->execute(array(':assure' => $voiture1->getAssure(), 
												':message' => $voiture1->getMessageTabBord(), 
												':immatriculation' => $voiture1->getImmatriculation()));
								var_dump($resultatUpdate);
				}	catch	(PDOException	$exc)	{
								die("Erreur requete SQL : ".$exc->getMessage());				
				}	catch	(Exception	$exc)	{
								die("Erreur : ".$exc->getMessage());				
				}

?>