import UglifyJsPlugin from 'uglifyjs-webpack-plugin';
import fs from 'fs';
import path from 'path';
import webpack from 'webpack';

// Use config for running process
let options = {};
const optionsPath = path.resolve(process.cwd(), '.babelrc.client.js');

if (fs.existsSync(optionsPath)) {
	options = require(optionsPath);
}

// Return module
export default {
	mode: 'production',

	module: {
		rules: [{
			test: /\.js$/,
			include: [
				path.resolve('./src'),
				path.resolve('./src/content/themes/crd-core/assets')
			],
			use: [{
				loader: 'babel-loader',
				options: options
			}]
		}]
	},

	output: {
		chunkFilename: '[name]-[chunkhash].min.js',
		filename: '[name].min.js',
		path: path.resolve('./dist/content/themes/crd-core/assets'),
		publicPath: '/content/themes/crd-core/assets/js/'
	},

	optimization: {
		minimizer: [new UglifyJsPlugin({
			cache: true,
			parallel: true,
			sourceMap: true,
			uglifyOptions: {
				compress: {
					ie8: true,
					warnings: false
				},
				mangle: {
					ie8: true
				},
				output: {
					comments: false,
					ie8: true
				}
			}
		})]
	},

	plugins: [
		new webpack.SourceMapDevToolPlugin({
			filename: '[name].min.js.map',
			publicPath: '/content/themes/crd-core/assets/js/'
		})
	],

	resolve: {
		modules: [
			'node_modules',
			`./src/content/themes/crd-core/assets/js`
		]
	}
};
