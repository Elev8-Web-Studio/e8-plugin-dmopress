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
    gulp.watch(['package.json', 'src/js/admin.js'], ['js-admin']);
    gulp.watch(['package.json', 'src/js/public.js'], ['js-public']);
});

gulp.task('remote', function() {
    gulp.watch(['package.json', 'src/**/*.html', 'src/**/*.php', 'src/**/style.css', 'src/**/*.png', 'src/**/*.md', 'src/**/*.txt', 'src/**/*.json', 'src/LICENSE'], ['source-remote']);
    gulp.watch(['package.json', 'src/**/*.scss'], ['stylesheets-remote']);
    gulp.watch(['package.json', 'src/**/*.js'], ['js-remote']);
});

gulp.task('source', function() {
    gulp.src(['src/**/*.html', 'src/**/*.php', 'src/**/style.css', 'src/**/*.png', 'src/**/*.md', 'src/**/*.txt', 'src/**/*.json', 'src/fonts/**'])
        .pipe(changed(secrets.localPath))
        .pipe(gulp.dest(secrets.localPath));
});

gulp.task('source-remote', function() {
    gulp.src(['src/**/*.html', 'src/**/*.php', 'src/**/style.css', 'src/**/*.png', 'src/**/*.md', 'src/**/*.txt', 'src/**/*.json', 'src/fonts/**'])
        .pipe(changed(secrets.localPath))
        .pipe(conn.dest(secrets.ftppath));
});

gulp.task('stylesheets-admin', function() {
    var filesToProcess = pkg.pluginDependencies.stylesheets;
    filesToProcess.push('./src/scss/admin.scss');
    gulp.src(filesToProcess)
        .pipe(sourcemaps.init())
        .pipe(sass({ style: 'compressed' }).on('error', sass.logError))
        .pipe(concat('dmopress-admin.css'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(cleancss({ keepBreaks: false }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(secrets.localPath + '/css'));
});

gulp.task('stylesheets-public', function() {
    var filesToProcess = [];
    filesToProcess.push('./src/scss/public.scss');
    gulp.src(filesToProcess)
        .pipe(sourcemaps.init())
        .pipe(sass({ style: 'compressed' }).on('error', sass.logError))
        .pipe(concat('dmopress.css'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(cleancss({ keepBreaks: false }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(secrets.localPath + '/css'));
});

gulp.task('stylesheets-remote', function() {
    var filesToProcess = pkg.pluginDependencies.stylesheets;
    filesToProcess.push('./src/scss/admin.scss');
    gulp.src(filesToProcess)
        .pipe(sourcemaps.init())
        .pipe(sass({ style: 'compressed' }).on('error', sass.logError))
        .pipe(concat('dmopress-admin.css'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(cleancss({ keepBreaks: false }))
        .pipe(sourcemaps.write())
        .pipe(conn.dest(secrets.ftppath + '/css'));

    var filesToProcess = [];
    filesToProcess.push('./src/scss/public.scss');
    gulp.src(filesToProcess)
        .pipe(sourcemaps.init())
        .pipe(sass({ style: 'compressed' }).on('error', sass.logError))
        .pipe(concat('dmopress.css'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(cleancss({ keepBreaks: false }))
        .pipe(sourcemaps.write())
        .pipe(conn.dest(secrets.ftppath + '/css'));
});


gulp.task('js-admin', function() {
    var filesToProcess = pkg.pluginDependencies.javascript;
    filesToProcess.push('./src/js/jquery.select2.js');
    filesToProcess.push('./src/js/jquery.validate.js');
    filesToProcess.push('./src/js/admin.js');
    gulp.src(filesToProcess)
        .pipe(sourcemaps.init())
        .pipe(concat('dmopress-admin.js'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(secrets.localPath + '/js'));
});

gulp.task('js-public', function() {
    gulp.src(['./src/js/public.js'])
        .pipe(sourcemaps.init())
        .pipe(concat('dmopress-public.js'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(secrets.localPath + '/js'));
});

gulp.task('js-remote', function() {
    var filesToProcess = pkg.pluginDependencies.javascript;
    filesToProcess.push('./src/js/jquery.select2.js');
    filesToProcess.push('./src/js/jquery.validate.js');
    filesToProcess.push('./src/js/admin.js');
    gulp.src(filesToProcess)
        .pipe(sourcemaps.init())
        .pipe(concat('dmopress-admin.js'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(conn.dest(secrets.ftppath + '/js'));

    gulp.src(['./src/js/public.js'])
        .pipe(sourcemaps.init())
        .pipe(concat('dmopress-public.js'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(conn.dest(secrets.ftppath + '/js'));
});

gulp.task('build', function() {

    gulp.src(['src/**/*.html', 'src/**/*.php', 'src/**/style.css', 'src/**/*.png', 'src/**/*.md', 'src/**/*.txt', 'src/**/*.json', 'src/LICENSE'])
        .pipe(gulp.dest('build/dmopress'));

    gulp.src(['src/fonts/**'])
        .pipe(gulp.dest('build/dmopress/fonts'));

    var adminStylesheets = pkg.pluginDependencies.stylesheets;
    adminStylesheets.push('./src/scss/admin.scss');
    gulp.src(adminStylesheets)
        .pipe(sass({ style: 'compressed' }).on('error', sass.logError))
        .pipe(concat('dmopress-admin.css'))
        .pipe(gulp.dest('build/dmopress/css'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(cleancss({ keepBreaks: false }))
        .pipe(gulp.dest('build/dmopress/css'));

    var publicStylesheets = [];
    publicStylesheets.push('./src/scss/public.scss');
    gulp.src(publicStylesheets)
        .pipe(sass({ style: 'compressed' }).on('error', sass.logError))
        .pipe(concat('dmopress.css'))
        .pipe(gulp.dest('build/dmopress/css'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(cleancss({ keepBreaks: false }))
        .pipe(gulp.dest('build/dmopress/css'));

    var jsAdminFiles = pkg.pluginDependencies.javascript;
    jsAdminFiles.push('./src/js/jquery.select2.js');
    jsAdminFiles.push('./src/js/jquery.validate.js');
    jsAdminFiles.push('./src/js/admin.js');
    gulp.src(jsAdminFiles)
        .pipe(concat('dmopress-admin.js'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest('build/dmopress/js'));

    gulp.src(['./src/js/public.js'])
        .pipe(concat('dmopress-public.js'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest('build/dmopress/js'));

});