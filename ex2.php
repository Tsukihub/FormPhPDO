<?php 
$nom='';
$prenom='';
$numeCard='';
$card='';
$naissance='';
$message =[];
if(isset($_POST) && !empty($_POST)){
  $donnee=[];
 if(isset($_POST['nom']) && $_POST['nom']!=''){
    $donnee['lastName']= $_POST['nom'];
 }else{
  $message['danger'] ='merci de renseigner un nom';
 }
 if (isset($_POST['prenom']) && $_POST['prenom']!=''){
  $donnee['firstName']=$_POST['prenom'];
 }else{
  $message['danger']['danger'][] ='merci de renseigner un prenom';
}
if (isset($_POST['naissance'])&& $_POST['naissance']!=''){
  $donnee['birthDate']=$_POST['naissance'];
 }else{
  $message['danger'][] ='merci de renseigner une date de naissance';
}  
if (isset($_POST['card'])){
  $donnee['card']=1;

  if (isset($_POST['numeCard'])){
    $donnee['cardNumber']=$_POST['numeCard'];
  }else{
    $message['danger'][] ='merci de renseignernumeCard';
  }  


 }else{
  $donnee['card']=0;
  $numeCard = null;

}  
 if (!isset($message['danger']));{
  $pdo=new PDO (
    'mysql:dbname=colyseum; 
    host=localhost; 
    charset=utf8', 
    'root', 
    '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

  $statement = $pdo->prepare("
    INSERT INTO clients
    SET lastName= :lastName,
    firstName= :firstName,
    birthDate= :birthDate,
    card= :card,
    cardNumber= :cardNumber
    ");
  $statement->execute($donnee);
  $message['success'][]='le client est bien ajouté';
  $pdo=null;
  // INSERT INTO nomdelatable SET colonne=valeur//SET permet de cibler une colonne et une valeur

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

    foreach ($tableau as $key => $value) {
      echo '<li class=\"$key">'.$value.'</li>';
     
    }
}

 ?>
     <form action="" method="post">
          <fieldset>
            <legend>Inscription</legend>
    <!-- 
                <label for="nom">Nom :</label>  -->
                <input type="text" name="nom" placeholder="Nom" />
         <!--        <label for="prenom">Prénom :</label>  -->
                <input type="text" name="prenom" placeholder="Prenom" /> 
               <!--  <label for="naissance">Date de naissance :</label>  -->
                <input type="date" name="naissance" placeholder="jj/mm/aaaa">
             
               
                <label for="Card">Carte de fidélité ?</label><input type="checkbox" name="card" id="Card"/> 
                 <input type="number" name="numeCard" placeholder="Numéro de carte" /> 
               <button type="submit">ok</button>
          </fieldset>
    </form>
  </body>
</html>

<!-- for dans label avec même nom que id input quand click sur label coche case -->