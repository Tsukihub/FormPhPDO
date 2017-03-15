<?php
$pdo = new PDO('mysql:dbname=colyseum;host=localhost; charset=utf8', 'root', '');
$pdo->setAttribute(
	PDO::ATTR_ERRMODE, 
	PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(
	PDO::ATTR_DEFAULT_FETCH_MODE, 
	PDO::FETCH_OBJ);

$statement =$pdo->query('SELECT id, type FROM showTypes');
$typedeshow = $statement-> fetchAll();

$statement =$pdo->query('SELECT showTypes.id, genres.genre, genres.showTypesId FROM genres, showTypes WHERE showTypes.id=genres.showTypesId');
$genre = $statement-> fetchAll();






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
				INSERT INTO shows
				SET 
				id = :id,
				title = :title,
				date = :date,
				showTypesId = :showTypesId,
				firstGenresId = :firstGenresId,
				secondGenreId = : secondGenreId,
				duration = : duration,
				startTime = : startTime 
				");


/*			echo "<pre>";
var_dump($donner);*/
			$statement->execute($donner);
$erreur[] = "<div class='list-group-item list-group-item-success'>le client est bien ADD'</div>";
			
		}
	}


















?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
    <link rel="stylesheet" href="style/css/style.css">
</head>
  <body>
<?php foreach ($message as $key => $tableau) {

    foreach ($tableau as $value) {
      echo '<li class=\"$key">'.$value.'</li>';
      var_dump($tableau);
     
    }
}

 ?>
     <form action="" method="post">
          <fieldset>
            <legend>Inscription</legend>

      
                <input type="text" name="titre" placeholder="Nom du spectacle" />
    
                <input type="text" name="perform" placeholder="Nom de l'artiste" /> 
        
                <input type="date" name="date" placeholder="jj/mm/aaaa">
                
                <select name="type">
                <?php foreach ($typedeshow as $value) {
                     echo '<OPTION valeur="'.$value->id.'">'.$value->type.'</OPTION>';
                }
                	
				?>	
                </select>

                 <select name="genre1">
      				
                    <?php foreach ($genre as $value) {
                	  echo '<OPTION valeur="'.$value->id.'">'.$value->genre.'</OPTION>';
                }
                	
				?>
                </select>

                <select name="genre2">
       			<?php foreach ($genre as $value) {
                	 echo '<OPTION valeur="'.$value->id.'">'.$value->genre.'</OPTION>';
                }
                	
				?>
					
                </select>

             
               
                <label for="Card">Carte de fidélité ?</label><input type="checkbox" name="card" id="Card"/> 
                 <input type="number" name="numeCard" placeholder="Numéro de carte" /> 
                 <input type="time" name="duree"/>
                  <input type="time" name="start" placeholder="Heure de débu/>
               
               <button type="submit">ok</button>
          </fieldset>
    </form>
  </body>
</html>
