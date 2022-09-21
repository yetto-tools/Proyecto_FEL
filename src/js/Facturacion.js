const botonAgregar = document.querySelector('#agregar');
const ListaProductos = document.querySelector('#ListaProductos');
const listaTotal = document.querySelector('#listaTotal');
var inputSubtotal = document.querySelector('#subtotal');
var inputDescuento = document.querySelector('#descuento');
var inputTotal = document.querySelector('#total');


// funcion de boton agregar
botonAgregar.addEventListener('click', (e)=>{ 
	
	let indice = document.querySelector("#ListaProductos").childElementCount;
	
	ListaProductos.insertAdjacentHTML('beforeend',
		// creamos una nueva linea
		`
			<tr id="${indice+1}" name="linea">
			<th scope="row" name="numero">${indice+1}</th>
			<td><input type="text" name="producto" class="form-control form-control-sm" placeholder="Codigo" required></td>
			<td ><textarea name="descripcion"  rows="1" class="form-control form-control-sm" placeholder="Descripcion" required></textarea></td>
			<td><input type="number" name="cantidad" min="1" value="1" class="form-control form-control-sm" required></td>
			<td><input type="number" name="precio" min="0.1" value="0.00" step="any" class="form-control form-control-sm" required></td>
			<td><input type="number" name="monto" min="0.1" value="0.00" step="any" class="form-control form-control-sm" disabled readonly required></td>
			<th scope="row"><input type="button" name="quitar" class="btn btn-sm btn-danger" value="&Cross;"/></th>
			</tr> 
		`
	);
	document.querySelector("#\\31  > th:nth-child(7) > input").classList.remove('disabled');
	ListaProductos.lastElementChild.scrollIntoView({behavior: "smooth", block: 'nearest', inline: 'start' });
	ListaProductos.lastElementChild.querySelector('input[name="producto"]').focus();


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
		document.querySelector("#\\31  > th:nth-child(7) > input").classList.add('disabled');
	}


});

// Evento cambio de valores en el los input de la tabla 
ListaProductos.addEventListener('change', (e) =>{
	let indice = document.querySelector('#ListaProductos').childElementCount;

	if(indice>=1){
		try{
			let monto; 
			// filtar el elemento que se un input de numero para añadir evento
			//  de calcular el monto
			if(e.target.getAttribute("type") == 'number' && e.target.value >= 0.1) {
				// auto convertir a decimal el valor del precio
				e.target.parentElement.parentElement.querySelector('input[name="precio"]').value = 
					ConvertDecimal(e.target.parentElement.parentElement.querySelector('input[name="precio"]').value)
				
				// calcular el monto de la linea
				monto = 
				// converit a decimal el valor del monto
				ConvertDecimal( 
					e.target.parentElement.parentElement.querySelector('input[name="cantidad"]').value 
					* 
					e.target.parentElement.parentElement.querySelector('input[name="precio"]').value
				);
				// asignamos el calculo de monto al input de monto
				e.target.parentElement.parentElement.querySelector('input[name="monto"]').value = monto;
				SumaMotos(ListaProductos);
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
		let lista = element.querySelectorAll('input[name="monto"]');
		let montoTotal = 0;
		
		lista.forEach(monto => {
			montoTotal += parseFloat(monto.value);
		});

		inputSubtotal.value = ConvertDecimal(montoTotal);
		let Total = (inputSubtotal.value - inputDescuento.value)

		console.log(Total);
		inputTotal.value = ConvertDecimal(Total);
	}
	catch{
		return true;
	}

}


const ConvertDecimal = (x) =>{
  return Number.parseFloat(x).toFixed(2);
}
