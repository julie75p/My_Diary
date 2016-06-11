 <!DOCTYPE html>
 <?php
 
/**
 * My Diary File Doc Comment
 *
 * PHP Version 5.2
 *
 * @category My Diary 
 * @package  None
 * @author   julie planque <julie.planque34@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://example.com/recipes
 */
require_once "core/controllers/user.php";
$membre = new User();
if (isset($_POST['connection'])) {

	$returnError = $membre->connection($_POST['email'], $_POST['password']);
}
if (isset($_POST['registration'])) {
	$returnErrorRegistration = $membre->registration($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']);
}
if (!isset($_SESSION['id_user'])) {
	?>
	<html>
	<head>
		<title>My Diary</title>
		<!--Import Google Icon Font-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="assets/css/materialize/css/materialize.min.css"  media="screen,projection"/>
		<link rel="stylesheet" href="assets/css/style.css">
		<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>

		<!--Let browser know website is optimized for mobile-->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body>
		<div class="billboard light">
			<header>
				<nav class="navIndex">
					<div class="nav-wrapper">
						<a href="#" class="brand-logo">My Diary</a>
						<ul id="nav-mobile" class="right hide-on-med-and-down">
							<li><a href="#modal2" onClick="modalConnection();">Connection</a></li>
							<li><a  href="#modal1" onClick="modalRegistration();">Register</a></li>
						</ul>
					</div>
				</nav>
			</header>
			<main>
				<div class="formRegistration modal" id="modal1" <?php if(isset($returnErrorRegistration) && !empty($returnErrorRegistration)) { echo 'style="display:block"';} ?>>
					<div class="row">
						<form id="registration" action="index.php" method="post" class="col s12" autocomplete="on">
							<div class="row">
								<h1 class="col s11">Registration</h1>
								<div class="col s1">
									<i class="material-icons  right-align iconClose" onClick="closeModal();">close</i>
								</div>
								<div class="input-field col s6">
									<input  id="first_name" type="text" name="firstname" class="validate">
									<label for="first_name">First Name</label>
								</div>
								<div class="input-field col s6">
									<input id="last_name" type="text" name="lastname" class="validate">
									<label for="last_name">Last Name</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="email" type="email" name="email" class="validate">
									<label for="email">Email</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="password" type="password" name="password" class="validate" autocomplete="off">
									<label for="password">Password</label>
								</div>
							</div>
							<div class="alert">
								<?php if (isset($returnErrorRegistration) && !empty($returnErrorRegistration)) {
									echo $returnErrorRegistration;
								} 

								?>
							</div>
							<button class="btn submitPerso waves-effect waves-light right-align" type="submit" name="registration">Submit
								<i class="material-icons right">send</i>
							</button>
						</form>
					</div>

				</div>
				<div class="formConnection modal" id="modal2" <?php if(isset($returnError) && !empty($returnError)) { echo 'style="display:block"';} ?>>
					<div class="row">
						<h1 class="col s11">Connection</h1>
						<div class="col s1">
							<i class="material-icons  right-align iconClose" onClick="closeModal();">close</i>
						</div>
						<form id="connection"  action="index.php" method="post" class="col s12">
							<div class="row">
								<div class="input-field col s12">
									<input id="email" type="email" name="email" class="validate">
									<label for="email">Email</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="password" type="password" name="password" class="validate">
									<label for="password">Password</label>
								</div>
							</div>
							<div class="alert">
								<?php if (isset($returnError) && !empty($returnError)) {
									echo $returnError;
								} 

								?>
							</div>
							<button class="btn submitPerso waves-effect waves-light right-align" type="submit" name="connection">Submit
								<i class="material-icons right">send</i>
							</button>
						</form>
					</div>
				</div>
				<div class="caption light animated wow fadeInDown clearfix">
					<h1>Welcome to My Diary </h1>
					<p>Perfect to write your ideas</p>
					<hr>
				</div>
			</main>
			<footer class="page-footer index">
				<div class="container">
				</div>
				<div class="footer-copyright">
					<div class="container">
						© 2016 Copyright Julie Planque
						<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
					</div>
				</div>
			</footer>
		</div>
		<?php
	}
	?>
	<script type="text/javascript" src="assets/js/initialize.js"></script>
</body>
</html>