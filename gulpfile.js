var themeName = 'tourismpress-material-theme';
var pluginName = 'tourismpress-core';

// Load plugins
var pkg = require('./package.json'),
  gulp = require('gulp'),
  cache = require('gulp-cache'),
  changed = require('gulp-changed'),
  concat = require('gulp-concat'),
  del = require('del'),
  minifycss = require('gulp-minify-css'),
  notify = require('gulp-notify'),
  rename = require('gulp-rename'),
  sass = require('gulp-sass'),
  sftp = require('gulp-sftp'),
  sourcemaps = require('gulp-sourcemaps'),
  uglify = require('gulp-uglify');

// Main Tasks
gulp.task('default', ['watch-src']);

// Watch
gulp.task('watch-src', function() {
  //Source files
  gulp.watch(['package.json', 'src/themes/**/*.html', 'src/themes/**/*.php'], ['source-theme']);
  gulp.watch(['package.json', 'src/plugins/**/*.html', 'src/plugins/**/*.php'], ['source-plugin']);

  //Stylesheets
  gulp.watch(['package.json', 'src/themes/**/*.scss'], ['stylesheets-theme']);
  gulp.watch(['package.json', 'src/plugins/**/*.scss'], ['stylesheets-plugin']);

  //Javascript
  gulp.watch(['package.json', 'src/themes/**/*.js'], ['js-theme']);
  gulp.watch(['package.json', 'src/plugins/**/*.js'], ['js-plugin']);

  //Images
  gulp.watch('src/themes/**/img/*', ['img-theme']);
  gulp.watch('src/plugins/**/img/*', ['img-plugin']);

  //Depdendencies
  //gulp.watch('package.json', ['stylesheets-theme-vendor', 'js-theme-vendor','stylesheets-plugin-vendor', 'js-plugin-vendor'])
});

gulp.task('source-theme', function () {
  gulp.src(['./src/themes/**/*.html','./src/themes/**/*.php'])
    .pipe(changed('./dist/themes/'))
    .pipe(gulp.dest('./dist/themes/'))
    .pipe(sftp({
      host: pkg.staging.host,
      remotePath: pkg.staging.remote_path + 'themes/',
      auth: 'staging',
      buffer: false
    }));
});

gulp.task('source-plugin', function () {
  gulp.src(['./src/plugins/**/*.html','./src/plugins/**/*.php'])
    .pipe(changed('./dist/plugins/'))
    .pipe(gulp.dest('./dist/plugins/'))
    .pipe(sftp({
      host: pkg.staging.host,
      remotePath: pkg.staging.remote_path + 'plugins/',
      auth: 'staging',
      buffer: false
    }));
});

gulp.task('stylesheets-theme', function() {
  var filesToProcess = pkg.themeDependencies.stylesheets;
  filesToProcess.push('./src/themes/**/app.scss');
  gulp.src(filesToProcess)
    .pipe(sass({ style: 'compressed' }))
    .pipe(concat('app.css'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(minifycss())
    .pipe(gulp.dest('./dist/themes/' + themeName + '/css'))
    .pipe(sftp({
      host: pkg.staging.host,
      remotePath: pkg.staging.remote_path + 'themes/' + themeName + '/css',
      auth: 'staging',
      buffer: false
    }));
});

gulp.task('stylesheets-plugin', function() {
  var filesToProcess = pkg.pluginDependencies.stylesheets;
  filesToProcess.push('./src/plugins/**/' + pluginName + '.scss');
  gulp.src(filesToProcess)
    .pipe(sass({ style: 'compressed' }))
    .pipe(concat(pluginName + '.css'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(minifycss())
    .pipe(gulp.dest('./dist/plugins/' + pluginName + '/css'))
    .pipe(sftp({
      host: pkg.staging.host,
      remotePath: pkg.staging.remote_path + 'plugins/' + pluginName + '/css',
      auth: 'staging',
      buffer: false
    }));
});

gulp.task('js-theme', function() {
  var filesToProcess = pkg.themeDependencies.javascript;
  filesToProcess.push('./src/themes/**/*.js');
  gulp.src(filesToProcess)
    //.pipe(sourcemaps.init())
    .pipe(concat('app.js'))
    //.pipe(sourcemaps.write())
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('./dist/themes/' + themeName + '/js'))
    .pipe(sftp({
      host: pkg.staging.host,
      remotePath: pkg.staging.remote_path + 'themes/' + themeName + '/js',
      auth: 'staging',
      buffer: false
    }));
});

gulp.task('js-plugin', function() {
  var filesToProcess = pkg.pluginDependencies.javascript;
  filesToProcess.push('./src/plugins/**/tourismpress-admin.js');
  gulp.src(filesToProcess)
    //.pipe(sourcemaps.init())
    .pipe(concat(pluginName + '.js'))
    //.pipe(sourcemaps.write())
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('./dist/plugins/' + pluginName + '/js'))
    .pipe(sftp({
      host: pkg.staging.host,
      remotePath: pkg.staging.remote_path + 'plugins/' + pluginName + '/js',
      auth: 'staging',
      buffer: false
    }));
});

gulp.task('img-theme', function () {
  gulp.src(['./src/themes/**/*.png','./src/themes/**/*.jpg'])
    .pipe(changed('./dist/themes/'))
    .pipe(gulp.dest('./dist/themes/'))
    .pipe(sftp({
      host: pkg.staging.host,
      remotePath: pkg.staging.remote_path + 'themes/',
      auth: 'staging',
      buffer: false
    }));
});

gulp.task('img-plugin', function () {
  gulp.src(['./src/plugins/**/*.png','./src/plugins/**/*.jpg'])
    .pipe(changed('./dist/themes/'))
    .pipe(gulp.dest('./dist/plugins/'))
    .pipe(sftp({
      host: pkg.staging.host,
      remotePath: pkg.staging.remote_path + 'plugins/',
      auth: 'staging',
      buffer: false
    }));
});

