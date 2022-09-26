// Variales de Botones
const botonAgregar = document.querySelectorAll('input[name="editar"]');
const botonGuardar = document.querySelector("#guardar");
const botonNuevo = document.querySelector("#nuevo");
// variables para Elentos html 
const ListaEmpresas = document.querySelector("#ListaEmpresas");
const IdEmpresa = document.querySelector("#id-empresa");
const NuevoNit = document.querySelector("#nuevo-nit");
const NuevoEmpresa = document.querySelector("#nuevo-empresa");
const NuevoTelefono = document.querySelector("#nuevo-telefono");
const NuevoDireccion = document.querySelector("#nueva-direccion");
const NuevoDepartament = document.querySelector("#nuevo-departamento");
const NuevoMunicipio = document.querySelector("#nuevo-municipio");
const NuevoLogo = document.querySelector("#nuevo-logo");
const VistaPrevia = document.querySelector("#img-preview");
const Formulario = document.querySelector("#form-empresa");
const ImgSize = document.querySelector("#img-size");
var test = null;
// Funcion para Cargar valores Editarlos
ListaEmpresas.addEventListener("click", (element) => {
    
    if (element.target.getAttribute("name") == 'editar'){
        console.log("safdas")
        try {
            let empresa = element.target.parentElement.parentElement;
            IdEmpresa.value = empresa.querySelector('input[name="id"]').value;
            NuevoNit.value = empresa.querySelector('input[name="nit"]').value;
            NuevoEmpresa.value = empresa.querySelector('input[name="empresa"]').value;
            NuevoDireccion.value = empresa.querySelector('textarea[name="direccion"]').value;
            NuevoTelefono.value = empresa.querySelector('input[name="telefono"]').value;
            NuevoDepartament.value = empresa.querySelector('input[name="departamento"]').value;
            NuevoMunicipio.value = empresa.querySelector('input[name="municipio"]').value;
            VistaPrevia.src = empresa.querySelector('img[name="logo-preview"]').src;
            ImgSize.innerHTML = 'tamaño: '+ ( (VistaPrevia.src.length   - "data:image/png;base64,".length ) /1024).toFixed(2)+' KB';
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
        ImgSize.innerHTML = "tamaño: 0 KB"
        VistaPrevia.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAACACAQAAACMha5pAAAAlklEQVR42u3PAQ0AAAwCoNu/9Gu4CQ3IzYq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6unqXBx4gAIE1+BdCAAAAAElFTkSuQmCC";
    }
    Formulario.reset()
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
            }
            fr.readAsDataURL(files[0]);
        }
    
        // Not supported
        else {
            // fallback -- perhaps submit the input to an iframe and temporarily store
            // them on the server until the user's session ends.
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