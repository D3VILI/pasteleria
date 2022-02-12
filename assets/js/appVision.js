window.addEventListener("load",()=>{
	//Sirve para ver la contraseña
  let vision = document.querySelector("#vision");
  vision.addEventListener("click",()=>{
    let contrasena = document.querySelector("#contrasena");
    if(vision.className == "fas fa-eye-slash"){
      vision.className = "fas fa-eye";
      contrasena.type = "text";
    }else{
       vision.className = "fas fa-eye-slash";
      contrasena.type = "password";
    }
  });
})