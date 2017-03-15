/**
 * Clean
 */

'use strict';

module.exports = function (paths, gulp, plugins) {

	// Return module
	return function (callback) {

		// Paths to delete
		var pathsDel = [

			// Empty build dir
			`${paths.build}/*`,

			// Except for Composer dependencies etc
			`!${paths.build}/content`,
			`!${paths.build}/vendor`,
			`!${paths.build}/wordpress`,

			// Delete the theme though
			`${paths.build}/content/themes/*`
		];

		return require('del')(pathsDel, callback);
	};
};
