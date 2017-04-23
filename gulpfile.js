var gulp          = require('gulp');
var concat        = require('gulp-concat');
var autoprefixer  = require('gulp-autoprefixer');
var sass          = require('gulp-sass');
var cssmin        = require('gulp-cssmin');
var rename        = require('gulp-rename');
var uglify        = require('gulp-uglify');


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
    .pipe(gulp.dest('assets/css'));
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
    }));
});

gulp.task('css-widget', function() {
  return gulp.src([
      'widget/assets/scss/widget.scss',
      'widget/assets/scss/view.scss',
    ])
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(cssmin())
    .pipe(gulp.dest('widget/assets/css'));
});


// =============================================
//  JS
// =============================================

gulp.task('js', function() {
  return gulp.src([
      'assets/js/src/util/classes.js',
      'assets/js/src/panelbar.js',
      'assets/js/src/core/*.js'
    ])
    .pipe(concat('panelbar.js'))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'));
});

gulp.task('js-components', function() {
  return gulp.src('assets/js/src/components/*.js', {base: 'assets/js/src'})
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'));
});

gulp.task('js-elements', function() {
  return gulp.src([
      'elements/**/assets/js/*.js',
      '!elements/**/assets/js/*.min.js',
    ])
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(function(file) {
      return file.base;
    }));
});

gulp.task('js-widget', function() {
  return gulp.src([
      'widget/assets/js/*.js',
      '!widget/assets/js/*.min.js',
    ])
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('widget/assets/js'));
});


// =============================================
//  Watch
// =============================================

gulp.task('watch', ['css', 'css-elements', 'css-widget', 'js', 'js-components', 'js-elements', 'js-widget'], function() {
  gulp.watch('assets/scss/**/*.scss',           ['css']);
  gulp.watch('elements/**/assets/css/*.scss',   ['css-elements']);
  gulp.watch('widget/assets/scss/*.scss',       ['css-widget']);
  gulp.watch(['assets/js/src/panelbar.js', 'assets/js/src/core/*.js'],       ['js']);
  gulp.watch('assets/js/src/components/*.js',   ['js-components']);
  gulp.watch('elements/**/assets/js/*.js',      ['js-elements']);
  gulp.watch('widget/assets/js/*.js',           ['js-widget']);
});
