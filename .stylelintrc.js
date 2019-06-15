module.exports = {
  plugins: [
    'stylelint-scss',
  ],
  rules: {
    indentation: 'tab',
    'at-rule-empty-line-before': [
      'always', {
        ignoreAtRules: [
          'else',
        ],
        ignore: [
          'after-comment',
          'inside-block',
          'blockless-after-same-name-blockless',
          'blockless-after-blockless',
        ],
      },
    ],
    'block-opening-brace-space-before': 'always',
    'block-closing-brace-newline-after': [
      'always', {
        ignoreAtRules: [
          'if',
          'else',
        ],
      },
    ],
    'at-rule-name-space-after': 'always',
    'rule-empty-line-before': [
      'always', {
        except: [
          'after-single-line-comment',
        ],
      },
    ],
    'scss/at-else-closing-brace-newline-after': 'always-last-in-chain',
    'scss/at-else-closing-brace-space-after': 'always-intermediate',
    'scss/at-if-closing-brace-newline-after': 'always-last-in-chain',
    'scss/at-if-closing-brace-space-after': 'always-intermediate',
  },
};
