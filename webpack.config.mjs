import TerserPlugin from 'terser-webpack-plugin';
import babel from './.babelrc.client.js';
import path from 'path';
import webpack from 'webpack';

// Return module
export default {
  mode: 'production',

  module: {
    rules: [
      {
        exclude: /node_modules/,
        type: 'javascript/auto',
        test: /\.m?js$/,
        use: [{
          loader: 'babel-loader',
          options: babel,
        }],
      },
    ],
  },

  output: {
    chunkFilename: '[name]-[chunkhash].min.js',
    filename: '[name].min.js',
    path: path.resolve('./dist/content/themes/crd-core/assets'),
    publicPath: '/content/themes/crd-core/assets/js/',
  },

  optimization: {
    minimizer: [new TerserPlugin({
      cache: true,
      parallel: true,
      sourceMap: true,
      terserOptions: {
        compress: {
          ie8: true,
          warnings: false,
        },
        mangle: {
          ie8: true,
        },
        output: {
          comments: false,
          ie8: true,
        },
      },
    })],
  },

  plugins: [
    new webpack.SourceMapDevToolPlugin({
      filename: '[name].min.js.map',
      publicPath: '/content/themes/crd-core/assets/js/',
    }),
  ],

  resolve: {
    modules: [
      './node_modules',
      `./src/content/themes/crd-core/assets/js`,
    ],
  },
};
