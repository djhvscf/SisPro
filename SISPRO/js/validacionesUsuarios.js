			//<!--Elaborado por: Dennis Hernández Vargas, Creación: 4/7/2012 7:00p.m. Ultima modificación: 15/7/2012 11:41 p.m.-->
function activarValidaciones() {
	var txtNombre = new LiveValidation('txtNombre');
	txtNombre.add(Validate.Presence);
		var txtPrimerApellido = new LiveValidation('txtPrimerApellido');
			txtPrimerApellido.add(Validate.Presence);
				var txtSegundoApellido = new LiveValidation('txtSegundoApellido');
					txtSegundoApellido.add(Validate.Presence);
						var txtUsuario = new LiveValidation('txtUsuario');
							txtUsuario.add(Validate.Presence);
								var txtNumCedula = new LiveValidation('txtNumCedula');
											txtNumCedula.add(Validate.Presence);
												var pwdConfirmClave = new LiveValidation('pwdConfirmClave');  
												var pwdClave = new LiveValidation('pwdClave');  
													pwdConfirmClave.add(Validate.Confirmation, { match: 'pwdClave' , failureMessage: 'Contrase\u00F1as no coinciden' } );
													pwdConfirmClave.add(Validate.Presence, { failureMessage: "Campo obligatorio" } );
													pwdClave.add(Validate.Presence, { failureMessage: "Campo obligatorio" } );
													var pwdClaveActual = new LiveValidation('pwdClaveActual');
													pwdClaveActual.add(Validate.Presence, { failureMessage: "Campo obligatorio" } );
}
