
var modalRegistration = function() {

	var Openmodal = document.getElementsByClassName("formRegistration")[0];
	Openmodal.style.cssText = "display:block !important;z-index: 10 !important;";

	var ClosemodalConnection = document.getElementsByClassName("formConnection")[0];
	ClosemodalConnection.style.cssText = "display:none !important;z-index: 0 !important;";

}
var modalConnection = function() {
	var Openmodal = document.getElementsByClassName("formConnection")[0];
	Openmodal.style.cssText = "display:block !important;z-index: 10 !important;";

	var ClosemodalRegister = document.getElementsByClassName("formRegistration")[0];
	ClosemodalRegister.style.cssText = "display:none !important;z-index: 0 !important;";

}

var closeModal = function() {
	var ClosemodalRegister = document.getElementsByClassName("formRegistration")[0];
	ClosemodalRegister.style.cssText = "display:none !important;z-index: 0 !important;";

	var ClosemodalConnection = document.getElementsByClassName("formConnection")[0];
	ClosemodalConnection.style.cssText = "display:none !important;z-index: 0 !important;";


}

var modalCreateArticle = function() {
	var Openmodal = document.getElementsByClassName("createArticle")[0];
	Openmodal.style.cssText = "display:block !important;z-index: 10 !important;";

}

var closeModalArticle = function() {
	var ClosemodalArticle = document.getElementsByClassName("createArticle")[0];
	ClosemodalArticle.style.cssText = "display:none !important;z-index: 0 !important;";


	var ClosemodalUpdate = document.getElementsByClassName("updateArticle")[0];
	ClosemodalUpdate.style.cssText = "display:none !important;z-index: 0 !important;";



}
var modalUpdate = function(object) {
	var datas = JSON.parse(decodeURIComponent(object.replace(/\+/g, '%20')));
	var Openmodal = document.getElementsByClassName("updateArticle")[0];
	document.getElementsByClassName("updateIdMessage")[0].value = datas.id_message;
	document.getElementsByClassName("updateMessage")[0].value = datas.message;
	document.getElementsByClassName("updateTitle")[0].value = datas.title;
	Openmodal.style.cssText = "display:block !important;z-index: 10 !important;";

	var ClosemodalImg = document.getElementsByClassName("createArticle")[0];
	ClosemodalImg.style.cssText = "display:none !important;z-index: 0 !important;";
}


var checkSubmitArticle = function(event) {
	var title = document.getElementsByClassName("createTitle")[0].value;
	var message = document.getElementsByClassName("createMessage")[0].value;

	if (title.trim().length == 0)
	{
		alert("Un titre doit être fourni");
		event.preventDefault();
		return false;
	}
	if (message.trim().length == 0)
	{
		alert("Un message doit être fourni");
		event.preventDefault();
		return false;
	}
	if (message.trim().length > 120)
	{
		alert("Message trop long (120 caractères max)");
		event.preventDefault();
		return false;
	}
	return true;
}

var checkUpdateArticle = function(event) {
	var title = document.getElementsByClassName("updateTitle")[0].value;
	var message = document.getElementsByClassName("updateMessage")[0].value;

	if (title.trim().length == 0)
	{
		alert("Un titre doit être fourni");
		event.preventDefault();
		return false;
	}
	if (message.trim().length == 0)
	{
		alert("Un message doit être fourni");
		event.preventDefault();
		return false;
	}
	if (message.trim().length > 120)
	{
		alert("Message trop long (120 caractères max)");
		event.preventDefault();
		return false;
	}
	return true;
}

