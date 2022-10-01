
const botonFirmar = document.querySelector("#Firmar");
const botonBuscar = document.querySelector("#buscar");
const botonAgregar = document.querySelector('#agregar');
const ListaProductos = document.querySelector('#ListaProductos');
const listaTotal = document.querySelector('#listaTotal');
var inputSubtotal = document.querySelector('#subtotal');
var totalSinIVA =	document.querySelector("#totalSinIVA");
var IVA = document.querySelector("#IVA");
var inputDescuento = document.querySelector('#descuento');

const inputNITFactura = document.querySelector("#nit");
const inputNombreFactura = document.querySelector("#nombre");
const inputDireccionFactura = document.querySelector("#direccion");


var inputTotal = document.querySelector('#total');

// poner fecha del dia
document.querySelector("#fecha").valueAsDate = new Date()
// funcion de boton agregar

var test = "";

botonBuscar.addEventListener('click', (e)=>{
	//1234567k
	console.log(inputNITFactura.value);
	if(inputNITFactura.value !==""){
		let url = document.location['origin']+
		'/Proyecto_FEL/ajax.php?cliente='+inputNITFactura.value;

		fetch(url)
		  .then(response => response.json())
		  .then(data => {
			if(data != null){
				inputNombreFactura.value = data['lista_cliente_nit']
				inputDireccionFactura.value = data['lista_cliente_direccion']
			}else{
				alert("NO existe el NIT del Cliente");
			}
			console.log(data)
		}).catch(error => console.log(error));
	}


	});



botonAgregar.addEventListener('click', (e)=>{

	let indice = document.querySelector("#ListaProductos").childElementCount;

	ListaProductos.insertAdjacentHTML('beforeend',
		// creamos una nueva linea
		`
			<tr id="${indice+1}" name="linea">
			<th scope="row" name="numero">${indice+1}</th>
			<td ><input type="text" name="productos[]" class="form-control form-control-sm" placeholder="Codigo" required></td>
			<td name="descripcion"><textarea name="descripciones[]" rows="1" class="form-control form-control-sm" placeholder="Descripcion" required></textarea></td>
			<td ><input type="number" name="cantidades[]" min="1" value="1" class="form-control form-control-sm"></td>
			<td ><input type="number" name="precios[]" min="0.1" value="0.00" step="any" class="form-control form-control-sm" required></td>
			<td ><input type="number" name="montos[]" min="0.1" value="0.00" step="any" class="form-control form-control-sm text-muted fw-bold bg-light" readonly required></td>
			<th class="text-center"><input type="button" name="quitar" class="btn btn-sm btn-danger" value="&Cross;"/></th>
			</tr>
		`
	);
	document.querySelector("#\\31  > th.text-center > input").classList.remove('disabled');
	ListaProductos.lastElementChild.scrollIntoView({behavior: "smooth", block: 'nearest', inline: 'start' });
	ListaProductos.lastElementChild.querySelector('input[name="productos[]"]').focus();


	// Reordenar la lista del 1 hasta N numeros
});

// funcion del boton quitar
ListaProductos.addEventListener('click', (e)=>{
	// obtenermos el numero actual de elementos el la tabla
	let indice = document.querySelector("#ListaProductos").childElementCount;


	if(indice>1){
		try{
			// si el elemento que se hace click tiene el nombre de quitar
			if (e.target.parentElement.lastChild.getAttribute('name') == 'quitar'){
				e.target.parentElement.parentElement.remove();
				// Reordenar la lista del 1 hasta N numeros
				ordenarLineas('input[name="quitar"]','id');
				SumaMotos(ListaProductos);
			}
		}
		catch{
			return true;
		}
	}
	if (indice == 2 ){
		document.querySelector("#\\31  > th.text-center > input").classList.add('disabled');
	}


});

// Evento cambio de valores en el los input de la tabla
ListaProductos.addEventListener('change', (e) =>{
	document.querySelector("#numeroFactura").value = uuidv4();
	var indice = document.querySelector('#ListaProductos').childElementCount;

	if(e.target.getAttribute("name") == 'productos[]') {
		var linea = e.target.parentElement.parentElement;
		console.log(linea);
		let url = document.location['origin']+
		'/Proyecto_FEL/ajax.php?producto='+e.target.value;
		console.log(url);
		fetch(url)
		  .then(response => response.json())
		  .then(data => {
			if (data != null){
				linea.querySelector('textarea[name="descripciones[]"]').value =data['descripcion'];
				var precio = linea.querySelector('input[name="precios[]"]')

				precio.value = data['precio'];
				var monto = linea.querySelector('input[name="montos[]"]');

				monto.value = ConvertDecimal(data['precio']);

				var cantidad = linea.querySelector('input[name="cantidades[]"]');

				cantidad.addEventListener("input", (event) =>{
					monto.value = ConvertDecimal(cantidad.value * precio.value);
					SumaMotos(ListaProductos);
				});

				precio.addEventListener("input", (event) =>{
					monto.value = ConvertDecimal(cantidad.value * precio.value);
					SumaMotos(ListaProductos);
				});



			}else{
				alert("NO existe el codigo del producto");
			}
			SumaMotos(ListaProductos);
			console.log("asfsa",data)
		})
		.catch(error => console.log(error));
	}


	if(indice>=1){
		try{
			let monto;
			// filtar el elemento que se un input de numero para añadir evento
			//  de calcular el monto
			if(e.target.getAttribute("type") == 'number' && e.target.value >= 0.1) {
				// auto convertir a decimal el valor del precio
				e.target.parentElement.parentElement.querySelector('input[name="precios[]"]').value =
					ConvertDecimal(e.target.parentElement.parentElement.querySelector('input[name="precios[]"]').value)

				// calcular el monto de la linea
				monto =
				// converit a decimal el valor del monto
				ConvertDecimal(
					e.target.parentElement.parentElement.querySelector('input[name="cantidades[]"]').value
					*
					e.target.parentElement.parentElement.querySelector('input[name="precios[]"]').value
				);
				// asignamos el calculo de monto al input de monto
				e.target.parentElement.parentElement.querySelector('input[name="montos[]"]').value = monto;
			}
		}
		catch{
			return true;
		}

	}

});

inputDescuento.addEventListener('change', (e)=>{

	if(inputDescuento.value ==""){
	inputDescuento.value = ConvertDecimal("0");
	}
	if (inputDescuento.value !== 0){
		inputTotal.value =  ConvertDecimal( inputSubtotal.value - inputDescuento.value );
	}
	inputDescuento.value = ConvertDecimal(inputDescuento.value);
});



// ordernar numeracion de lineas
const ordenarLineas = (element,attribute) =>{
	document.querySelectorAll(element).forEach((linea, id) => {
		linea.parentElement.parentElement.setAttribute(attribute,id+1);
		document.querySelectorAll('th[name="numero"]').forEach((linea,id) =>{
			linea.innerHTML = id+1;
		});
	});
}




const SumaMotos = (element) =>{
	try	{
		var lista = element.querySelectorAll('input[name="montos[]"]');		
		var montosSumados = 0;

		lista.forEach(monto => {
			montosSumados += parseFloat(monto.value);
		});

		inputSubtotal.value = montosSumados;
		inputTotal.value = ConvertDecimal(montosSumados - inputDescuento.value)
		totalSinIVA.value = ConvertDecimal(inputTotal.value /1.12)
		IVA.value = ConvertDecimal(inputTotal.value - totalSinIVA.value)


		
	}
	catch{
		return true;
	}

}
inputDescuento.addEventListener("input",(event)=>{
	SumaMotos(ListaProductos);
});





const ConvertDecimal = (x) =>{
  return Number.parseFloat(x).toFixed(2);
}

const uuidv4 =() => {
	return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
	  (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16).toUpperCase()
	);
}

// botonFirmar.addEventListener('submit', (event) => {
// 	let url = document.location['origin']+
// 	'/Proyecto_FEL/pdf.php?facturaPDF='+'';

// 	fetch(url)
// 	.then(response => response.json())
// 	.then(data => {
		
// 	})
// 	.catch(console.log(erro));

// });