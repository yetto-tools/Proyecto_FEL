// Variales de Botones
const botonAgregar = document.querySelectorAll('input[name="editar"]');
const botonGuardar = document.querySelector("#guardar");
const botonNuevo = document.querySelector("#nuevo");
// variables para Elentos html 
const ListaClientes = document.querySelector("#ListaClientes");
const IdRol = document.querySelector("#id-rol");
const NuevoRol = document.querySelector("#nuevo-rol");
const NuevoDescripcion = document.querySelector("#nueva-descripcion");
const NuevoClienteId = document.querySelector("#nuevo-cliente_id");
const NuevoPermiso = document.querySelector("#nuevo-nuevo-permiso_id");

const Formulario = document.querySelector("#form-roles");


var test = null;

// Funcion para Cargar valores Editarlos
ListaClientes.addEventListener("click", (element) => {
    
    if (element.target.getAttribute("name") == 'editar'){
        try {
            let cliente = element.target.parentElement.parentElement;
            IdRol.value = cliente.querySelector('input[name="id"]').value;
            NuevoRol.value = cliente.querySelector('input[name="rol"]').value;
            NuevoPermiso.value = cliente.querySelector('input[name="permiso_id"]').value;
            NuevoDescripcion.value = cliente.querySelector('textarea[name="descripcion"]').value;
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
    if( element.target.classList[0] === 'form-control' &&  NuevoRol.value !== ""  
          && NuevoDescripcion.value !=="" //&& NuevoDireccion.value !==""
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
    if(IdRol.value !== '' ){

        Formulario.reset();

    }
    Formulario.reset();
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