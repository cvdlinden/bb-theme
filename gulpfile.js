'use strict';

var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps   = require('gulp-sourcemaps');
var rename       = require('gulp-rename');
var uglify       = require('gulp-uglify');
var jshint       = require('gulp-jshint');
var stylish      = require('jshint-stylish');
var wpPot        = require('gulp-wp-pot');
var sort         = require('gulp-sort');
var gcmq         = require('gulp-group-css-media-queries');
var del          = require('del');
var zip          = require('gulp-zip');
var browserSync  = require('browser-sync');
var runSequence  = require('run-sequence');
var wiredep 		 = require('wiredep').stream;
var useref       = require('gulp-useref');
var cleanCSS     = require('gulp-clean-css');
var flatten      = require('gulp-flatten');
var phpcs        = require('gulp-phpcs');

var js_files     = ['js/*.js', '!js/*.min.js', '!js/lib/**/*.js'];
var css_files     = ['*.css', '!*.min.css'];

var build_files = [
  '**',
  '!node_modules',
  '!node_modules/**',
  '!bower_components',
  '!bower_components/**',
  '!bower.json',
  '!libs',
  '!libs/**',
  '!dist',
  '!dist/**',
  '!sass',
  '!sass/**',
  '!package.json',
  '!codesniffer.*',
  '!gulpfile.js',
  '!.*'
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

gulp.task('compressCSS', function() {
  return gulp.src(css_files, {base: '.'})
    .pipe(gulp.dest('.'))
    .pipe(cleanCSS())
    .pipe(rename({extname: '.min.css'}))
    .pipe(gulp.dest('.'));
});

gulp.task('lint', function() {
  return gulp.src(js_files)
    .pipe(jshint())
    .pipe(jshint.reporter(stylish));
});

gulp.task('compressJS', function() {
  return gulp.src(js_files, {base: '.'})
    .pipe(gulp.dest('.'))
    .pipe(uglify({
      preserveComments: 'all'
    }))
    .pipe(rename({extname: '.min.js'}))
    .pipe(gulp.dest('.'));
});

gulp.task('codesniffer', function () {
    return gulp.src(['**/*.php', '!inc/widgets/**'])
        // Validate files using PHP Code Sniffer 
        .pipe(phpcs({
            //bin: 'src/vendor/bin/phpcs',
            standard: 'codesniffer.ruleset.xml',
            warningSeverity: 0
        }))
        // Log all problems that was found 
        .pipe(phpcs.reporter('file', {
          path: "codesniffer.report.txt"
        }));
});

gulp.task('makepot', function () {
  return gulp.src(['**/*.php'])
    .pipe(sort())
    .pipe(wpPot({
      domain: 'bb',
      destFile: 'bb-theme.pot',
      package: 'Bij Best',
      bugReport: 'https://example.com/bugreport/',
      team: 'Caspar <cvdlinden@gmail.com>'
    }))
    .pipe(gulp.dest('languages'))
    .pipe(browserSync.reload({stream:true}));
});

gulp.task('collectLibCSS', function() {
  return gulp.src(['libs/**/*.min.css'])
    .pipe(flatten())
    .pipe(gulp.dest('inc/css'));
});

gulp.task('collectLibFonts', function() {
  return gulp.src(['libs/**/fonts/**'])
    .pipe(flatten())
    .pipe(gulp.dest('inc/fonts'));
});

gulp.task('collectLibJS', function() {
  return gulp.src(['libs/**/*.min.js'])
    .pipe(flatten())
    .pipe(gulp.dest('js'));
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
  gulp.watch(js_files, ['compressJS']);
  gulp.watch(['**/*.php'], ['makepot']);
  gulp.watch('sass/**/*.scss', ['sass']);
  gulp.watch(css_files, ['compressCSS']);
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

gulp.task('default', ['sass', 'compressCSS', 'lint', 'compressJS', 'makepot', 'collectLibCSS', 'collectLibFonts', 'collectLibJS', 'watch', 'browserSync']);
