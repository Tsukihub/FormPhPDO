<?php
$pdo = new PDO('mysql:dbname=colyseum;host=localhost; charset=utf8', 'root', '');
$pdo->setAttribute(
	PDO::ATTR_ERRMODE, 
	PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(
	PDO::ATTR_DEFAULT_FETCH_MODE, 
	PDO::FETCH_OBJ);

$statement =$pdo->query('SELECT id, type FROM cardTypes');
$typedecarte = $statement-> fetchall();
//echo "<pre>";
//var_dump($typedecarte);
//echo "<pre>";
//die()
?>

<!DOCTYPE html>
<html>
<head>
	<title>FORMULAIRE</title>
		<link rel="stylesheet" type="text/css" href="style/style.css">
	
</head>
<body>
<?php
$erreur = [];
if (isset($_POST) && !empty($_POST)) {
	$donner=[];
		if (isset($_POST["nom"]) && $_POST['nom']!='') {
			$donner['lastname'] = $_POST["nom"];
		}else{
			$erreur[] = 'merci de mettre un nom';
		}
		if (isset($_POST["prenom"]) && $_POST['prenom']!='') {
			$donner['firstName'] = $_POST["prenom"];
		}else{
			$erreur[] = 'merci de mettre un prenom';
		}
		if (isset($_POST["naissance"]) && $_POST['naissance']!='') {
			$donner['birthDate'] = $_POST["naissance"];
		}else{
			$erreur[] = 'merci de mettre une date naissance';
		}
		if (isset($_POST["card"])) {
			$donner['card'] = 1;
		
				if (isset($_POST["numeCard"])) {
				$donner['cardNumber'] = $_POST["numeCard"];
				}else{
				$erreur[] = 'merci de mettre un numéro carte';
				}
		}else{
			$donner['card'] = 0;
			$donner['cardNumber'] = null;
		}

		if (empty($erreur)) {
			/*INSERT TO INTO nomdelatable SET*/
			$statement = $pdo->prepare("
				INSERT INTO clients
				SET lastname = :lastname,
				firstName = :firstName,
				birthDate = :birthDate,
				card = :card,
				cardNumber = :cardNumber");
/*			echo "<pre>";
var_dump($donner);*/
			$statement->execute($donner);
$erreur[] = "<div class='list-group-item list-group-item-success'>le client est bien ADD'</div>";
			
		}
	}
/*if (isset($_POST["name"],$_POST["prenom"],$_POST["naissance"],$_POST["card"])) {
	$nom = $_POST["name"];
	$prenom = $_POST["prenom"];
	$card = $_POST["card"];
	echo "post effectué";
}*/
?>
<h1> Ajout de client </h1>
<nav class="navbar navbar-inverse">
  ...
</nav>





<?php foreach ($erreur as $value) {
	echo "<li class='list-group-item list-group-item-danger'> $value <li> <br>" ;
}
?>

<form method="post" action="">
	<input type="text" name="nom" placeholder="nom">
	<input type="text" name="prenom" placeholder="prenom">
	<input type="date" name="naissance">
	<label for="card"> le client veut il une carte de fidélité</label> <!-- pour mettre un texte devant checkbox-->
	<input type="checkbox" name="card" id="card">
	<FORM>
		<select type="typedecarte" name="typecarte" size="1">
		<?php foreach ($typedecarte as $value) {
			echo '<OPTION valeur="'.$value->id.'">'.$value->type.'</OPTION>';
		} 
		?>
		</SELECT>
	</FORM>
	<input type="number" name="numeCard" placeholder="numéro de la carte">
	<button type="submit">Ok</button>
</form>
</body>
</html>