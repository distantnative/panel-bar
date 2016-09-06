var gulp          = require('gulp');
var concat        = require('gulp-concat');
var autoprefixer  = require('gulp-autoprefixer');
var sass          = require('gulp-sass');
var cssmin        = require('gulp-cssmin');
var rename        = require('gulp-rename');
var uglify        = require('gulp-uglify');
var browserSync   = require('browser-sync').create();


// =============================================
//  CSS
// =============================================

gulp.task('css', function() {
  return gulp.src([
      'assets/scss/panelbar.scss',
      'assets/scss/components/*.scss',
      'assets/scss/modules/*.scss',
      'assets/scss/patterns/*.scss',
    ], {base: 'assets/scss'})
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(cssmin())
    .pipe(gulp.dest('assets/css'))
    .pipe(browserSync.stream());
});

gulp.task('css-elements', function() {
  return gulp.src([
      'elements/**/assets/css/*.scss',
    ])
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(cssmin())
    .pipe(gulp.dest(function(file) {
      return file.base;
    }))
    .pipe(browserSync.stream());
});


// =============================================
//  JS
// =============================================

gulp.task('js', function() {
  return gulp.src([
      'assets/js/src/util/classes.js',
      'assets/js/src/panelbar.js'
    ])
    .pipe(concat('panelbar.js'))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'))
    .pipe(browserSync.stream());
});

gulp.task('js-components', function() {
  return gulp.src('assets/js/src/components/*.js', {base: 'assets/js/src'})
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'))
    .pipe(browserSync.stream());
});


// =============================================
//  Watch
// =============================================

gulp.task('watch', ['css', 'css-elements', 'js', 'js-components'], function() {
  gulp.watch('assets/scss/**/*.scss', ['css']);
  gulp.watch('elements/**/assets/css/*.scss', ['css-elements']);
  gulp.watch('assets/js/src/panelbar.js',    ['js']);
  gulp.watch('assets/js/src/components/*.js',    ['js-components']);
});
