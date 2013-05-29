			//<!--Elaborado por: Dennis Hernández Vargas, Creación: 4/7/2012 7:00p.m. Ultima modificación: 17/7/2012 10:42 a.m.-->
function activarValidaciones() {
	var pwdClave = new LiveValidation('pwdClave');
		pwdClave.add(Validate.Presence);
		pwdClave.add(Validate.Presence, { failureMessage: "Campo obligatorio" } );
		pwdClave.add(Validate.Confirmation, { match: 'pwdConfirmClave' , failureMessage: 'Contrase\u00F1as no coinciden' } );
			var pwdConfirmClave = new LiveValidation('pwdConfirmClave');  
				pwdConfirmClave.add(Validate.Presence, { failureMessage: "Campo obligatorio"} );
				pwdConfirmClave.add(Validate.Confirmation, { match: 'pwdClave' , failureMessage: 'Contrase\u00F1as no coinciden' } );
}