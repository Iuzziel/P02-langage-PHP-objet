<?php

class	PoidsLourd extends Voiture	{
				private $nombreEssieux;
				private $volumeUtile;
				
				public function toString()	{
								$msg = parent::toString();
								$msg .= "Nombre d'essieux ".$this->nombreEssieux." volume utile ".$this->volumeUtile."m3. ";
								return $msg;
				}
				
				/*
				public function Se_deplacer($distanceParcourue,	$vitesseMoyenne)	{
								parent::Se_deplacer($distanceParcourue,	$vitesseMoyenne);
				}
				*/
				
				/**
				 * 
				 * @param int $distanceParcourue
				 * @param int $vitesseMoyenne
				 * @return int
				 */
				public	function consommation($distanceParcourue, $vitesseMoyenne){
								echo "poidslourd";
								if($vitesseMoyenne < 50)	{
												return $distanceParcourue * 35 / 100;
								}elseif($vitesseMoyenne >= 50 && $vitesseMoyenne < 80){
												return $distanceParcourue * 25 / 100;
								}elseif($vitesseMoyenne >= 90 && $vitesseMoyenne < 110){
												return $distanceParcourue * 18 / 100;
								}else{
												return $distanceParcourue * 40 / 100;
								}
				}
				
				/**
				 * Constructeur Poids Lourd
				 * @param type $immatriculation
				 * @param type $couleur
				 * @param type $poids
				 * @param type $puissance
				 * @param type $capaciteReservoir
				 * @param type $nombrePlace
				 * @param type $nombreEssieux
				 * @param type $volumeUtilse
				 */
				public function __construct($immatriculation,	$couleur,	$poids,	$puissance,	$capaciteReservoir,	$nombrePlace, $nombreEssieux, $volumeUtilse)	{
								parent::__construct($immatriculation,	$couleur,	$poids,	$puissance,	$capaciteReservoir,	$nombrePlace);
							 $this->nombreEssieux = $nombreEssieux;
								$this->volumeUtile = $volumeUtilse;
				}
}
