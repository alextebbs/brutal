var gulp    = require('gulp'),
rename      = require('gulp-rename'),
insert      = require('gulp-insert'),
imagemin = require('gulp-imagemin');

function do_images()
{
    return gulp.src(['src/img/**/*'])
        .pipe(imagemin())
        .pipe(gulp.dest('./www/assets/img/'))
}

gulp.task('do_images', do_images);

module.exports = {
    do_images: do_images,
};
