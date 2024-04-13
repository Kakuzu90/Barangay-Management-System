$(".flatpickr-human-friendly").each(function() {
	flatpickr(this, {
			altInput: true,
			altFormat: "F j, Y",
			dateFormat: "Y-m-d",
	});
});