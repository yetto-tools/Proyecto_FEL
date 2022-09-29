const idCliente     = document.querySelector("#id-cliente");
const usuario       = document.querySelector("#nuevo-Usuario");
const contraseña    = document.querySelector("#nuevo-contraseña");
const nit           = document.querySelector("#nuevo-nit");
const empresa       = document.querySelector("#nuevo-cliente");
const telefono      = document.querySelector("#nuevo-telefono");
const direccion     = document.querySelector("#nueva-direccion");
const logo          = document.querySelector("#nuevo-logo");
const base64Logo    = document.querySelector("#base64-logo");
const ImgSize = document.querySelector("#img-size");
const vistaPrevia   = document.querySelector("#img-preview");


logo.addEventListener("change", (element)=>{
    console.log(element.target);
        var tgt = element.target || window.event.srcElement,
        files = tgt.files;
        ImgSize.innerHTML = "tamaño: "+(files[0]['size'] /1024).toFixed(2)+" KB"
        // Leemos el archivo cargado
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                vistaPrevia.src = fr.result;
                base64Logo.value = vistaPrevia.src;
            }
            fr.readAsDataURL(files[0]);
        }
});


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