/**
 * 处理路径相关都在config里面完成
 */
import { argv } from 'yargs';
import path from 'path';
import parameters from './parameters';
import { searchEntries } from './util';

let specialArgv = {};
argv._.forEach((arg) => {
  if (arg.indexOf(':') > 0) {
    let argArr = arg.split(':');
    specialArgv[argArr[0]] = argArr[1];
  }
});

let port = specialArgv.port || 3030;
let debugMode = !!argv.debugMode;

const currentDir = path.resolve(__dirname);
const globalAssetsDir = path.resolve(currentDir, '../');
const rootDir = path.resolve(currentDir, '../../../../');
const srcDir = path.resolve(rootDir, 'src');

let assetsSrcDirs = [globalAssetsDir];
let bundleEntry = {};
  /**
   * let bundleEntry = {
   *    app: {
   *      app: '/src/AppBundle/Resources/assets/app.js',
   *      'app/default/index': '/src/AppBundle/Resources/assets/js/default/index.js',
   *      ...
   *    },
   *    admin: {
   *      admin: '/src/AppBundle/Resources/assets/admin.js',
   *      'admin/default/index': '/src/AdminBundle/Resources/assets/js/default/index.js',
   *      ...
   *    },
   * };
   */
parameters.registeredBundles.forEach((bundle) => {
  const bundleAssetsDir = `${srcDir}/${bundle}/Resources/assets`;

  const bundleName = bundle.replace('Bundle', '').toLowerCase();
  bundleEntry[bundleName] = {};
  bundleEntry[bundleName][bundleName] = `${bundleAssetsDir}/${bundleName}.js`;
  Object.assign(bundleEntry[bundleName], searchEntries(`${bundleAssetsDir}/js`, `${bundleName}/`));

  assetsSrcDirs.push(bundleAssetsDir);
});

let libEntry = {};
let libEntryPrefix = 'libs/';
//convert relative path to absolute path if it's a js file
for (let key in parameters.libs) {
  libEntry[`${libEntryPrefix}${key}`] = [];
  parameters.libs[key].forEach((le) => {
    if (le.indexOf('.js') > 0) {
      libEntry[`${libEntryPrefix}${key}`].push(path.resolve(currentDir, le));
    } else {
      libEntry[`${libEntryPrefix}${key}`].push(le);
    }
  });
}

let config = {

  // Environment
  __DEBUG__: debugMode,
  __DEV__: process.env.NODE_ENV === 'development',
  __DEV_SERVER_PORT__: port,

  // Dir
  rootDir: rootDir,
  srcDir: srcDir,
  libsDir: path.resolve(globalAssetsDir, 'libs'),
  commonDir: path.resolve(globalAssetsDir, 'common'),
  assetsSrcDirs: assetsSrcDirs,
  nodeModulesDir: path.resolve(rootDir, 'node_modules'),

  // webpack
  bundleEntry: bundleEntry,
  libEntry: libEntry,
  output: {
    path : path.resolve(currentDir, parameters.output.path),
    publicPath: parameters.output.publicPath,
  },
  noParseDeps: parameters.noParseDeps || [],
};

export default config;
