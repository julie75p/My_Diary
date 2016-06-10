<?php 
/**
 * Profil File Doc Comment
 *
 * PHP Version 5.2
 *
 * @category Profil
 * @package  None
 * @author   julie planque <julie.planque34@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://example.com/recipes
 */
require_once "../controllers/User.php";
if (!isset($_SESSION['id_user'])) {
	header("location:../../index.php" );
}
$r = rand(0, 1000);
$membre = new User();
if (isset($_POST["updateProfil"])) {
	$errorUpdateUser= $membre->updateUser($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"], $_FILES["file"]);	
}
if (isset($_POST["logOut"])) {
	$membre->logOut("../../");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>My Mini Tweet</title>
	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="../../assets/css/materialize/css/materialize.min.css"  media="screen,projection"/>
	<link rel="stylesheet" href="../../assets/css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
	<!--Let browser know website is optimized for mobile-->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<header>
		<nav class="navIndex">
			<div class="nav-wrapper">
				<a href="#" class="brand-logo">My Mini tweet</a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="home.php" onClick="modalConnection();">Mur</a></li>
					<li><a href="profil.php" onClick="modalConnection();">Profil</a></li>
					<li><form action="home.php" class="logOut" method="post"><input value="Log out" id="logOut" class="inputlogOut"type="submit" name="logOut" /></form></li>
				</ul>
			</div>
		</nav>
	</header>
	<main>
		<div class="container myContainer">
			<div class="row">
				<article class="col s12 l12">
					<h1 class="titleArticle col s10">A propos de moi</h1>
					<div class="imgProfil col s4">
						<img src="../../assets/images_users/<?php echo $_SESSION["file"] . '#' . $r; ?>">
					</div>
					<div class="infoUtilisateur">
						<form id="updateProfil" action="profil.php" method="post" class="col s8 updateProfil" autocomplete="on"  enctype="multipart/form-data">
							<div class="row">
								<div class="input-field col s6">
									<input  id="first_name" type="text" name="firstname" class="validate" value="<?php echo $_SESSION["firstname"]; ?>">
									<label for="first_name">First Name</label>
								</div>
								<div class="input-field col s6">
									<input id="last_name" type="text" name="lastname" class="validate" value="<?php echo $_SESSION["lastname"]; ?>">
									<label for="last_name">Last Name</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="email" type="email" name="email" class="validate" value="<?php echo $_SESSION["email"]; ?>">
									<label for="email">Email</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="password" type="password" name="password" class="validate" autocomplete="off">
									<label for="password">New Password</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="file" type="file" name="file" class="validate" autocomplete="off">	
								</div>
							</div>
							<div class="alert">
								<?php if (isset($errorUpdateUser) && !empty($errorUpdateUser)) {
									echo $errorUpdateUser;
								} 
								?>
							</div>
							<button class="btn submitPerso waves-effect waves-light right-align" type="submit" name="updateProfil">Submit
								<i class="material-icons right">send</i>
							</button>
						</form>
					</div>
				</article>
				<hr>
			</div>
		</div>
	</main>
	<footer class="page-footer">
		<div class="container">
		</div>
		<div class="footer-copyright">
			<div class="container">
				© 2016 Copyright Julie Planque
				<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="../../assets/js/initialize.js"></script>
</body>
</html>