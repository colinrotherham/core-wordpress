/**
 * Serve
 */

'use strict';

module.exports = function (paths, gulp, plugins) {

	var options = {
		notify: false,
		proxy: 'local.domain.com',
		reloadDelay: 400,
		reloadThrottle: 100
	};

	// Return module
	return function () {
		return plugins.browserSync(options);
	};
};
