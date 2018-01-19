module.exports = {
	presets: [
		['@babel/env', {
			shippedProposals: true,
			useBuiltIns: 'usage',
			loose: true
		}]
	],
	plugins: [
		['@babel/transform-modules-commonjs', { loose: true }],
		'@babel/plugin-transform-member-expression-literals',
		'@babel/plugin-transform-property-literals'
	]
};
