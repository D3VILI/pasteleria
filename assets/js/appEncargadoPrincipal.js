window.addEventListener("load",()=>{
	let pulsados = document.querySelectorAll("a.pulsarEncargo");
	let calendar = document.querySelector("div.calendario");

	calendar.addEventListener("mouseleave",()=>{
			calendar.style.display = "none";	
		});
	

})