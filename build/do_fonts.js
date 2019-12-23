var gulp    = require('gulp'),
rename      = require('gulp-rename'),
insert      = require('gulp-insert'),
fileinclude = require('gulp-file-include');

function do_fonts()
{
    return gulp.src(['src/fonts/**/*'])
        .pipe(gulp.dest('./www/assets/fonts/'))
}

gulp.task('do_fonts', do_fonts);

module.exports = {
    do_fonts: do_fonts,
};
