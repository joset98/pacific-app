export default{
    transformRequest(request){
		let data = {
			title: 'Exitoso',
			type: 'success',
			text: 'Operacion exitosa'
		};
		console.log(request.status)
		if (request.status == 422){
			console.log('aqui')
			data.title = 'Error con los datos';
			data.type = 'error'
			data.text = request.data[0];
		}
		if (request.status == 400 || request.status == 404){
			data.title = request.data;
			data.type = 'warn'
			data.text = 'Operacion Fallida';
		}

		if (request.status == 500){
			data.title = 'Operacion Fallida.';
			data.type = 'error';
			data.text = request.data.message;
		}

		return data;
    }
}
