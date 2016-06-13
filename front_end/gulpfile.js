/**
 * Created by jenish on 13-06-2016.
 */

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var clean = require('gulp-clean');
var del = require('del');
var htmlmin = require('gulp-htmlmin');

var path = {
    'assets': "./assets",
    'bower': "./bower_components",
    'public': "../public/front_end"
};

gulp.task('clean', function () {
    return del([
        // here we use a globbing pattern to match everything inside the `mobile` folder
        path.public + '/**/*'
        // we don't want to clean this file though so we negate the pattern
        //,'!dist/mobile/deploy.json'
    ], {force: true});
});
gulp.task('partials', function () {
    gulp.src(path.assets + '/scripts/app/partials/**/*.html')
        .pipe(htmlmin({collapseWhitespace: true}))
        .pipe(gulp.dest(path.public + '/js/app/partials'));
});
gulp.task('copyFontFiles', function () {
    gulp.src([
        path.assets + '/images/*'
    ]).pipe(gulp.dest(path.public + '/images'));
    gulp.src([
        path.bower + '/font-awesome/fonts/*'
    ]).pipe(gulp.dest(path.public + '/fonts'));
    return gulp.src([
        path.bower + '/bootstrap-sass/assets/fonts/bootstrap/*'
    ]).pipe(gulp.dest(path.public + '/fonts/bootstrap'));
});
gulp.task('styles', ['copyFontFiles'], function () {
    return gulp.src([
        path.assets + '/styles/app.scss',
        path.bower + '/toastr/toastr.css',
        path.bower + '/angular-loading-bar/build/loading-bar.css'
    ])
        .pipe(sass({
            includePaths: [
                path.bower + '/bootstrap-sass/assets/stylesheets',
                path.bower + '/font-awesome/scss'
            ]
        }))
        .pipe(concat('app.css'))
        .pipe(uglifycss())
        .pipe(gulp.dest(path.public + '/css'));
});
gulp.task('scripts', function () {

    //vendor scripts
    gulp.src([
        path.bower + '/jquery/dist/jquery.js',
        path.bower + '/bootstrap-sass/assets/javascripts/bootstrap.js',
        path.bower + '/requirejs/require.js',
        path.bower + '/json2/json2.js',
        path.bower + '/angular/angular.js',
        path.bower + '/lodash/dist/lodash.js',
        path.bower + '/angular-route/angular-route.js',
        path.bower + '/angular-ui-router/release/angular-ui-router.js',
        path.bower + '/angular-cookies/angular-cookies.js',
        path.bower + '/angular-resource/angular-resource.js',
        path.bower + '/angular-sanitize/angular-sanitize.js',
        path.bower + '/angular-base64/angular-base64.js',
        path.bower + '/angular-loading-bar/build/loading-bar.js',
        path.bower + '/ngInfiniteScroll/build/ng-infinite-scroll.js',
        path.bower + '/domReady/domReady.js',
        path.bower + '/toastr/toastr.js',
        path.bower + '/moment/moment.js'
    ])
        .pipe(uglify())
        .pipe(gulp.dest(path.public + '/js/vendor'));

    //assets scripts
    return gulp.src(path.assets + '/scripts/**/*.js')
        .pipe(gulp.dest(path.public + '/js'));

});
gulp.task('watch', function () {
    gulp.watch(path.assets + '/scripts/app/partials/**/*', ['partials']);
    gulp.watch(path.assets + '/styles/**/*.scss', ['styles']);
    gulp.watch(path.assets + '/scripts/**/*.js', ['scripts']);
});
gulp.task('default', ['clean', 'partials', 'styles', 'scripts', 'watch']);
