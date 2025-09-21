'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

function build() {
  return gulp.src('./inc/sass/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./'));
};

exports.build = build;
exports.watch = function () {
  gulp.watch('./inc/sass/**/*.scss', ['sass']);
};