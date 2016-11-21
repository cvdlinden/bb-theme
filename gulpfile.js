'use strict';

var gulp         = require('gulp');
var plumber         = require('gulp-plumber');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var rename       = require('gulp-rename');
var uglify       = require('gulp-uglify');
var jshint       = require('gulp-jshint');
var stylish      = require('jshint-stylish');
var wpPot        = require('gulp-wp-pot');
var sort         = require('gulp-sort');
var gcmq         = require('gulp-group-css-media-queries');
var del          = require('del');
var zip          = require('gulp-zip');
var browserSync = require('browser-sync');
var runSequence  = require('run-sequence');
var wiredep 		= require('wiredep').stream;
var js_files     = ['js/*.js', '!js/*.min.js', '!js/lib/**/*.js'];

var build_files = [
  '**',
  '!node_modules',
  '!node_modules/**',
  '!bower_components',
  '!bower_components/**',
  '!dist',
  '!dist/**',
  '!sass',
  '!sass/**',
  '!.git',
  '!.git/**',
  '!package.json',
  '!.gitignore',
  '!gulpfile.js',
  '!.editorconfig',
  '!.jshintrc'
];

gulp.task('wiredep', function () {
  gulp.src('sass/style.scss')
    .pipe(wiredep({
      optional: 'configuration',
      goes: 'here'
    }))
    .pipe(gulp.dest('sass/'));
});

gulp.task('sass', function () {
  gulp.src(['sass/style.scss'])
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'expanded'}))
    .pipe(autoprefixer(['> 1%', 'last 2 versions', 'Firefox ESR']))
    .pipe(sourcemaps.write())
    .pipe(gcmq())
    .pipe(gulp.dest('.'))
    .pipe(browserSync.reload({stream:true}));
});

gulp.task('lint', function() {
  return gulp.src(js_files)
    .pipe(jshint())
    .pipe(jshint.reporter(stylish));
});

gulp.task('compress', function() {
  return gulp.src(js_files, {base: '.'})
    .pipe(gulp.dest('.'))
    .pipe(uglify())
    .pipe(rename({extname: '.min.js'}))
    .pipe(gulp.dest('.'));
});

gulp.task('makepot', function () {
  return gulp.src(['**/*.php'])
    .pipe(sort())
    .pipe(wpPot({
      domain: 'bb-theme',
      destFile: 'bb-theme.pot',
      package: 'Bij Best',
      bugReport: 'https://example.com/bugreport/',
      team: 'Caspar <cvdlinden@gmail.com>'
    }))
    .pipe(gulp.dest('languages'))
    .pipe(browserSync.reload({stream:true}));
});

gulp.task('browserSync', function() {
  browserSync({
    proxy: 'http://www.bijbest.dev/',
    port: 8080,
    open: true,
    notify: false
  });
});

gulp.task('watch', function () {
  gulp.watch(js_files, ['lint']);
  gulp.watch(js_files, ['compress']);
  gulp.watch(['**/*.php'], ['makepot']);
  gulp.watch('sass/**/*.scss', ['sass']);
});

gulp.task('build-clean', function() {
  del(['dist/**/*']);
});

gulp.task('build-copy', function() {
  return gulp.src(build_files)
    .pipe(gulp.dest('dist/bb-theme'));
});

gulp.task('build-zip', function() {
  return gulp.src('dist/**/*')
    .pipe(zip('bb-theme.zip'))
    .pipe(gulp.dest('dist'));
});

gulp.task('build-delete', function() {
  del(['dist/**/*', '!dist/bb-theme.zip']);
});

gulp.task('build', function(callback) {
  runSequence('build-clean', 'build-copy', 'build-zip', 'build-delete');
});

gulp.task('default', ['sass', 'lint', 'compress', 'makepot', 'watch', 'browserSync']);
