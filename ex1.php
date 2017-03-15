<?php  
// $pdo=new PDO ('mysql:dbname=colyseum;host=localhost', 'root', ''); //localhost réécrit adresse correct tt seul
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
// $statement = $pdo->query('SELECT * FROM clients');
// echo '<pre>';
// foreach ( as $value) {
// 			print_r($value);
// 		};

// echo '</pre>';
////////////////////1 et 3
$pdo=new PDO ('mysql:dbname=colyseum; host=localhost; charset=utf8', 'root', ''); //localhost réécrit adresse correct tt seul
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
$statement = $pdo->query('SELECT * FROM clients LIMIT 5,20');// LIMIT OFFSET,NBRECUP ou LIMIT NBRECUP
$resultatexo1=$statement->fetchAll();//rq fetch ne récupere que premiere ligne 

//////////////////2

$statement = $pdo->query("
SELECT  showTypes.type, genres.genre AS firstGenre, secGenres.genre AS secGenre
FROM showTypes, genres, genres AS secGenres 
WHERE showTypes.id=genres.showTypesId AND showTypes.id = secGenres.showTypesId
ORDER BY genres.id");///on peut réutiliser statement car on a déjà recupéré ce qui ns interesse de clients dans le tableau $resultat
$resultat2=$statement->fetchAll();

/////////////////4

$statement = $pdo->query("
SELECT  * 
FROM clients
WHERE clients.card!=0
");///on peut réutiliser statement car on a déjà recupéré ce qui ns interesse de clients dans le tableau $resultat
$resultat3=$statement->fetchAll();

////////////////5

$statement = $pdo->query("
SELECT lastName, firstName
FROM clients
WHERE  clients.lastName LIKE 'M%'
ORDER BY clients.lastName ASC 
");///on peut réutiliser statement car on a déjà recupéré ce qui ns interesse de clients dans le tableau $resultat
$resultat4=$statement->fetchAll();

/////////////////6
$statement = $pdo->query("
SELECT title, performer, date, startTime
FROM shows
ORDER BY title 
");///on peut réutiliser statement car on a déjà recupéré ce qui ns interesse de clients dans le tableau $resultat
$resultat5=$statement->fetchAll();


////////////////7
$statement = $pdo->query("
SELECT lastName, firstName, birthDate, card, cardNumber
FROM clients
");///on peut réutiliser statement car on a déjà recupéré ce qui ns interesse de clients dans le tableau $resultat
$resultat6=$statement->fetchAll();

// echo '<pre>';
// var_dump($resultat6);
// echo'</pre>';


// $statement = $pdo->query("
// SELECT 
// FROM 
// ");///on peut réutiliser statement car on a déjà recupéré ce qui ns interesse de clients dans le tableau $resultat
// $resultat7=$statement->fetchAll();

// echo '<pre>';
// var_dump($resultat7);
// echo'</pre>';

########################################
####### view
#####################################
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ex pdot</title>
	<link rel="stylesheet" href="style/css/style.css">
</head>
<body>





<h2>exo7</h2>	

<table>

<tbody>

<?php foreach ($resultat6 as $value) : ?>  
<?php if($value->card==1){
	$cartefidstatus="oui";
	if ($value->cardNumber){
		$numcard=$value->cardNumber;
	}
}else{
	$cartefidstatus="non";
} 
if ($value->cardNumber){
		$numcard="numéro de carte : ".$value->cardNumber;
	}else{
		$numcard='';
		}?>

nom: <?=$value->lastName; ?> prenom : <?=$value->firstName; ?> date de naissance : <?=$value->birthDate; ?> carte de fidélité : <?=$cartefidstatus; ?>  <?=$numcard; ?><br/>
<?php endforeach ?>




<!-- ou avec condition binaire -->




<?php foreach ($resultat6 as $value) : ?>  

nom: <?=$value->lastName; ?> prenom : <?=$value->firstName; ?> date de naissance : <?=$value->birthDate; ?> carte de fidélité : <?= ($value->card==0)?  'non' :  'oui numéro de la carte : '.$value->cardNumber; ?><br/>
<?php endforeach ?>



/* <?= ($value->card==0)?  'non' :  'oui numéro de la carte : '.$value->cardNumber; ?>
*/



</tbody>
</table>







<h2>exo6</h2>	
<!--  aff titre tt spect + artiste date heure trier tires par ordre alphabétique aff résutat format result

spectacle par artiste, le date à heure. -->
<table>
<thead>
	<tr>
	
		<th>nom</th>
		<th>prenom</th>
		
	</tr>
<tbody>

<?php foreach ($resultat5 as $value) : ?>   
<?=$value->title; ?> par <?=$value->performer; ?> le <?=$value->date; ?> à <?=$value->startTime; ?><br/>
<?php endforeach ?>


</tbody>
</thead>
</table>





<h2>exo5</h2>	
<!--  nom comm par M triés par ordre alpha -->
<table>
<thead>
	<tr>
	
		<th>nom</th>
		<th>prenom</th>
		
	</tr>
<tbody>

<?php foreach ($resultat4 as $value) : ?>   

	<tr>

		<td><?php echo $value->lastName ?></td>
		<td><?php echo $value->firstName ?></td>

	</tr>

<?php endforeach ?>


</tbody>
</thead>
</table>











<h2>exo1</h2>	
<!-- afficher table clients  -->
<table>
<thead>
	<tr>
		<th>id</th>
		<th>nom</th>
		<th>prenom</th>
		<th>date naissance</th>
		<th>card</th>
		<th>numéro carte</th>
	</tr>
<tbody>

<?php foreach ($resultatexo1 as $value) : ?>   

	<tr>

		<td><?php echo $value->id ?></td>
		<td><?php echo $value->lastName ?></td>
		<td><?php echo $value->firstName ?></td>
		<td><?php echo $value->birthDate ?></td>
		<td><?php echo $value->card ?></td>
		<td><?php echo $value->cardNumber ?></td>
	</tr>

<?php endforeach ?>


</tbody>
</thead>
</table>

<h2>exo2</h2>	
<!-- afficher tt les types de spectacles possibles -->
<table>
<thead>
	<tr>
		
		<th>type</th>
		<th>genre1</th>
		<th>genre2</th>
		
	
	</tr>
<tbody>

<?php foreach ($resultat2 as $value2) : ?>   
	

	<tr>
		
		<td><?php echo $value2->type ?></td>
		<td><?php echo $value2->firstGenre ?></td>
		<td><?php echo $value2->secGenre ?></td>

	</tr>
<?php endforeach ?>


</tbody>
</thead>
</table>
<h2>exo3</h2>	

<table>
<thead>
	<tr>
		<th>id</th>
		<th>nom</th>
		<th>prenom</th>
		<th>date naissance</th>
		<th>card</th>
		<th>numéro carte</th>
	</tr>
<tbody>

<?php foreach ($resultatexo1 as $value) : ?>   


	<tr>

		<td><?php echo $value->id ?></td>
		<td><?php echo $value->lastName ?></td>
		<td><?php echo $value->firstName ?></td>
		<td><?php echo $value->birthDate ?></td>
		<td><?php echo $value->card ?></td>
		<td><?php echo $value->cardNumber ?></td>
	</tr>

<?php endforeach ?>


</tbody>
</thead>
</table>



















</body>
</html>