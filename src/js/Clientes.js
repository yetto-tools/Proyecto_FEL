// Variales de Botones
const botonAgregar = document.querySelectorAll('input[name="editar"]');
const botonGuardar = document.querySelector("#guardar");
const botonNuevo = document.querySelector("#nuevo");
// variables para Elentos html 
const ListaClientes = document.querySelector("#ListaClientes");
const IdEmpresa = document.querySelector("#id-cliente");
const NuevoNit = document.querySelector("#nuevo-nit");
const NuevoEmpresa = document.querySelector("#nuevo-cliente");
const NuevoTelefono = document.querySelector("#nuevo-telefono");
const NuevoDireccion = document.querySelector("#nueva-direccion");
const NuevoDepartament = document.querySelector("#nuevo-departamento");
const NuevoMunicipio = document.querySelector("#nuevo-municipio");
const NuevoLogo = document.querySelector("#nuevo-logo");
const VistaPrevia = document.querySelector("#img-preview");
const Formulario = document.querySelector("#form-cliente");
const ImgSize = document.querySelector("#img-size");
const ImgBase64 = document.querySelector("#base64-logo");
var test = null;

// Funcion para Cargar valores Editarlos
ListaClientes.addEventListener("click", (element) => {
    
    if (element.target.getAttribute("name") == 'editar'){
        try {
            let cliente = element.target.parentElement.parentElement;
            IdEmpresa.value = cliente.querySelector('input[name="id"]').value;
            NuevoNit.value = cliente.querySelector('input[name="nit"]').value;
            NuevoEmpresa.value = cliente.querySelector('input[name="cliente"]').value;
            NuevoDireccion.value = cliente.querySelector('textarea[name="direccion"]').value;
            NuevoTelefono.value = cliente.querySelector('input[name="telefono"]').value;
            VistaPrevia.src = cliente.querySelector('img[name="logo-preview"]').src;
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
    if( element.target.classList[0] === 'form-control' &&  NuevoNit.value !== ""  
          && NuevoEmpresa.value !=="" && NuevoDireccion.value !==""
            ){
        // activamos el boton de guadado
        ActivarBotonGuardado();
    }else{
        DescativarBotonGuardado();
    }
});

// Funcion para Boton Nuevo 
botonNuevo.addEventListener("click", (element)=>{
    DescativarBotonGuardado();
    // si el ID de la impresa esta vacio entoces
    Formulario.classList.add('was-validated')
    if(IdEmpresa.value !== '' ){
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
        // cambiamos la class para cambiar de color
        botonGuardar.classList.replace("btn-outline-secondary", "btn-success");
};

// Funcion para Activar boton de guardado
const DescativarBotonGuardado = ()=>{
    // quitamos el atributo disabled del boton guardado
    botonGuardar.setAttribute("disabled", "disabled");
    // cambiamos la class para cambiar de color
    botonGuardar.classList.replace("btn-success","btn-outline-secondary");
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