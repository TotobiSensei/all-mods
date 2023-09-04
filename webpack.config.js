'use strict';

let path = require('path');

module.exports = {
  mode: 'development',
  entry: './assets/js/modul-colector.js',
  output: {
    filename: 'bundle.js',
    path: __dirname + '/assets/js'
  },
  watch: true,

  devtool: "source-map",

  module: {}
};
