'use strict';
module.exports = function (grunt) {
	grunt.initConfig({
		pkg    : grunt.file.readJSON('package.json'),
		watch  : {
			sass      : {
				files  : ['library/styles/**/*.{scss,sass}'],
				tasks  : ['sass:dist'],
				options: {
					nospawn: false
				}
			},
			livereload: {
				files  : [
					'library/views/**/*.{html,php}',
					//					'app/index.html',
					//					'.tmp/styles/app.css',
					'library/includes/**/*.php',
					'*.php',
					'page-templates/*.php',

					'library/scripts/**/*.{js,json}',
					'library/css/app.css',
					'library/images/**/*.{png,jpg,jpeg,gif,webp,svg}'],
				options: {
					livereload: true
				}
			}
		},
		sass   : {
			dev : {
				options: {
										sourceComments: 'none',
										outputStyle   : 'expanded'
				},
				files  : {
					//					'.tmp/styles/app.css': 'app/styles/app.scss'
					'library/css/app.css': 'library/styles/app.scss'
				}
			},
			dist: {
				options: {
										sourceComments: 'normal',
										outputStyle   : 'expanded'
				},
				files  : {
					'library/css/app.css': 'library/styles/app.scss'
				}
			}
		}, open: {
			server: {
				url: 'http://angularpress.localhost'
				//				url: 'http://localhost:8001'
			}
		},
		clean  : {
			dist  : {
				files: [
					{
						dot: true,
						src: [
							'.tmp',
							'<%= yeoman.dist %>/*',
							'!<%= yeoman.dist %>/.git*'
						]
					}
				]
			},
			server: '.tmp'
		}
	});
	grunt.registerTask('default', ['clean:server', 'open', 'watch']);
	grunt.registerTask('server', ['clean:server', 'sass:dev', 'open', 'watch']);
	grunt.registerTask('build', ['clean:server', 'sass:dist', 'open', 'watch']);
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-open');
	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
};