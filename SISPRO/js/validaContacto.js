function activarValidaciones() {
	var dia = new LiveValidation('slcDia');
		dia.add( Validate.Exclusion, { within: [ 'seleccion'], failureMessage: 'Seleccionar un dia' } );
		var mes = new LiveValidation('slcMes');
		mes.add( Validate.Exclusion, { within: [ 'seleccion'], failureMessage: 'Seleccionar un mes' } );
		var año = new LiveValidation('slcAnio');
		año.add( Validate.Exclusion, { within: [ 'seleccion'], failureMessage: 'Seleccionar un año' } );
		var hora = new LiveValidation('slcHora');
		hora.add( Validate.Exclusion, { within: [ 'seleccion'], failureMessage: 'Seleccionar hora' } );
		var minutos = new LiveValidation('slcMinutos');
		minutos.add( Validate.Exclusion, { within: [ 'seleccion'], failureMessage: 'Seleccionar minutos' } );
		var info = new LiveValidation('slcInfo');
		info.add( Validate.Exclusion, { within: [ '0'], failureMessage: 'Seleccionar informacion suministrada' } );
		var medio = new LiveValidation('slcMedio');
		medio.add( Validate.Exclusion, { within: [ '0'], failureMessage: 'Seleccionar medio de comunicacion' } );
		
	var txaComentario = new LiveValidation('txaComentario');
	txaComentario.add(Validate.Presence, { failureMessage: 'Agregar comentarios' });
}
