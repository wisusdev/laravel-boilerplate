$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});

	$('body').on('click', '#editEnv', function () {
		let id = $(this).data('id');

		$.get(`/env/${id}/edit`, function (data) {
			$('#envTitleModal').html("Editando registro");
			$('#btnSave').val("editEnv");
			$('#envModal').modal('show');

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
				console.log(response.body);

				let env = `<tr id="${response.body.key}">
					<td>${response.body.key}</td>
					<th>${response.body.value}</th>
					<td><a href="javascript:void(0)" id="editEnv" data-id="${response.body.key}" class="btn btn-primary btn-sm">Editar</a></td>
				</tr>`;
				
				$(`#${response.body.key}`).replaceWith(env);

				$('#userForm').trigger("reset");
				$('#envModal').modal('hide');
				$('#btn-save').html('Save Changes');

			},
			error: function (error) {
				console.log(error);
			}
		});

	});

	$('body').on('click', '#deleteEnv', function () {
		let id = $(this).data('id');
		confirm("Are You sure want to delete !");

		$.ajax({
			type: "DELETE",
			url: `/env/${id}`,
			success: function (response) {
				$("#" + id).remove();
			},
			error: function (response) {
				console.log('Error:', response);
			}
		});
	});
});
