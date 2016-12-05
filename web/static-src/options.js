// 配置文件

/* 默认值,可在options中重写
* defaultOptions = {
    commonsChunkFilename: 'common', 
    entryMainname: 'main',
    entryFileName: 'index',

    registeredPlugins: [ // default auto forEach
      'plugins/CrmPlugin'
    ],
    registeredPluginDirs: ['plugins'],

    registeredBundleDirs: ['web', 'admin'],

    globalSrcDir: 'web/static-src',
    globalBuildDir: 'web/static',
    libsDir: 'web/static-src/libs',
    commonDir: 'web/static-src/common',
    nodeModulesDir: 'node_modules',

    pluginAssetsDir: 'Resources/assets',
    pluginBuildDir: 'Resources/static',

    libsDevOutputDir: 'libs',
    libsBuildOutputDir: 'web/static/libs',

    fontlimit: 20480,
    imglimit: 10240,

    devtool: 'cheap-module-eval-source-map', // or 'source-map'

    port: 3030
  }
*/

const options = {
  output: {
    path: 'web/static/',       // dev env, file output path, relative to this file
    buildPath: './',          // prod env, file output path, relative to this file
    publicPath: '/static/',    // relative to website domain, to server
    loadersPublicPath: '../'  // loaders public path
  },
  libs: {
    vendor: ['libs/vendor.js'], //can be a js file
    "fix-ie": ['html5shiv', 'respond-js'], //can be a node_modules package
    "jquery-validation": ['libs/js/jquery-validation.js'],
    "jquery-insertAtCaret": ['libs/js/jquery-insertAtCaret.js'],
    "jquery-form": ['jquery-form'],
  },
  noParseDeps: [ //these node modules will use a dist version to speed up compilation
    'jquery/dist/jquery.js',
    'bootstrap/dist/js/bootstrap.js',
    // 'admin-lte/dist/js/app.js',
    'jquery-validation/dist/jquery.validate.js',
    'jquery-form/jquery.form.js',
    'bootstrap-notify/bootstrap-notify.js',
    // The `.` will auto be replaced to `-` for compatibility 
    'respond.js/dest/respond.src.js',
    'bootstrap-daterangepicker/daterangepicker.js',
    'moment/moment.js',
  ],
  // onlyCopys: [ // copy these form node modules to libs dir 
  //   {
  //     name: 'es-ckeditor',
  //     ignore: [
  //       '**/samples/**',
  //       // '**/lang/!(zh-cn.js)',
  //     ]
  //   }
  // ],
}

export default options;