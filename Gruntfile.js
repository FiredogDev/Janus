module.exports = function(grunt) {

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
    	compass: {
        files: "library/scss/**/*.scss",
        tasks: ['compass']
      }
    },
    // SASS
    compass: {
      dev: {
        options: {
          config: 'library/config.rb',
          sassDir: 'library/scss',
          cssDir: 'library/css',
          require: 'susy'
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

  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-browser-sync');
  grunt.loadNpmTasks('grunt-contrib-requirejs');

  grunt.registerTask('default', ['browserSync', 'watch']);

};