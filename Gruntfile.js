module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
            css:{
                src: [
                    'assets/src/css/bootstrap.min.css',
                    'assets/src/css/font-awesome.min.css',
                    'assets/src/css/themify-icons.css',
                    'assets/src/css/simple-line-icons.css',
                    'assets/src/css/animsition.min.css',
                    'assets/src/css/magnific-popup.css',
                    'assets/src/css/slider-pro.css',
                    'assets/src/css/owl.carousel.css',
                    'assets/src/css/style.css',
                    'assets/src/css/responsive.cs'
                ],

                dest: './assets/build/css/main.css'
            },

            js: {
                
                src: [
                    'assets/src/js/jquery-2.1.4.min.js',
                    'assets/src/js/plugins.js',
                    'assets/src/js/functions.js',
                    'assets/src/js/jquery.sliderPro.min.js',
                    'assets/src/js/counterup.js',
                    'assets/src/js/piechart.js',
                    'assets/src/js/gmap3.js',
                    'assets/src/js/script.js'
                ],
                dest: './assets/build/js/script.js'
            }
        },

        cssmin: {

            options: {
                shorthandCompacting: false,
                roundingPrecision: -1,
                keepSpecialComments: 0,
                sourceMap: false
            },

            target: {
                files: [{
                    expand: true,
                    cwd: './assets/build/css/',
                    src: ['main.css'],
                    dest: './assets/build/css/',
                    ext: '.min.css'
                }]
            }
        },

        // MIINIFY JS
        uglify: {

            options: {
                report: 'gzip'
            },

            main: {
                src: ['./assets/build/js/script.js'],
                dest: './assets/build/js/script.min.js'
            }
        },

        // COPY CONTENT
        copy: {
            fonts:{
                files: [{
                    expand: true,
                    cwd: './assets/src/fonts/',
                    src: '**',
                    dest: './assets/build/fonts/',
                    filter: 'isFile'
                }]
            },

            images:{
                files: [{
                    expand: true,
                    cwd: './images/',
                    src: '**',
                    dest: './assets/images/',
                    filter: 'isFile'
                }]
            },
        },

        watch: {
            css: {
                files: [
                    './assets/src/css/*.css'
                ],
                tasks: ['css']
            },

            js: {
                files: [
                    './assets/src/js/*.js'
                ],
                tasks: ['js']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-copy');    

    grunt.registerTask( 'css', ['concat:css', 'cssmin'] );
    grunt.registerTask( 'js', ['concat:js', 'uglify'] );

    grunt.registerTask( 'default', ['concat', 'cssmin', 'uglify', 'copy']);
}