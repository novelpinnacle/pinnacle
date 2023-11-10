function validateForm(){
valid=true;
eles=$("[required='']");
for(i=0;i<eles.length;i++){
	eles[i].addEventListener("focus",function(){this.classList.remove("w3-border-red");});
}
for(i=0;i<eles.length;i++){
	if(eles[i].value.trim()==""){
		eles[i].classList.add("w3-border-red");
		valid=false;
	}
}
return valid;
}
