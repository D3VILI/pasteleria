window.addEventListener("load",()=>{
	let encargado = document.querySelector("#encargado");
  encargado.addEventListener("click",()=>{

      let fecha = document.querySelector("#fecha").value;
      let hora = document.querySelector("#horario").value;
      let producto = document.querySelector("#producto").value;
      let extra = document.querySelector("#extra").value;
      let cliente = document.querySelector("#cliente").value;
       if(!confirm("¿Desea continuar con el encargo? Fecha: "+fecha+" Horario: "+hora+" Producto: "+producto+
        " Extra: "+extra+" Cliente: "+cliente)){
            evento.preventDefault();
      }
  });
})