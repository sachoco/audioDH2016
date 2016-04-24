var gulp = require("gulp");
var sass = require("gulp-sass");
var compass = require('gulp-compass');
// var cssmin = require('gulp-cssmin');
// var rename = require('gulp-rename');
var autoprefixer = require("gulp-autoprefixer");
var frontnote = require("gulp-frontnote");
var uglify = require("gulp-uglify");
var browser = require("browser-sync");
var plumber = require("gulp-plumber");
var pleeease = require("gulp-pleeease");
var coffee = require("gulp-coffee");

gulp.task("server", function(){
	browser({
		server: {
			baseDir: "./",
			directory: true
		}
	});
});

gulp.task("js", function(){
	gulp.src(["js/**/*.js","!js/min/**/*.js"])
		.pipe(plumber())
		.pipe(uglify())
		.pipe(gulp.dest("./js/min"))
		// .pipe(browser.reload({stream:true}))
});

gulp.task("sass", function(){
	gulp.src("sass/**/*.scss")
		.pipe(plumber())
		.pipe(frontnote({
			css:'../css/style.css'
		}))
		.pipe(sass({
	      includePaths: require('node-reset-scss').includePath
	    }))
		// .pipe(autoprefixer())
		.pipe(gulp.dest("./css"))
		// .pipe(browser.reload({stream:true}))
});

// compass
gulp.task('compass', function(){
    gulp.src('sass/**/*.scss')
    .pipe(plumber())
    .pipe(compass({
        config_file: 'config.rb',
        comments: false,
        css: 'css/',
        sass: 'sass/'
    }))
});

gulp.task('ple', function() {
  return gulp.src('css/*.css')
    .pipe(pleeease({
        autoprefixer: ['last 4 versions'], //ベンダープレフィックス
        minifier: false //圧縮の有無 true/false
    }))
    .pipe(gulp.dest('css/'));
});

gulp.task('coffee', function(){
	gulp.src('coffee/**/*.coffee')
		.pipe(coffee())
		.pipe(gulp.dest('js/'));
});

gulp.task("default", function(){
	gulp.watch(["js/**/*.js","!js/min/**/*.js"],["js"]);
	gulp.watch("sass/**/*.scss",["compass"]);
	gulp.watch("coffee/**/*.coffee",["coffee"]);
	return gulp.watch(['css/*.css'], ['ple']);
});
