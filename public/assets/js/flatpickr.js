$(".flatpickr-human-friendly").each(function() {
	flatpickr(this, {
			altInput: true,
			altFormat: "F j, Y",
			dateFormat: "Y-m-d",
	});
});

$(".timepicker").each(function() {
	console.log("Element: ", this)
	flatpickr(this, {
		enableTime: true,
		noCalendar: true,
		dateFormat: "G:i K",
	});
});