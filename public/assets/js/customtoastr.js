(function(p) {
	"use strict";

	function Toast() {}

	function extend(obj, ext) {
    Object.keys(ext).forEach(function (key) {
      obj[key] = ext[key];
    });
    return obj;
  }

	Toast.prototype.notify = function (msg, ttype, opt) {
		var ttype = ttype ? ttype : 'info',
				msi = '',
				ticon = ttype === 'info' ? 'bi bi-exclamation-circle-fill' : ttype === 'success' ? 'bi bi-check-circle-fill' : ttype === 'error' ? 'bi bi-x-circle-fill' : ttype === 'warning' ? 'bi bi-question-circle-fill' : '',
				def = {
			position: 'bottom-right',
			ui: '',
			icon: 'auto',
			clear: false
		},
				attr = opt ? extend(def, opt) : def;
		attr.position = attr.position ? 'toast-' + attr.position : 'toast-bottom-right';
		attr.icon = attr.icon === 'auto' ? ticon : attr.icon ? attr.icon : '';
		attr.ui = attr.ui ? ' ' + attr.ui : '';
		msi = attr.icon !== '' ? '<span class="toastr-icon"><em class="icon ' + attr.icon + '"></em></span>' : '', msg = msg !== '' ? msi + '<div class="toastr-text">' + msg + '</div>' : '';

		if (msg !== "") {
			if (attr.clear === true) {
				toastr.clear();
			}

			var option = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": false,
				"progressBar": false,
				"positionClass": attr.position + attr.ui,
				"closeHtml": '<span class="btn-trigger">Close</span>',
				"preventDuplicates": true,
				"showDuration": "1500",
				"hideDuration": "1500",
				"timeOut": "2000",
				"toastClass": "toastr",
				"extendedTimeOut": "3000"
			};
			toastr.options = extend(option, attr);
			toastr[ttype](msg);
		}
	};
	window.Toast = new Toast();
})(window.jQuery);