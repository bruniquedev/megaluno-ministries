function loader(bool = 0) {
	if (bool == 0) $("#custom_loader")[0].style.display = "none";
	else $("#custom_loader")[0].style.display = "flex";
}

/*
loader(1);//show loader
window.addEventListener('load', function (){
loader(0);//hide loader
},false);
*/