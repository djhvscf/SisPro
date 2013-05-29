		//Elaborado por: Victor Perez Rodriguez
        //Fecha de creación: 11:40 a.m. 06/07/2012
        //Fecha de última modificación: 12:30 p.m. 06/07/2012
	function activarValidaciones() {
			var txtcodigo = new LiveValidation('txtCodigo');
           	txtcodigo.add(Validate.Presence);
		               	var txtNombre = new LiveValidation('txtNombre');
           	          	txtNombre.add(Validate.Presence);
						var nombre_grado = new LiveValidation('sltId_Grado');
						nombre_grado.add( Validate.Exclusion, { within: [ 'seleccion'], failureMessage: 'Debe seleccionar un grado academico' } );
}
function deseleccionarTodos() {
		var elem = document.getElementById('frmDatos').elements;
		for (var i=0; i<elem.length; i++) {
				elem[i].readOnly = true;
			}
	}
