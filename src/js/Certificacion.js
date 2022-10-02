const fechaIncial = document.querySelector("#fecha-inicial");
const fechaFinal = document.querySelector("#fecha-final");

const currentDate = new Date();

fechaIncial.valueAsDate = new Date(currentDate.getFullYear(),currentDate.getMonth(), 1 );
fechaFinal.valueAsDate = new Date(currentDate.getFullYear(),currentDate.getMonth()+1, 0 );


