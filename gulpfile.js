/**
 * Dependencies
 */

require('source-map-support/register');
require('@babel/register');

const task = require('@colinrotherham/core');
const config = require('./tasks/config.json');
const gulp = require('gulp');

/**
 * Child tasks
 */

gulp.task('clean', task.clean(config.clean));
gulp.task('copy', task.copy(config.copy, gulp));
gulp.task('css', task.css(config.css, gulp));
gulp.task('img:optimise', task.img.optimise(config.img.optimise, gulp));
gulp.task('img:fallbacks', task.img.fallbacks(config.img.fallbacks, gulp));
gulp.task('js:webpack', task.js.webpack(config.js.webpack, gulp));
gulp.task('lint:css', task.lint.css(config.lint.css, gulp));
gulp.task('lint:js', task.lint.js(config.lint.js, gulp));
gulp.task('serve', task.serve(config.serve));
gulp.task('watch', task.watch(config, gulp));

/**
 * Main tasks
 */

// Shared code compile task
gulp.task(
	'compile',
	gulp.parallel(
		gulp.series(
			'lint:js',
			'lint:css'
		),
		gulp.series(
			'js:webpack',
			'css'
		)
	)
);

// Shared build tasks
gulp.task(
	'build',
	gulp.series(
		gulp.parallel(
			'compile',
			'img:fallbacks'
		),
		'img:optimise'
	)
);

// Default tasks
gulp.task(
	'default',
	gulp.series(
		'clean',
		'copy',
		'build'
	)
);

// Development tasks
gulp.task(
	'dev',
	gulp.series(
		'default',
		gulp.parallel(
			'watch',
			'serve'
		)
	)
);
