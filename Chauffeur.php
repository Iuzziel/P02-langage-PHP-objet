<?php

class	Chauffeur	{
				private $idchauffeur;
				private $nom;
				private $prenom;
				private $vehicule;
				
				public function toString()	{
								$msg = "Id ".$this->age." nom ".$this->nom." prenom ".$this->prenom." vehicule ".$this->vehicule;
								return $msg;
				}
				
				public function __construct($idchauffeur, $nom, $prenom, $vehicule)	{
								$this->idchauffeur = $idchauffeur;
								$this->nom = $nom;
								$this->prenom = $prenom;
								$this->vehicule = $vehicule;
				}
				
				function	getIdchauffeur()	{
								return	$this->idchauffeur;
				}
				function	getNom()	{
								return	$this->nom;
				}
				function	getPrenom()	{
								return	$this->prenom;
				}
				function	getVehicule()	{
								return	$this->vehicule;
				}
				function	setIdchauffeur($idchauffeur)	{
								$this->idchauffeur	=	$idchauffeur;
				}
				function	setNom($nom)	{
								$this->nom	=	$nom;
				}
				function	setPrenom($prenom)	{
								$this->prenom	=	$prenom;
				}
				function	setVehicule($vehicule)	{
								$this->vehicule	=	$vehicule;
				}
}
