// Load plugins
var gulp = require('gulp'),
		plugins = require('gulp-load-plugins')({ camelize: true }),
		browserSync = require('browser-sync');
		reload = browserSync.reload;

// Less
gulp.task('less', function() {
	gulp.src('assets/less/**/[^_]*.less')
		.pipe(plugins.less())
		.pipe(plugins.pleeease({
			autoprefixer: {
				browsers: ['last 2 versions']
			}
		}))
		.on('error', plugins.util.log)
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(gulp.dest('assets/build/css'))
		.pipe(reload({stream:true}))
		.pipe(plugins.livereload())
		.pipe(plugins.notify({ message: 'Styles task complete' }));
});

// Javascript
gulp.task('js', function() {
	gulp.src(['assets/js/*.js'])
		.pipe(plugins.jshint())
		.pipe(plugins.jshint.reporter('default'))
		//.pipe(plugins.concat('scripts.js'))
		.pipe(plugins.uglify())
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(gulp.dest('assets/build/js'))
		.pipe(reload({stream:true}))
		.pipe(plugins.livereload())
		.pipe(plugins.notify({ message: 'Scripts task complete' }));
});

// Imagemin
gulp.task('imagemin', function() {
	gulp.src('assets/images/**/*.{png,jpg,gif,svg}')
		.pipe(plugins.imagemin({
			optimizationLevel: 7,
			progressive: true,
			interlaced: true }))
		.pipe(gulp.dest('assets/build/images'))
		.pipe(reload({stream:true}))
		.pipe(plugins.notify({ message: 'Images task complete' }));
});

// 'gulp'
gulp.task('default', function() {
	plugins.livereload.listen();
	gulp.watch('assets/less/**/*.less', ['less']);
	gulp.watch('assets/js/**/*.js', ['js']);
	gulp.watch('assets/images/**/*.{png,jpg,gif,svg}', ['imagemin']);
});
