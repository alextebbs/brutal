var gulp        = require('gulp');
var requireDir  = require('require-dir');
var runSequence  = require('run-sequence');
var connect = require('gulp-connect-php');
var browserSync = require('browser-sync');

var buildinfo = require('./buildinfo.json');

requireDir('./build', { recurse: true })

function sync_html() {
    browserSync.create().init({
        server: {
            baseDir: "./www/"
        }
    });
    watch();
}

function sync_php() {
    connect.server(
        {
            base: 'www'
        }, function (){
        browserSync({
          proxy: 'localhost:8000'
        });
    });
    watch();
}
function watch() {
    gulp.watch("src/scss/**/*.{sass,scss}", ['do_sass']).on('change',  browserSync.reload);
    gulp.watch("src/html/**/*.{php,html,inc,ejs}", ['do_html']).on('change',  browserSync.reload);
    gulp.watch("src/js/**/*.js", ['do_js']).on('change',  browserSync.reload);
    gulp.watch("src/img/**/*", ['do_images']).on('change',  browserSync.reload);
    gulp.watch("src/fonts/**/*", ['do_fonts']).on('change',  browserSync.reload);
}

// Static server
gulp.task('browser-sync', function() {
    switch(buildinfo.project_type) {
        case "html":
            sync_html();
            break;
        case 'php': 
            sync_php();
            break;
    }
});

gulp.task('bsreload', function(cb) {
    browserSync.reload();
    cb();
});

gulp.task('build', function(cb){
    runSequence('do_js','do_images','do_html', 'do_sass', 'do_fonts', cb)
});
gulp.task('run', function(cb){
    runSequence('build', 'browser-sync', cb)
});

gulp.task('default', ['run']);

