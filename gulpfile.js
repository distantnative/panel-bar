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
      'assets/scss/components/iframe.scss',
      'assets/scss/components/rtl.scss',
      'assets/scss/modules/drop.scss',
      'assets/scss/patterns/box.scss',
      'assets/scss/patterns/link.scss',
      'assets/scss/patterns/dropdown.scss',
    ], {base: 'assets/scss'})
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(cssmin())
    .pipe(gulp.dest('assets/css'))
    .pipe(browserSync.stream());
});


// =============================================
//  JS
// =============================================

gulp.task('js-main', function() {
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
    //.pipe(uglify())
    .pipe(gulp.dest('assets/js'))
    .pipe(browserSync.stream());
});


// =============================================
//  Watch
// =============================================

gulp.task('watch', function() {
  browserSync.init({
    proxy:    'kirby:8888',
    notify:   false
  });

  gulp.watch('assets/scss/**/*.scss', ['css']);
  gulp.watch('assets/js/src/**/*.js',    ['js-main', 'js-components']).on('change', browserSync.reload);
  gulp.watch([
    'core/**/*.php',
    'elements/**/*.php',
    'snippets/**/*.php',
  ]).on('change', browserSync.reload);
});
