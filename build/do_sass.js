var gulp         = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var fileinclude  = require('gulp-file-include');
var sass         = require('gulp-sass');

sass.compiler = require('sass');

function do_sass()
{
    return gulp.src('src/scss/*.{sass,scss}')
        .pipe(fileinclude({
            prefix: '@@',
            basepath: 'src/'
        }))
        .pipe(sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(autoprefixer({
            cascade: false
        }))
        .pipe(gulp.dest('./www/assets/css/'))
}

gulp.task('do_sass', do_sass);
module.exports = do_sass;
