'use strict';

let path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  mode: 'development',
  entry: './assets/js/modul-colector.js',
  output: {
    filename: 'bundle.js',
    path: __dirname + '/assets/src'
  },
  watch: true,

  devtool: "source-map",

  module: {
    rules: [{
      test: /\.scss$/,
      use: [
        MiniCssExtractPlugin.loader,
        "css-loader",
        "sass-loader"
      ]
    }]
  },

  plugins: [
    new MiniCssExtractPlugin({
      filename: "style.css"
    })
  ]
};
