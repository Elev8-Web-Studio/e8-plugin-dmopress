// Load plugins
var pkg = require('./package.json'),
    secrets = require('./secrets.json'),
    gulp = require('gulp'),
    cache = require('gulp-cache'),
    changed = require('gulp-changed'),
    cleancss = require('gulp-clean-css'),
    concat = require('gulp-concat'),
    del = require('del'),
    ftp = require('vinyl-ftp'),
    gutil = require('gulp-util'),
    notify = require('gulp-notify'),
    rename = require('gulp-rename'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    uglify = require('gulp-uglify');

//Create FTP connection
var conn = ftp.create({
    host: secrets.ftphost,
    user: secrets.ftpusername,
    password: secrets.ftppassword,
    parallel: 10,
    log: gutil.log
});

// Main Task
gulp.task('default', function() {
    gulp.watch(['package.json', 'src/**/*.html', 'src/**/*.php', 'src/**/style.css', 'src/**/*.png', 'src/**/*.md', 'src/**/*.txt', 'src/**/*.json'], ['source']);
    gulp.watch(['package.json', 'src/scss/admin.scss'], ['stylesheets-admin']);
    gulp.watch(['package.json', 'src/scss/public.scss', 'src/shortcodes/**/*.scss'], ['stylesheets-public']);
    gulp.watch(['package.json', 'src/**/*.js'], ['js']);
});


gulp.task('source', function() {
    gulp.src(['src/**/*.html', 'src/**/*.php', 'src/**/style.css', 'src/**/*.png', 'src/**/*.md', 'src/**/*.txt', 'src/**/*.json'])
        .pipe(changed('./dist/'))
        .pipe(gulp.dest('./dist/'))
        .pipe(conn.dest(secrets.ftppath));
});

gulp.task('stylesheets-admin', function() {
    var filesToProcess = pkg.themeDependencies.stylesheets;
    filesToProcess.push('./src/scss/admin.scss');
    gulp.src(filesToProcess)
        .pipe(sourcemaps.init())
        .pipe(sass({ style: 'compressed' }).on('error', sass.logError))
        .pipe(concat('tourismpress-admin.css'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(cleancss({ keepBreaks: false }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./dist/css'))
        .pipe(conn.dest(secrets.ftppath + '/css'));
});

gulp.task('stylesheets-public', function() {
    var filesToProcess = pkg.themeDependencies.stylesheets;
    filesToProcess.push('./src/scss/public.scss');
    gulp.src(filesToProcess)
        .pipe(sourcemaps.init())
        .pipe(sass({ style: 'compressed' }).on('error', sass.logError))
        .pipe(concat('tourismpress.css'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(cleancss({ keepBreaks: false }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./dist/css'))
        .pipe(conn.dest(secrets.ftppath + '/css'));
});

gulp.task('js', function() {
    var filesToProcess = pkg.themeDependencies.javascript;
    filesToProcess.push('./src/**/*.js');
    gulp.src(filesToProcess)
        .pipe(sourcemaps.init())
        .pipe(concat('app.js'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./dist/js'))
        .pipe(conn.dest(secrets.ftppath + '/js'));
});