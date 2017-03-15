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
                 <input type="radio" name="typecarte" value='family' class="radio"/>famille
                 <input type="radio" name="typecarte" value='fidelity' class="radio"/>fidelité
                 <input type="radio" name="typecarte" value='student' class="radio"/>étudiant
                 <input type="radio" name="typecarte" value='employee' class="radio"/>
                 employé
               <button type="submit">ok</button>
          </fieldset>
    </form>
  </body>
</html>
