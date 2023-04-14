'use strict';
module.exports = function(grunt) {
	const sass = require('node-sass');
  grunt.initConfig({
			theme_slugname: 'restoration',
      // let us know if our JS is sound.
      jshint: {
	      options: {
          "bitwise": true,
          "browser": true,
          "curly": true,
          "eqeqeq": true,
          "eqnull": true,
          "immed": true,
          "jquery": true,
          "latedef": true,
          "newcap": true,
          "noarg": true,
          "node": true,
          "strict": false,
          "undef": false,
					"esversion": '8'
	      },
	      all: [
	        'Gruntfile.js',
	        'assets/js/plugins/app.js',
	        'assets/js/plugins/admin-meta.js',
	      ]
      },

      // concatenation and minification all in one.
      uglify: {
	      dist: {
	        files: {
						'assets/js/admin-meta.min.js': [
							'assets/js/plugins/admin-meta.js'
						],
						'assets/js/vendor.min.js': [
							'assets/js/vendor/*.js'
						],
						'assets/js/app.min.js': [
							'assets/js/plugins/app.js'
						]
	        }
	      }
      },

			concat: {
				options: {
					stripBanners: true
				},
				dist: {
					src: 'assets/js/vendor/*.js',
					dest: 'assets/js/vendor.min.js',
				}
			},

      // style (Sass) compilation.
			sass: {
        dist: {
          options: {
						implementation: sass,
						includePaths: [
							'node_modules/foundation-sites/scss',
							'node_modules/compass-mixins/lib'
						],
            outputStyle: 'compressed'
          },
					files: {
						'assets/css/app.css': 'assets/sass/app.scss',
						'assets/css/admin.css': 'assets/sass/admin.scss',
						'assets/css/editor-style.css': 'assets/sass/editor-style.scss'
					},
        },
				dev: {
					options: {
						implementation: sass,
						includePaths: [
							'node_modules/foundation-sites/scss',
							'node_modules/compass-mixins/lib'
						],
						outputStyle: 'expanded'
					},
					files: {
						'assets/css/app.css': 'assets/sass/app.scss',
						'assets/css/admin.css': 'assets/sass/admin.scss',
						'assets/css/editor-style.css': 'assets/sass/editor-style.scss'
					},
				}
      },

      // watch our project for changes.
      watch: {
	      sass: {
          files: [
            'assets/sass/*',
            'assets/sass/*/*'
          ],
          tasks: ['sass']
	      },
	      js: {
          files: [
              '<%= jshint.all %>'
          ],
          tasks: ['uglify']
	      },
				docs: {
					files: '**/*.php',
					options: {
						nospawn: true,
						livereload: true
					}
				}
      },


      // Check textdomain errors.
  		checktextdomain: {
  			options:{
  				text_domain: 'restoration',
  				keywords: [
  					'__:1,2d',
  					'_e:1,2d',
  					'_x:1,2c,3d',
  					'esc_html__:1,2d',
  					'esc_html_e:1,2d',
  					'esc_html_x:1,2c,3d',
  					'esc_attr__:1,2d',
  					'esc_attr_e:1,2d',
  					'esc_attr_x:1,2c,3d',
  					'_ex:1,2c,3d',
  					'_n:1,2,4d',
  					'_nx:1,2,4c,5d',
  					'_n_noop:1,2,3d',
  					'_nx_noop:1,2,3c,4d'
  				]
  			},
  			theme: {
  				src: [
  					'**/*.php',
  					'!node_modules/**',
            '!inc/admin/plugins/class-tgm-plugin-activation.php',
            '!woocommerce/**',
						'!vendor/**',
						'!inc/admin/option-tree/admin/**'
  				],
  				expand: true
  			}
  		},

  });

  // load tasks.
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-strip-code');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-compress');
  grunt.loadNpmTasks('grunt-checktextdomain');

  // register task.
  grunt.registerTask('default', [
    'jshint',
    'sass:dev'
  ]);

	grunt.registerTask('release', [
    'jshint',
    'sass:dist',
    'uglify',
    'watch'
  ]);

};