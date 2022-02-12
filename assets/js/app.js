window.addEventListener("load",()=>{
  //Te muestra la hora todo el rato

  let horario = document.querySelector("#hora");
  let tiempo = new Date();
  hora = tiempo.getHours();
  minuto = tiempo.getMinutes();
  segundo = tiempo.getSeconds();

  str_segundo = new String (segundo);
  str_minuto = new String (minuto);
  str_hora = new String (hora);

  if (str_segundo.length == 1) {
    segundo = "0" + segundo;
  }
  if (str_minuto.length == 1) {
    minuto = "0" + minuto;
  }
  if (str_hora.length == 1) {
    hora = "0" + hora;
  }

  horario.innerHTML = hora+":"+minuto+":"+segundo;
 
  let reloj = setInterval(()=>{

    let horario = document.querySelector("#hora");
    let tiempo = new Date();
    hora = tiempo.getHours();
    minuto = tiempo.getMinutes();
    segundo = tiempo.getSeconds();

    str_segundo = new String (segundo);
    str_minuto = new String (minuto);
    str_hora = new String (hora);

    if (str_segundo.length == 1) {
      segundo = "0" + segundo;
    }
    if (str_minuto.length == 1) {
      minuto = "0" + minuto;
    }
    if (str_hora.length == 1) {
      hora = "0" + hora;
    }

    horario.innerHTML = hora+":"+minuto+":"+segundo;
  },1000);

   //Sirve para Borrar los trabajos
  let borrar = document.querySelectorAll(".borrart");
  for (let i = 0; i < borrar.length; i++) {
    borrar[i].addEventListener("click",(evento)=>{
      if(!confirm("¿Desea borrar el trabajo seleccionado?")){
            evento.preventDefault();
      }
    });   
  }
  //Sirve para borrar las notcias
  borrar = document.querySelectorAll(".borrarn");
  for (let i = 0; i < borrar.length; i++) {
    borrar[i].addEventListener("click",(evento)=>{
      if(!confirm("¿Desea borrar la noticia seleccionada?")){
            evento.preventDefault();
      }
    });   
  }

   //Sirve para borrar los encargos
  borrar = document.querySelectorAll(".borrare");
  for (let i = 0; i < borrar.length; i++) {
    borrar[i].addEventListener("click",(evento)=>{
      if(!confirm("¿Desea borrar el encargo seleccionado?")){
            evento.preventDefault();
      }
    });   
  }
})
