function PonerCursor(){
    frmDatos.txtID.focus();
    return true;
}

function activarValidaciones() {
	var username = new LiveValidation('login-username');
	username.add(Validate.Presence);
	var pass = new LiveValidation('login-password');
	pass.add(Validate.Presence);
}

			
function Validar(formulario){
	var isAdmin = false;
	if (document.getElementById('login-username').value==""){
		alert("Debe introducir un nombre de usuario." );
		document.getElementById('login-username').focus();
		return false;
	}else if (document.getElementById('login-password').value==""){
		alert("Debe introducir una contrasena" );
		document.getElementById('login-password').focus();
		return false;
	}else if ((document.getElementById('login-username').value=="vperez") && (document.getElementById('login-password').value=="pass")) {
		isAdmin= false;
		load("inicio.php?", isAdmin);
		return false;
	}else if ((document.getElementById('login-username').value=="jpmedrano") && (document.getElementById('login-password').value=="pass")) {
		isAdmin = true;
		load("inicio.php?", isAdmin);
		return false;
	}else if (document.getElementById('login-username').value!=="jpmedrano" || document.getElementById('login-username').value!=="user") {
		alert("Datos inv\u00E1lidos");
		return false;
	}else if (document.getElementById('login-password').value!=="pass") {
		alert("Contraseñ&oacute;a inv\u00E1lida");
		return false;
	}			
}
			
function load(url, isAdmin) {
	window.location=url + isAdmin;
}