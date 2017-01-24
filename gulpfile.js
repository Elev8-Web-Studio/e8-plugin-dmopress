// Load plugins
var pkg = require('./package.json'),
  gulp = require('gulp'),
  cache = require('gulp-cache'),
  changed = require('gulp-changed'),
  cleancss = require('gulp-clean-css'),
  concat = require('gulp-concat'),
  del = require('del'),
  notify = require('gulp-notify'),
  rename = require('gulp-rename'),
  sass = require('gulp-sass'),
  sftp = require('gulp-sftp'),
  sourcemaps = require('gulp-sourcemaps'),
  uglify = require('gulp-uglify');

// Main Task
gulp.task('default', function() {
  //Source files
  gulp.watch(['package.json', 'src/**/*.html', 'src/**/*.php', 'src/**/style.css', 'src/**/*.png', 'src/**/*.md', 'src/**/*.txt'], ['source']);

  //Stylesheets
  gulp.watch(['package.json', 'src/**/*.scss'], ['stylesheets']);

  //Javascript
  gulp.watch(['package.json', 'src/**/*.js'], ['js']);

});

gulp.task('source', function () {
  gulp.src(['src/**/*.html', 'src/**/*.php', 'src/**/style.css', 'src/**/*.png', 'src/**/*.md', 'src/**/*.txt'])
    .pipe(changed('./dist/'))
    .pipe(gulp.dest('./dist/'))
    .pipe(sftp({
      host: pkg.staging.host,
      remotePath: pkg.staging.remote_path,
      auth: 'staging'
    }));
});

gulp.task('stylesheets', function() {
  var filesToProcess = pkg.pluginDependencies.stylesheets;
  filesToProcess.push('./src/**/app.scss');
  gulp.src(filesToProcess)
    .pipe(sass({ style: 'compressed' }))
    .pipe(concat('app.css'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(cleancss({keepBreaks: false}))
    .pipe(gulp.dest('./dist/css'))
    .pipe(sftp({
      host: pkg.staging.host,
      remotePath: pkg.staging.remote_path + '/css',
      auth: 'staging'
    }));
});

gulp.task('js', function() {
  var filesToProcess = pkg.pluginDependencies.javascript;
  filesToProcess.push('./src/**/*.js');
  gulp.src(filesToProcess)
    //.pipe(sourcemaps.init())
    .pipe(concat('app.js'))
    //.pipe(sourcemaps.write())
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('./dist/js'))
    .pipe(sftp({
      host: pkg.staging.host,
      remotePath: pkg.staging.remote_path + '/js',
      auth: 'staging'
    }));
});
