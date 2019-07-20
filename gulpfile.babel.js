import gulp from 'gulp';
import plugins from 'gulp-load-plugins';
import runSequence from 'run-sequence';
import del from 'del';
import pkg from './package.json';

const dirs = pkg['h5bp-configs'].directories;

// ---------------------------------------------------------------------
// | Helper tasks                                                      |
// ---------------------------------------------------------------------

gulp.task('clean', (done) => {
  del([dirs.dist]).then(() => {
    done();
  });
});

gulp.task('clean:deployed', (done) => {
  del([dirs.deploy], { force:true }).then(() => {
    done();
  });
});

gulp.task('copy', [
  'copy:misc',
  'copy:composer'
]);

gulp.task('scss', () => {
  gulp.src(`${dirs.src}/assets/sass/style.scss`)
    .pipe(plugins().sass.sync().on('error', plugins().sass.logError))
    .pipe(plugins().autoprefixer({
      browsers: ['last 2 versions', 'ie >= 11', '> 1%'],
      cascade: false
    }))
    .pipe(gulp.dest(`${dirs.dist}/assets/css`))
    .pipe(plugins().sass({ outputStyle:'compressed' }).on('error', plugins().sass.logError))
    .pipe(plugins().rename({ suffix: '.min' }))
    .pipe(gulp.dest('.'));
});

gulp.task('copy:misc', () =>
  gulp.src([
    `${dirs.src}/**/*`,
    `!${dirs.src}/assets/sass/**/*`,
    `!${dirs.src}/assets/sass`
  ], { dot: true })
    .pipe(gulp.dest(dirs.dist))
);

gulp.task('copy:composer', () =>
  gulp.src([`${dirs.src}/../vendor/**/*`], { dot: true })
    .pipe(gulp.dest(`${dirs.dist}/vendor`))
);

gulp.task('copy:vendor-js', () =>
  gulp.src([
  ], { dot: true })
    .pipe(gulp.dest(`${dirs.dist}/assets/js/vendor`))
);

gulp.task('copy:deploy', () =>
  gulp.src([`${dirs.dist}/**/*`], { dot: true })
    .pipe(gulp.dest(dirs.deploy))
);

gulp.task('lint:js', () =>
  gulp.src([
    'gulpfile.js',
    `${dirs.src}/assets/js/*.js`,
    `${dirs.test}/*.js`
  ]).pipe(plugins().jscs())
    .pipe(plugins().eslint())
    .pipe(plugins().eslint.failOnError())
);


// ---------------------------------------------------------------------
// | Main tasks                                                        |
// ---------------------------------------------------------------------

gulp.task('build', (done) => {
  runSequence(
    ['clean'],//, 'lint:js'],
    ['scss'],
    'copy',
    done);
});

gulp.task('deploy', (done) => {
  runSequence(
    'clean:deployed',
    'build',
    'copy:deploy',
    done);
});

gulp.task('default', ['build']);
