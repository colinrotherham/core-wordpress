import * as task from '@colinrotherham/core';
import config from './tasks/config.json';
import gulp from 'gulp';
import webpackConfig from './webpack.config.mjs';

// Add webpack config
config.js.webpack = { ...config.js.webpack, options: webpackConfig };

/**
 * Child tasks
 */
gulp.task('clean', task.clean(config.clean));
gulp.task('copy', task.copy(config.copy, gulp));
gulp.task('css', task.css(config.css, gulp));
gulp.task('img:optimise', task.img.optimise(config.img.optimise, gulp));
gulp.task('js:webpack', task.js.webpack(config.js.webpack, gulp));
gulp.task('serve', task.serve(config.serve));
gulp.task('watch', task.watch(config, gulp));

/**
 * Main tasks
 */

// Shared code compile task
gulp.task(
  'compile',
  gulp.series(
    'js:webpack',
    'css',
  ),
);

// Shared build tasks
gulp.task(
  'build',
  gulp.series(
    'compile',
    'img:optimise',
  ),
);

// Default tasks
gulp.task(
  'default',
  gulp.series(
    'clean',
    'copy',
    'build',
  ),
);

// Development tasks
gulp.task(
  'dev',
  gulp.series(
    'default',
    gulp.parallel(
      'watch',
      'serve',
    ),
  ),
);
