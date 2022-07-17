$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});

	$("body").on("change", "#file", function(){
		let mediaCount = document.getElementById('file').files.length
		$("#file_count").text(mediaCount);
		if(mediaCount > 0){
			$("#sendFile").attr("disabled", false);
		}
	});

	// Destroy Addon
	$('body').on('click', '.deleteAddon', function () {
		let addonId = $(this).data('id');

		Swal.fire({
			title: '¿Estas seguro?',
			text: "No podrás revertir esto.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sí, bórralo.',
			cancelButtonText: '¡No, cancela!',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "DELETE",
					url: `/addons/${addonId}`,
					success: function (response) {
						$("#addon-" + addonId).remove();
					},
					error: function (response) {
						console.log('Error:', response);
					}
				});
			}
		})


	});
});