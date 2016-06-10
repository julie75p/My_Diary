<?php 
/**
 * Home File Doc Comment
 *
 * PHP Version 5.2
 *
 * @category Home
 * @package  None
 * @author   julie planque <julie.planque34@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://example.com/recipes
 */
require_once "../controllers/User.php";
if (!isset($_SESSION['id_user'])) {
	header("location:../../index.php" );
}
$r = rand(1, 1000);
$membre = new User();
if (isset($_GET['page']))
{
	$page = $_GET['page'];
}
else
{
	$page = 1;
}
$nbArticles = $membre->countArticles();
$nbPages = $nbArticles / 3;
if ($nbArticles % 3 > 0)
	$nbPages++;
if (isset($_POST["createArticle"])) {
	$returnErrorInsertArticle = $membre->insertArticle($_POST["title"], $_POST["message"], $_FILES["file"]);	
}
if (isset($_POST["updateArticle"])) {
	$returnErrorUpdateArticle = $membre->updateArticle($_POST["title"], $_POST["message"], $_FILES["file"], $_POST['id_message']);
}
if (isset($_GET["delete"])) {
	$returnErrorDeleteMessage = $membre->deleteMessage($_GET["delete"]);
}
$message = $membre->afficheMessage($page);
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
					<li><a href="profil.php">Profil</a></li>
					<li><form action="home.php" class="logOut" method="post"><input value="Log out" id="logOut" class="inputlogOut"type="submit" name="logOut" /></form></li>
				</ul>
			</div>
		</nav>
	</header>
	<main>
		<!--  MODAL CREATE MESSAGE -->
		<div class="createArticle modal" id="modal" <?php if(isset($returnErrorInsertArticle) && !empty($returnErrorInsertArticle)) { echo 'style="display:block"';} ?>>
			<div class="row">
				<h1 class="col s11">Create Message</h1>
				<div class="col s1">
					<i class="material-icons  right-align iconClose" onClick="closeModalArticle();">close</i>
				</div>
				<form id="article" onsubmit="checkSubmitArticle(event)" action="home.php" method="post" class="col s12" enctype="multipart/form-data">
					<div class="row">
						<div class="input-field col s12">
							<input id="title" type="text" name="title" class="validate createTitle">
							<label for="title">Title</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<textarea id="message" class="materialize-textarea createMessage" name="message"></textarea>
							<label for="message">Your Message (120 caractères)</label>
						</div>
					</div>
					<div class="row">
						<input type="file" name="file" id="file">
					</div>
					<div class="alert">
						<?php if (isset($returnErrorInsertArticle) && !empty($returnErrorInsertArticle)) {
							echo $returnErrorInsertArticle;
						} 
						?>
					</div>

					<button class="btn submitPerso waves-effect waves-light right-align" type="submit" name="createArticle">Submit
						<i class="material-icons right">send</i>
					</button>
				</form>
			</div>
		</div>
		<!--  END MODAL CREATE MESSAGE -->

		<!--  MODAL UPDATE  MESSAGE -->
		<div class="updateArticle modal" id="modal" <?php if(isset($returnErrorUpdateArticle) && !empty($returnErrorUpdateArticle)) { echo 'style="display:block"';} ?>>
			<div class="row">
				<h1 class="col s11">Modification du Message</h1>
				<div class="col s1">
					<i class="material-icons  right-align iconClose" onClick="closeModalArticle();">close</i>
				</div>
				<form id="udpate"  action="home.php?page=<?php echo $page; ?>" onsubmit="checkUpdateArticle(event)" method="post" class="col s12" enctype="multipart/form-data">
					<div class="row">
						<input class="updateIdMessage" type="hidden" name="id_message" />
						<div class="input-field col s12">
							<input id="title" type="text" name="title" class="validate updateTitle">
							<label for="title">Title</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<textarea id="message" class="materialize-textarea updateMessage" name="message" ></textarea>
							<label for="message">Your Message</label>
						</div>
					</div>
					<div class="row">
						<div class="file-field input-field">
							<div class="btn">
								<span>File</span>
								<input type="file" name="file" id="file">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path validate" type="text">
							</div>
						</div>
					</div>
					<div class="alert">
						<?php if (isset($returnErrorUpdateArticle) && !empty($returnErrorUpdateArticle)) {
							echo $returnErrorUpdateArticle;
						} 
						?>
					</div>

					<button class="btn submitPerso waves-effect waves-light right-align" type="submit" name="updateArticle">Submit
						<i class="material-icons right">send</i>
					</button>
				</form>
			</div>
		</div>
		<!--  END MODAL UPDATE MESSAGE -->

		<div class="container myContainer">
			<div class="row">
				<nav class="optionNav navPerso col s12 l12">
					<a href="#" class="brand-logo"><img src="../../assets/images_users/<?php echo $_SESSION["file"] . '#' . $r; ?>"><?php echo $_SESSION["firstname"]; ?> </a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a href="#modal2" onClick="modalCreateArticle();"><i class="material-icons">border_color</i></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div class="container myContainer">
			<div class="row">
				<?php
				foreach ($message as $value) { ?>
				<article class="col s12 l12">
					<h1 class="titleArticle col s10"><?php echo stripslashes($value['title']); ?></h1>
					<div class="btnPerso col s1 iconArticle" style="bottom: 45px; right: 24px;">
						<i class="material-icons  right-align " onClick='modalUpdate("<?php $toEncode["title"] = stripslashes($value["title"]);
								$toEncode["message"] = stripslashes($value["message"]);
								$toEncode["id_message"] = $value["id_message"];
								echo urlencode(json_encode($toEncode));?>")'>edit</i>
					</div>
					<div class="btnPerso  col s1 iconArticle" style="bottom: 45px; right: 24px;">
						<a href="home.php?delete=<?= $value['id_message'] ?>">
							<i class="material-icons  right-align ">close</i>
						</a>
					</div>
					<div class="contentImg col s8" <?php if(isset($value['file']) && !empty($value['file'])) { echo 'style="display:block"';} ?> ><img src="../../assets
						/images_articles/<?php echo $value['file'] . '#' . $r ?>"></div>
					<div class="contentMessage col s4"><?php echo stripslashes($value['message']); ?></div>
					<div class="user col s12 right-align">par <?php echo $_SESSION["firstname"]; ?>.</div>
				</article>
				<hr>
				<?php 
			}

			?>
			<ul class="pagination">
				<?php for ($i = 1; $i < $nbPages; $i++)
				{ 
					if ($page == $i)
					{
					?>
						<li class="active"><?php echo $i; ?></li>
					<?php } else { ?>
						<li class="waves-effect">
							<a href="home.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
						</li>
				<?php }
				} ?>
			</ul>
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