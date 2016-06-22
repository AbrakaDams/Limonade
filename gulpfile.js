'use strict';

var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var minifyCSS = require('gulp-minify-css');


/*******************
 SASS
*******************/
// gulp.task('sass', function () {
//   return gulp.src('app/assets/scss/*.scss')
//     .pipe(sass().on('error', sass.logError))
//     .pipe(gulp.dest('dist/assets/css/'));
// });
//
// gulp.task('sass:watch', function () {
//   gulp.watch('app/assets/scss/*.scss', ['sass']);
// });

/*******************
AUTOPREFIXER
*******************/
// gulp.task('autoprefix', function () {
// 	return gulp.src('src/app.css')
// 		.pipe(autoprefixer({
// 			browsers: ['last 2 versions'],
// 			cascade: false
// 		}))
// 		.pipe(gulp.dest('dist'));
// });


gulp.task('styles', function () {
	 	gulp.src('src/scss/*.scss')
				.pipe(sass({
					errLogToConsole: true,
					//outputStyle: 'compressed',
					outputStyle: 'compact',
					// outputStyle: 'nested',
					// outputStyle: 'expanded',
					precision: 10
				}))
				.pipe(autoprefixer('last 2 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
				.pipe(minifyCSS({keepBreaks:false}))
				.pipe(gulp.dest('public/assets/css/'))
});

// Watch Task
gulp.task('default', ['styles'], function () { //, 'vendorsJs', 'scriptsJs', 'images', 'browser-sync'
   //gulp.watch('./assets/img/raw/**/*', ['images']);
   gulp.watch('src/scss/*.scss', ['styles']);
   //gulp.watch('./assets/js/**/*.js', ['scriptsJs', browserSync.reload]);

});
