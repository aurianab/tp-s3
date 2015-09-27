<html lang="fr">
	<head>
		<title>PHP 1 - TP S3 | Auriana Bastian</title>
		<meta charset="UTF-8" />
        
		<?php include("opengraph.inc.php"); ?>
		<?php include("favicon.inc.php"); ?>

		<link rel="stylesheet" href="_styles/style.css">
	
		<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

	</head>
	<body>

		<div class="container">

		<pre>
			<?php

			$error_nom = false;
			$error_prenom = false;
			$error_naissance = false;
			$error_email = false;
			$email_envoyer = false;
			
            

			if($_POST){

				// HONEYPOT
				if ($_POST['user_email'] != '') {
					die("Dégage, spammeur");
				}

				//NETTOYAGE

				if ($_POST) {

					function menage($argument){
						return trim(strip_tags($argument));
					}

					$nom = menage(strip_tags($_POST['nom']));
					$prenom = menage(strip_tags($_POST['prenom']));
					$email = menage(strip_tags($_POST['email']));
					$naissance = $_POST['naissance'];
					$adresse = menage(strip_tags($_POST['adresse']));
					$ville = menage(strip_tags($_POST['ville']));
					$commune = menage(strip_tags($_POST['commune']));
					$question = $_POST['question'];

				}

				//VALIDATION

				$destinataire = "aurianab@live.fr";
                $message = $prenom." ".$nom." est né/née le ".$naissance.", habite à ".$adresse." , ".$ville." , ".$commune." et il/elle veut rejoindre les bleus ".$question ;
                   

                function is_valid_email($email) {
						return filter_var($email, FILTER_VALIDATE_EMAIL);
				}

				if ($nom == '' ) {
					$error_nom = true;
					$error = true;
				}

				if ($prenom == '' ) {
					$error_prenom = true;
					$error = true;
				}

				if ($naissance == '' ) {
					$error_naissance = true;
					$error = true;
				}

				if (is_valid_email($email) == false) {
					$error_email = true;
					$error = true;
					}

				if ($error != true) {
					mail( $destinataire, $email, $message);
					$email_envoyer = true;
				}

				
			};

			?>
		</pre>

		<h1>Inscris-toi!</h1>
		<p class="texte">Le Cercle des étudiants de l’ ESIAJ recrute. Envie de nouvelles expériences, de rencontres et de bière, alors rejoins-nous!</p>	

			<form method="post">
				<label class="user_email" for="prenom">User email</label>
				<input class="user_email" type="text" name="user_email" id="user_email" value="<?php echo ($user_email!='') ? $user_email: '' ?>">

				<label for="nom">Ton nom<abbr title="Champ obligatoire">*</abbr></label>
				<input type="text" name="nom" id="nom" value="<?php echo ($nom!='') ? $nom: '' ?>">
				<?php
					if ( $error_nom == true ) {
						echo "<p class='message-erreur'>Tu as oublié d'inscrire ton nom</p>";
					};
				?>

				<label for="prenom">Ton prénom<abbr title="Champ obligatoire">*</abbr></label>
				<input type="text" name="prenom" id="prenom" value="<?php echo ($prenom!='') ? $prenom: '' ?>">
				<?php
					if ( $error_prenom == true ) {
						echo "<p class='message-erreur'>Tu as oublié d'inscrire ton prénom</p>";
					};
				?>

				<label for="email">Ton email<abbr title="Champ obligatoire">*</abbr></label>
                <input type="text" name="email" id="email" value="<?php echo ($email!='') ? $email: '' ?>" placeholder="bleu@cercle-esiaj.be">
                <?php
                	if ($error_email == true) {
                		echo "<p class='message-erreur'>Ton email n'est pas valide</p>";
                	};
				?>

				<label for="naissance">Ta date de naissance<abbr title="Champ obligatoire">*</abbr></label>
				<input type="date" name="naissance" id="naissance" value="<?php echo ($naissance!='') ? $naissance: '' ?>">
				<?php
					if ($error_naissance == true ) {
					echo "<p class='message-erreur'>Tu as oublié d'indiquer ta date de naissance</p>";
					};
				?>
				
				<label for="adresse">Adresse</label>
				<textarea name="adresse" id="adresse"><?php echo ($adresse!='') ? $adresse: '' ?></textarea>

				<label for="ville">Ville</label>
				<input type="text" name="ville" id="ville" value="<?php echo ($ville!='') ? $ville: '' ?>">

				<label for="commune">Commune</label>
				<input type="text" name="commune" id="commune" value="<?php echo ($commune!='') ? $commune: '' ?>">

				<fieldset id="question">
                    
                    <legend>Pourquoi souhaites-tu devenir un bleu ?<abbr title="Champ obligatoire">*</abbr></legend>
                    <div>
                        <input type="radio" name="question" id="q1" value="pour rencontrer des gens" checked <?php if( $_POST['question']=='gens'){ echo 'checked="checked"';} ?> required>
                        <label for="q1">Pour rencontrer des gens</label>
                    </div>
                    <div>
                        <input type="radio" name="question" id="q2" value="pour boire et encore boire" <?php if( $_POST['question']=='boire'){ echo 'checked="checked"';} ?> required> 
                        <label for="q2">Pour boire et encore boire</label> 
                    </div>
                    <div>
                        <input type="radio" name="question" id="q3" value="pour tenter une nouvelle expérience" <?php if( $_POST['question']=='experience'){ echo 'checked="checked"';} ?> required> 
                        <label for="q3">Pour tenter une nouvelle expérience</label>
                    </div>   
                    
                </fieldset>
		

				<input type="submit" name="submit" value="Envoyer" id="btn">

			</form>

			<?php 
				if ($_POST) {
                    if ($email_envoyer == true) {
                    echo "<p class='confirm'>Ton inscription est envoyée. <br>Merci la bleusaille!</p><style>form{display:none;}</style>";  
                }
                };
            ?>

			
		</div>

		<footer>

			<p>Auriana Bastian . B2G22 . <a href="https://github.com/aurianab/tp-s3" class="git">Github</a></p> 

		</footer>

 </body>
</html>