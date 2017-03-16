/**
 * Watch
 */

'use strict';

module.exports = function (paths, gulp, plugins) {

	// Return module
	return function () {

		// Watch for static asset changes
		plugins.watch(`${paths.src}/**`, plugins.batch(function (events, done) {
			return plugins.sequence('copy', done);
		}));

		// Watch for CSS changes
		plugins.watch(`${paths.srcAssets}/**/*.scss`, plugins.batch(function (events, done) {
			return plugins.sequence('css-lint', 'css', done);
		}));

		// Watch for critical CSS changes
		plugins.watch(`${paths.buildAssets}/css/starter.min.css`, plugins.browserSync.reload);

		// Watch for JS changes
		plugins.watch(`${paths.srcAssets}/**/*.js`, plugins.batch(function (events, done) {
			return plugins.sequence('js-lint', 'js', done);
		}));

		// Watch for SVG changes
		plugins.watch(`${paths.srcAssets}/img/**/*.svg`, plugins.batch(function (events, done) {
			return plugins.sequence('img-fallbacks', 'img', done);
		}));
	};
};
