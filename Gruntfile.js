module.exports = function(grunt) {

    grunt.initConfig({
        watch: {
            files: ['css/src/main.css'],
            tasks: ['default'],
          },
        postcss: {
            options: {
              map: {
                  inline: false, // save all sourcemaps as separate files...
                  annotation: 'css/maps/' // ...to the specified directory
              },
              processors: [
                require('precss')({ /* options */ }),
                require('autoprefixer')({browsers: 'last 2 versions'}), // add vendor prefixes
              ]
            },
            dist: {
              src: 'css/src/main.css',
              dest: 'css/main.css'
            }
          },
        cssmin: {
          target: {
            files: [{
              expand: true,
              cwd: 'css',
              src: ['*.css', '!*.min.css'],
              dest: 'css',
              ext: '.min.css'
            }]
          }
        }
    });
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-watch');
        grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.registerTask('default', ['postcss:dist','cssmin']);
};