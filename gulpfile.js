var gulp = require('gulp');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var sequence = require('gulp-sequence');
var sass = require('gulp-sass');
var del = require('del');
var pkg = require('./package.json');

gulp.task('framework_scripts', function () {
    return gulp.src([
            'bower_components/jquery/dist/jquery.min.js',
            'bower_components/bootstrap/dist/js/bootstrap.min.js',
            'bower_components/angular/angular.min.js',
            'bower_components/angular-route/angular-route.min.js',
            'bower_components/angular-cookies/angular-cookies.min.js',
            'bower_components/checklist-model/checklist-model.js',
            'bower_components/angular-rangeslider/angular.rangeSlider.js',
            'bower_components/angularjs-datepicker/dist/angular-datepicker.min.js',
            'bower_components/moment/min/moment.min.js',
            'bower_components/sweetalert/dist/sweetalert.min.js',
            'bower_components/notifyjs/dist/notify.js',
            'node_modules/chart.js/dist/Chart.min.js'
        ])
        .pipe(concat('framework-'+pkg.version.replace(/\./g,"_")+'.min.js'))
        .pipe(gulp.dest('assets/js'));
});

gulp.task('framework_styles', function () {
    return gulp.src([
            'bower_components/bootstrap/dist/css/bootstrap.min.css',
            'bower_components/font-awesome/css/font-awesome.min.css',
            'bower_components/sweetalert/dist/sweetalert.css',
            'bower_components/angular-rangeslider/angular.rangeSlider.css',
            'bower_components/angularjs-datepicker/dist/angular-datepicker.min.css'
        ])
        .pipe(concat('framework-'+pkg.version.replace(/\./g,"_")+'.min.css'))
        .pipe(gulp.dest('assets/css'));
});

gulp.task('framework_fonts', function () {
    return gulp.src('bower_components/font-awesome/fonts/*')
        .pipe(gulp.dest('assets/fonts'));
});

gulp.task('frameworks_del', function () {
    return del(['assets/css/framework*.min.css','assets/js/framework*.min.js','assets/fonts/*']);
});

gulp.task('default', function (cb) {
    sequence('frameworks_del','c1_del_sass','c1_del_js',['framework_scripts','framework_styles','framework_fonts','js','sass'], cb);
});

gulp.task('js', function () {
    return gulp.src([
            'src/js/c1.js',
            'src/js/modules/c1App.js',
            'src/js/filters/*.js',
            'src/js/services/*.js',
            'src/js/controllers/*.js'
        ])
        .pipe(concat('c1-'+pkg.version.replace(/\./g,"_")+'.min.js'))
        //.pipe(uglify())
        .pipe(gulp.dest('assets/js'));
});

gulp.task('sass', function () {
    return gulp.src('src/scss/*.scss')
        .pipe(concat('c1-'+pkg.version.replace(/\./g,"_")+'.min.css'))
        .pipe(sass({outputStyle:'compressed'}))
        .pipe(gulp.dest('assets/css'));
});

gulp.task('c1_del_sass', function () {
    return del(['assets/css/c1*.css']);
});

gulp.task('c1_del_js', function () {
    return del(['assets/js/c1*.min.js']);
});

gulp.task('c1_js', function (cb) {
    sequence('c1_del_js', 'js', cb);
});

gulp.task('c1_sass', function (cb) {
    sequence('c1_del_sass', 'sass', cb);
});

gulp.task('dev:watch', function () {
    gulp.watch('src/js/**/*', ['c1_js']);
    gulp.watch('src/scss/**/*', ['c1_sass']);
});
