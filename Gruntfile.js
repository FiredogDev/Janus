module.exports = function(grunt) {

  require('load-grunt-tasks')(grunt);
  require('time-grunt')(grunt);

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',

    // WATCH
    watch: {
    	sass: {
        files: "library/scss/**/*.scss",
        tasks: ['sass']
      }
    },
    // SASS
    sass: {
        options: {
            sourceMap: true,
        },
        dist: {
            files: {
                'library/css/style.css'         : 'library/scss/style.scss',
                'library/css/admin.css'         : 'library/scss/admin.scss',
                'library/css/editor-style.css'  : 'library/scss/editor-style.scss',
                'library/css/ie.css'            : 'library/scss/ie.scss',
                'library/css/login.css'         : 'library/scss/login.scss'
            }
        }
    },

    // Bower Require WireDeps
    bowerRequirejs: {
      all: {
        rjsConfig: 'library/js/main.js',
        options: {
          'exclude-dev': true
        }
      }
    },
    
    // BROWSER SYNC
    browserSync: {
        dev: {
            bsFiles: {
                src : [
                  'library/css/*.css',
                  '**/*.php'
                ]
            },
            options: {
                watchTask: true,
                proxy: "http://localhost/janus/"
            }
        }
    },
    
    // Require Js
    requirejs: {
  	  compile: {
  	    options: {
  	      baseUrl: "library/js/",
  	      mainConfigFile: "library/js/main.js",
  	      name: 'main',
  	      out: "library/js/dist/dist.js"
  	    }
  	  }
  	}
  });

  grunt.registerTask('default', ['browserSync', 'watch']);

};