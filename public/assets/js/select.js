$(".select2-icon").each(function() {
	const $this = $(this);
	const placeholder = $(this).data("select-placeholder");
	$this.wrap('<div class="position-relative"></div>').select2({
		minimumResultsForSearch: Infinity,
		templateResult: iconRender,
		templateSelection: iconRender,
		placeholder: placeholder,
		dropdownParent: $this.parent(),
		escapeMarkup: function(m) { return m; }
	});
})

function iconRender(option) {
	if (!option.id) {
		return option.text;
	}

	const icon = $(option.element).data("icon");
	var $option = $('<span><span class="'+icon+'"></span> ' + option.text + '</span>');

	return $option;
}

$(".select2-ajax").each(function() {
	const $this = $(this);
	const placeholder = $(this).data("select-placeholder");
	const api = $(this).data("select-api");
	$this.select2({
		allowClear: true,
		dropdownParent: $this.parent(),
		ajax: {
			url: api,
			data: function(params) {
					return {search : params.term}
			},
			dataType: 'json',
			delay: 250,
			processResults: function (data) {
					return {
							results: data
					};
			},
			cache: true
		},
		placeholder: placeholder,
		minimumInputLength: 1,
		escapeMarkup: function (markup) {
				return markup;
		},
		templateResult: renderSelectionAvatar,
		templateSelection: renderAvatar
	});
});

function renderAvatar(option) {
	if (!option.id) {
			return option.text;
	}

	if ($(option.element).data("avatar")) {
		var $icon = "<div class='d-flex justify-content-start align-items-center'><div class='avatar avatar-sm me-1'><img src='"+ $(option.element).data('avatar') +"' class='rounded-circle' alt='Avatar' /></div>" + option.text + "</div>";
	}else {
		var $icon = "<div class='d-flex justify-content-start align-items-center'><div class='avatar avatar-sm me-1'><img src='"+ option.avatar +"' class='rounded-circle' alt='Avatar' /></div>" + option.text + "</div>";
	}

	return $icon;
}

function renderSelectionAvatar(option) {
	if (!option.id) {
			return option.text;
	}

	var $icon = "<div class='d-flex justify-content-start align-items-center'><div class='avatar avatar-sm me-1'><img src='"+ option.avatar +"' class='rounded-circle' alt='Avatar' /></div><div><p class='font-11 mb-0'>" + option.text + "</p><small class='badge bg-danger'>"+ option.purok+"</small>" + "</div></div>";

	return $icon;
}