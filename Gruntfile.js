module.exports = function(grunt){

	"use strict";
	require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

	grunt.initConfig({

			pkg: grunt.file.readJSON('package.json'),

			less: {
				build: {
					files: {
							'assets/css/master.css': ['assets/less/master.less']
					}
				}
			},

			autoprefixer: {
				options: {
					browsers: ['last 10 versions', 'ie 8', 'ie 9', 'ios 6', 'android 4']
				},
				files: {
					expand: true,
					flatten: true,
					src: 'assets/css/*.css',
					dest: 'assets/css/'
				}
			},

			cssmin: {
				minify: {
					expand: true,
					cwd: 'assets/css',
					src: ['*.css', '!*.min.css'],
					dest: 'assets/css',
					ext: '.min.css'
				}
			},

			uglify: {
				build: {
					files: {
						'assets/js/global.min.js': 'assets/js/global.js'
					}
				}
			},

			imagemin: {
				dynamic: {
					files: [
						{
							expand: true,
							cwd: 'assets/images/',
							src: ['**/*.{png,jpg,gif}'],
							dest: 'assets/images/'
						}
					]
				}
			},

			output_twig: {
				settings: {
					options: {
						docroot: 'views/',
						context: {
							"wp_title": "xeero"
						}
					},
					files: [
						{
							expand: true,
							cwd: 'views/',
							src: ['style-guide.twig'],
							dest: 'html/',
							ext: '.html'
						}
					]
				}
			},

			watch: {
				options: {
					livereload: true,
				},
				html: {
					files: ['*.html'],
					tasks: ['htmlhint']
				},
				js: {
					files: ['assets/js/global.js'],
					tasks: ['uglify']
				},
				less: {
					files: ['assets/less/**/*.less'],
					tasks: ['less','autoprefixer','cssmin']
				},
				images: {
					files: ['assets/images/**/*.{png,jpg,gif}'],
					tasks: ['imagemin']
				},
				twig: {
					files: ['views/**/*.twig'],
					tasks: ['output_twig']
				}
			},

	});

	grunt.registerTask('default', []);

};
