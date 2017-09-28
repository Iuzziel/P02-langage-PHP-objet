<?php 
				require_once	'./Voiture.php'; 
				require_once	'./PoidsLourd.php';
				require_once	'./chauffeur.php';
				require_once	'./listeVehicules.php';
								
				$tResultats = $rs->fetchAll(PDO::FETCH_ASSOC);
				//$tResultats = $resultats->fetchAll();
				
				$rs->closeCursor();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
								<link rel="Stylesheet" type="text/css" media="screen" href="css.css" />
        <title>Index</title>
    </head>
    <body>
								<header>
												<h1>Test Php PDO :</h1>
								</header>
								<section>
												<table>
																<tr>
																				<th>Nom du chauffeur</th>
																				<th>Immatriculation</th>
																				<th>Couleur</th>
																				<th>Puissance</th>
																				<th>Places</th>
																				<th>Assuré</th>
																</tr>
																<?php foreach	($tResultats as $donnee): ?>
																<tr>
																				<?php foreach	($donnee as $cellule): ?>
																				<td><?= $cellule; ?></td>
																				<?php endforeach; ?>
																</tr>
																<?php endforeach; ?>
												</table>
								</section>
    </body>
</html>
<!--

-->