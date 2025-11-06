function show_mypopup(message = "", show = 0) {
	if (show == 0) $("#custom_popup_message")[0].style.display = "none";
	else if (show == 1) $("#custom_popup_message")[0].style.display = "flex";
	$("#custom_popup_message p")[0].innerHTML = message;
}