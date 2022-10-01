// Variales de Botones
const botonAgregar = document.querySelectorAll('input[name="editar"]');
const botonGuardar = document.querySelector("#guardar");
const botonNuevo = document.querySelector("#nuevo");
const botonEliminar = document.querySelector("#eliminar");
// variables para Elentos html 
const ListaProductos = document.querySelector("#ListaProductos");
const IdProducto = document.querySelector("#id-producto");
const NuevoCogido = document.querySelector("#nuevo-codigo");

const NuevoDescripcion = document.querySelector("#nueva-descripcion");
const NuevoPrecio = document.querySelector("#nuevo-precio");
const NuevoLogo = document.querySelector("#nuevo-logo");
const VistaPrevia = document.querySelector("#img-preview");
const Formulario = document.querySelector("#form-producto");
const ImgSize = document.querySelector("#img-size");
const ImgBase64 = document.querySelector("#base64-logo");
var test = null;

// Funcion para Cargar valores Editarlos
ListaProductos.addEventListener("click", (element) => {
    
    if (element.target.getAttribute("name") == 'editar'){
        try {
            let producto = element.target.parentElement.parentElement;
            IdProducto.value = producto.querySelector('input[name="id"]').value;
            NuevoCogido.value = producto.querySelector('input[name="codigo"]').value;
            NuevoDescripcion.value = producto.querySelector('textarea[name="descripcion"]').value;
            NuevoPrecio.value = producto.querySelector('input[name="precio"]').value;
            VistaPrevia.src = producto.querySelector('img[name="logo-preview"]').src;
            ImgSize.innerHTML = 'tamaño: '+ ( (VistaPrevia.src.length   - "data:image/png;base64,".length ) /1024).toFixed(2)+' KB';
            ImgBase64.value = VistaPrevia.src;
            ActivarBotonGuardado();
        } catch(error){
            console.log(error)
            if(!element.target.parentElement.parentElement){
               DescativarBotonGuardado();
            }
        }
    }
});
// activar boton de guardado cuando hay cambios en el formulario
Formulario.addEventListener("input", (element) =>{
    // desactivamos el boton de guardad hasta que occura un cambio
        DescativarBotonGuardado();
    // si el elemento html es de tipo class="form control" 
    // y los input no esten vacios
    if( element.target.classList[0] === 'form-control' &&  NuevoCogido.value !== ""  
          && NuevoPrecio.value !=="" && NuevoDescripcion.value !==""
            ){
        // activamos el boton de guadado
        ActivarBotonGuardado();
    }else{
        DescativarBotonGuardado();
    }
});

// Funcion para Boton Nuevo 
botonNuevo.addEventListener("click", ()=>{
    DescativarBotonGuardado();
    // si el ID de la impresa esta vacio entoces
    Formulario.classList.add('was-validated')
    if(IdProducto.value !== '' ){
        // limpiamos el fomulario
        Formulario.reset();
        // reseteamos la etiqueta de tamaño
        ImgSize.innerHTML = "tamaño: 0 KB"
        VistaPrevia.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAACACAQAAACMha5pAAAAlklEQVR42u3PAQ0AAAwCoNu/9Gu4CQ3IzYq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6unqXBx4gAIE1+BdCAAAAAElFTkSuQmCC";
        ImgBase64.value = VistaPrevia.src;
    }
    Formulario.reset();
    // volvemos a cargar imagen en blanco
    ImgBase64.value = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAACACAQAAACMha5pAAAAlklEQVR42u3PAQ0AAAwCoNu/9Gu4CQ3IzYq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6unqXBx4gAIE1+BdCAAAAAElFTkSuQmCC";
    // de lo contrario
});
async function jsonPost(url = '', data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
      method: 'POST', // *GET, POST, PUT, DELETE, etc.
      mode: 'cors', // no-cors, *cors, same-origin
      cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
      credentials: 'same-origin', // include, *same-origin, omit
      headers: {
        'Content-Type': 'application/json'
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
      redirect: 'follow', // manual, *follow, error
      referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
      body: JSON.stringify(data) // body data type must match "Content-Type" header
    });
    return response.json(); // parses JSON response into native JavaScript objects
  }

  async function formDELETE(url = '', id) {
    var formData = new FormData();
    formData.append("id-producto", id);
    // Default options are marked with *
    const response = await fetch(url, {
      method: 'DELETE', // *GET, POST, PUT, DELETE, etc.
      mode: 'cors', // no-cors, *cors, same-origin
      cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
      credentials: 'same-origin', // include, *same-origin, omit
      headers: {
        //'Content-Type': 'application/json'
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      redirect: 'follow', // manual, *follow, error
      referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
      body:  new URLSearchParams(formData)// body data type must match "Content-Type" header
    });
    if(response.status == 202){
        window.location.replace(url);
    }
    return response.status;
    //return response.json(); // parses JSON response into native JavaScript objects
  }

botonEliminar.addEventListener("click",()=>{
    
	if(IdProducto.value != ""){
		let url = document.location['origin']+
		'/Proyecto_FEL/Productos.php';
        formDELETE(url,IdProducto.value);
        
        window.location.replace(url);
        
	}

});

NuevoLogo.addEventListener("change", (element)=>{
    console.log(element.target);
        var tgt = element.target || window.event.srcElement,
        files = tgt.files;
        ImgSize.innerHTML = "tamaño: "+(files[0]['size'] /1024).toFixed(2)+" KB"
        // Leemos el archivo cargado
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                VistaPrevia.src = fr.result;
                ImgBase64.value = VistaPrevia.src;
            }
            fr.readAsDataURL(files[0]);
        }
});


// Funcion para Activar boton de guardado
const ActivarBotonGuardado = ()=>{
        // quitamos el atributo disabled del boton guardado
        botonGuardar.removeAttribute("disabled");
        botonEliminar.removeAttribute("disabled");
        // cambiamos la class para cambiar de color
        botonGuardar.classList.replace("btn-outline-secondary", "btn-success");
        botonEliminar.classList.replace("btn-outline-secondary", "btn-danger");
};

// Funcion para Activar boton de guardado
const DescativarBotonGuardado = ()=>{
    // quitamos el atributo disabled del boton guardado
    botonGuardar.setAttribute("disabled", "disabled");
    botonEliminar.setAttribute("disabled","disabled");
    // cambiamos la class para cambiar de color
    botonGuardar.classList.replace("btn-success","btn-outline-secondary");
    botonEliminar.classList.replace("btn-danger","btn-outline-secondary");
};

(() => {
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('input', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  })()