var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('sass', function () {
    return gulp.src('./frontend/web/scss/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(gulp.dest('./frontend/web/css/'));
});

gulp.task('watch', function () {
    gulp.watch('./frontend/web/scss/**/**/*.scss', ['sass']);
});