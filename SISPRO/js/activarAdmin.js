var adminLogged;

function ocultarBarraAdmin () {
   	console.log(adminLogged);
   	
   	if (adminLogged == false) {
   		var mantenimiento = document.getElementById('mantenimiento');
   		mantenimiento.style.visibility = 'hidden';
   		var nombreUsuario = document.getElementById('nombreUsuario');
   		nombreUsuario.innerHTML = "vperez";
   	} 
}

function ocultarBarraAdminInicio() {
	var url = window.location.href;
	console.log(url);
   	var isAdmin = url.substring(url.lastIndexOf('?') + 1);
   	console.log(isAdmin);
   	
   	if (isAdmin == "false") {
   		adminLogged = false;
   		var mantenimiento = document.getElementById('mantenimiento');
   		mantenimiento.style.visibility = 'hidden';
   		var nombreUsuario = document.getElementById('nombreUsuario');
   		nombreUsuario.innerHTML = "vperez";
   	} else {
   		adminLogged = true;
   	}
}