const Formulario = document.querySelector("#form-staff");
const idStaff        = document.querySelector("#id");
const nuevoStaff      = document.querySelector("#nuevo-staff");
const nuevoUsuario    = document.querySelector("#nuevo-usuario");
const nuevaContraseña = document.querySelector("#nueva-contraseña");
const esStaff         = document.querySelector("#es-staff");
const nuevaEmpresa    = document.querySelector("#nueva-Empresa");
const nuevoRol        = document.querySelector("#nuevo-rol");
const botonNuevo      = document.querySelector("#nuevo");
const botonGuardar    = document.querySelector("#guardar");
const botonEliminar   = document.querySelector("#guardar");
const opcionesEmpresa = document.querySelector("#opcionesEmpresa");
const opcionesRol = document.querySelector("#opcionesRol");

const ListarRegistro   = document.querySelector("#ListarRegistro");
var test ="";

// Funcion para Cargar valores Editarlos
ListarRegistro.addEventListener("click", (element) => {
    
    if (element.target.getAttribute("name") == 'editar'){
        try {
            let cliente = element.target.parentElement.parentElement;
            idStaff.value = cliente.querySelector('input[name="id"]').value;
            nuevoStaff.value = cliente.querySelector('input[name="nombre"]').value;
            nuevoUsuario.value = cliente.querySelector('input[name="usuario"]').value;
            // nuevaContraseña.value = cliente.querySelector('input[name="es_staff"]').value;
            // esStaff.value = cliente.querySelector('input[name="verificado"]').value;
            valorEmpresa = cliente.querySelector('input[name="nombre_cliente"]').getAttribute("data");
            
            opcionesEmpresa.selectedIndex = opcionesEmpresa.options[valorEmpresa].index;
            // nuevoRol.value = cliente.querySelector('input[name="id"]').value;

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
    if(idStaff.value !== '' ){
        // limpiamos el fomulario
        Formulario.reset();
        
        // VistaPrevia.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAACACAQAAACMha5pAAAAlklEQVR42u3PAQ0AAAwCoNu/9Gu4CQ3IzYq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6unqXBx4gAIE1+BdCAAAAAElFTkSuQmCC";
        //ImgBase64.value = VistaPrevia.src;
    }
    Formulario.reset();
    // volvemos a cargar imagen en blanco
    // ImgBase64.value = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAACACAQAAACMha5pAAAAlklEQVR42u3PAQ0AAAwCoNu/9Gu4CQ3IzYq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6unqXBx4gAIE1+BdCAAAAAElFTkSuQmCC";
    // de lo contrario
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