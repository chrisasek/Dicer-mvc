(function ($) {
	'use_strict';
	$messagePoint = $('#mp_modal');
	// Messages module
	var Messaging = {
		showMessage: function ($title, $msg, $function) {
			$messagePoint.find('#mp_modal').text($title);
			$messagePoint.find('.modal-body').text($msg);
			return $messagePoint.modal('show').on('hidden.bs.modal', $function).promise();
		}
	}

	function reload2home(time = 5000) {
		setTimeout(function () { // wait for 5 secs(2)
			location.reload(); // then reload the page.(3)
		}, time);
	}

	function processHttpRequests(url, data, re) {
		if (url && data) {
			return $.ajax({
				url: url,
				data: data,
				cache: false,
				type: 'post',
				dataType: re
			}).promise();
		}
	}

	$('.toggle-password').on('click', function (e) {
		e.preventDefault();

		let input = $("input#" + $(this).attr('data-target'));
		if (input.attr('type') == 'password') {
			input.attr('type', 'text')
		} else {
			input.attr('type', 'password')
		}
	});

	$('#toggler').on('click', function (e) {
		e.preventDefault();
		if ($('#' + $(this).data('toggle')).is(':visible')) {
			$('#' + $(this).data('toggle')).removeClass('d-block').addClass('d-none');
		} else {
			$('#' + $(this).data('toggle')).removeClass('d-none').addClass('d-block');
		}
	});

	$(".world").on("change click", function (e) {
		e.preventDefault();

		type = $(this).data("type");
		append = $(this).data("world-append");
		append_txt = $(this).data("world-append-text")
			? "<option value=''>" + $(this).data("world-append-text") + "</option>"
			: null;
		target = $(this).data("world-target");
		value = $(this).val();
		if (!value) {
		} else {
			wdata =
				"value=" +
				parseInt(value) +
				"&type=" +
				type +
				"&append=" +
				append +
				"&rq=world&rtype=html";
			processHttpRequests("controllers/get.php", wdata, "json").then(function (
				result
			) {
				if (typeof result == "object" && result.success) {
					// 	console.log(result);
					if (result.success.type == "country") {
						if (result.success.append) {
							$(target).html(append_txt + result.success.data);
						} else {
							$(target).html(result.success.data);
						}
					}
					if (result.success.type == "state") {
						$(target).html(result.success.data);
					}
				} else {
					$(".lga").html('<option value="">Select LGA</option>');
				}
			});
		}
	});

	// $('.toggle-password').on('click', function (e) {
	// 	e.preventDefault();

	// 	let input = $($(this).data('target'));

	// 	console.log(input);
	// 	console.log(input.type);

	// 	// if ($('#' + $(this).data('toggle')).is(':visible')) {
	// 	// 	$('#' + $(this).data('toggle')).removeClass('d-block').addClass('d-none');
	// 	// } else {
	// 	// 	$('#' + $(this).data('toggle')).removeClass('d-none').addClass('d-block');
	// 	// }
	// });

})(jQuery);