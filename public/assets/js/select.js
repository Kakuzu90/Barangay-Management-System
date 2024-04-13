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