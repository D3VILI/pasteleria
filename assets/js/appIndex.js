window.addEventListener("load",()=>{
	let menu = document.querySelector("#rmenu");
	document.addEventListener("contextmenu",(evento)=>{
    evento.preventDefault();
     	menu.style.top =  evento.pageY +"px";
    	menu.style.left = evento.pageX +"px";
    	menu.style.display = "block";
  });
	document.addEventListener("click",()=>{
		menu.style.display = "none";
	});
})