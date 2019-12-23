var gulp    = require('gulp'),
rename      = require('gulp-rename'),
insert      = require('gulp-insert'),
fileinclude = require('gulp-file-include');

function do_html()
{
    return gulp.src(['src/html/**','src/html/*'])
        .pipe(fileinclude({
          prefix: '@',
          basepath: 'src/html/includes/'
        }))
        .pipe(gulp.dest('./www/'))
}

gulp.task('do_html', do_html);

module.exports = {
    do_html: do_html
};
