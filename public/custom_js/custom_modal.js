function custom_model(action = 0) {
	window.setTimeout(function () {
		$("#modal_write_review")[0].style.display = "none";
		document.body.style.overflow = "auto";
	}, 300);
	$("#modal_write_review .modal_box")[0].style.transform = "scale(0)";
}


window.addEventListener(
	"load",
	modals_config,
	false
);

function modals_config() {
		var modal_buttons = $(".custom_modal_button");
		for (var i = 0; i < modal_buttons.length; i++) {
			modal_buttons[i].onclick = function () {
				var target = this.dataset.target;
				document.querySelector(target).removeAttribute("style");
				document.body.style.overflow = "hidden";
				// window.scrollTo(0, 0);
				window.setTimeout(function () {
					document
						.querySelector(target)
						.getElementsByClassName(
							"modal_box"
						)[0].style.transform = "scale(1)";
				}, 300);
			};
		}
	}