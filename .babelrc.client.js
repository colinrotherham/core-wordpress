module.exports = {
  plugins: [
    ['@babel/transform-modules-commonjs', { loose: true }],
    '@babel/plugin-transform-member-expression-literals',
    '@babel/plugin-transform-property-literals',
    ['module-extension', { mjs: 'js' }],
  ],
  presets: [
    ['@babel/preset-env', {
      shippedProposals: true,
      useBuiltIns: 'usage',
      corejs: 3,
      loose: true,
    }],
  ],
};
