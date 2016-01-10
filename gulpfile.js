var gulp    = require('gulp');
var phpunit = require('gulp-phpunit');

gulp.task('phpunit', function() {
    var options = {
        debug: false,
        verbose: true,
        tap: true
    };
    gulp.src('phpunit.xml')
        .pipe(phpunit('./vendor/bin/phpunit',options));
});

gulp.task('default', function(){
    gulp.run('phpunit');
    gulp.watch([
        'app/**/*.php',
        'tests/**/*.php'
    ], function(){
        gulp.run('phpunit');
    });
});