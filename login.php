<?php 
	session_start();
	$pdo = new PDO('mysql:host=localhost;dbname=crowdpower', 'root', '');
	 
	if(isset($_GET['login'])) {
	 $email = $_POST['email'];
	 $passwort = $_POST['passwort'];
	 
	 $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
	 $result = $statement->execute(array('email' => $email));
	 $user = $statement->fetch();
	 
	 //Überprüfung des Passworts
	 if ($user !== false && password_verify($passwort, $user['passwort'])) {
	 $_SESSION['userid'] = $user['id'];
	 die('Login erfolgreich. Weiter zu <a href="interneBereich.php">internen Bereich</a>');
	 } else {
	 $errorMessage = "E-Mail oder Passwort war ungültig<br>";
	 }
	 
	}
?>
<!DOCTYPE html> 
	<html> 
		<head>
		  <title>Login</title> 
		  <link rel="stylesheet" href="style.css" type="text/css" />	
		</head> 
		<body>
			<?php require('menu.php'); ?>
			<?php 
				if(isset($errorMessage)) {
				 echo $errorMessage;
				}
			?>

			<form action="?login=1" method="post">
				E-Mail:<br>
				<input type="email" size="40" maxlength="250" name="email"><br><br>
				 
				Passwort:<br>
				<input type="password" size="40"  maxlength="250" name="passwort"><br><br>
				 
				</br><input type="submit" value="Abschicken"><br>
			</form> 
			</br><h4> Sind Sie ein neuer Benutzer? Sie k&ouml;nnen hier <a href="register.php">registrieren</a>.</h4>

		</body>
	</html>