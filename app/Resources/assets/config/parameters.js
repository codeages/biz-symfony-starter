const parameters = {
  registeredBundles: [ //register php bundles
    'AppBundle',
    'AdminBundle',
  ],
  output: {
    path : '../../../../web/bundles', //file output path, relative to this file
    publicPath: '/bundles/' //relative to website domain
  },
  libs: {
    vendor: ['../libs/vendor.js'], //can be a js file
    "fix-ie": ['html5shiv', 'respond-js'],
    "jquery-validation": ['../libs/js/jquery-validation.js'],
    "jquery-form": ['jquery-form'],
  },
  noParseDeps: [ //these node modules will use a dist version to speed up compilation
    'jquery/dist/jquery.js',
    'bootstrap/dist/js/bootstrap.js',
    'admin-lte/dist/js/app.js',
    'jquery-validation/dist/jquery.validate.js',
    'jquery-form/jquery.form.js',
    'bootstrap-notify/bootstrap-notify.js',
    // The `.` will auto be replaced to `-` for compatibility 
    'respond.js/dest/respond.src.js', 
  ],
}

export default parameters;