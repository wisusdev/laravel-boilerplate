$(document).ready(function () {
    $.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});

    $('body').on('click', '#editSetting', function () {
		let id = $(this).data('id');

		$.get(`/setting/${id}/edit`, function (data) {
			$('#settingTitleModal').html("Editando registro");
			$('#btnSave').val("edit");
			$('#settingModal').modal('show');

			$('#key').val(data.body.key);
			$('#value').val(data.body.value);
		})
	});
});