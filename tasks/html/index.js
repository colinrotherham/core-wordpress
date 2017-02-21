/**
 * HTML
 */

'use strict';

module.exports = function (paths, gulp, plugins) {

	// Child modules
	var assemble = require('assemble');
	var app = assemble();

	// Add helpers
	app.helper('outputFileContent', require('./helpers/output-file-content'));

	// Return module
	return function () {

		// Default page options
		var options = {
			name: 'default',
			locale: 'en-GB',

			// Appended to includes to bust cache
			timestamp: Date.now()
		};

		// Find layouts and partials
		app.layouts(`${paths.src}/templates/layouts/*.hbs`);
		app.partials(`${paths.src}/templates/partials/*.hbs`);

		// Add classic helpers
		app.helpers(require('handlebars-helpers')(), app.helpers);

		// Build templates
		return app.src(`${paths.src}/templates/*.hbs`)
			.pipe(app.renderFile(options))
			.pipe(plugins.rename({
				extname: '.html'
			}))
			.pipe(app.dest(paths.build))
			.pipe(plugins.browserSync.stream());
	};
};