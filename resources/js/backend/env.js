$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});

	$('body').on('click', '#editEnv', function () {
		let id = $(this).data('id');

		$.get(`/env/${id}/edit`, function (data) {
			$('#postCrudModal').html("Editando registro");
			$('#btnSave').val("editEnv");
			$('#ajax-crud-modal').modal('show');

			$('#key').val(data.body.key);
			$('#value').val(data.body.value.value);
		})
	});

	$("body").on("click", "#btnSave", function (){
		event.preventDefault();
		let key = document.getElementById('key').value;
		let value = document.getElementById('value').value;

		$.ajax({
			url: `/env/${key}`,
			type: "PATCH",
			cache: false,
			data: {key, value},
			success: function (response) {
				var ht = `<th id="${response.body.key}"><td>"${response.body.key}"</td><td>${response.body.value}</td></th>`;
			},
			error: function (error) {
				console.log(error);
			}
		});

	});

	$('body').on('click', '.delete-post', function () {
		var post_id = $(this).data("id");
		confirm("Are You sure want to delete !");

		$.ajax({
			type: "DELETE",
			url: "{{ url('ajax-posts')}}"+'/'+post_id,
			success: function (data) {
				$("#post_id_" + post_id).remove();
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});
	});
});
