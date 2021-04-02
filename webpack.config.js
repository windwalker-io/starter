const path = require('path');

module.exports = {
  resolve: {
    alias: {
      '@js': path.resolve(__dirname, './www/assets/js'),
      '@view': path.resolve(__dirname, './www/assets/js/@view'),

      '@vendor/': path.resolve(__dirname, './www/assets/vendor/'),
      '@unicorn/': path.resolve(__dirname, './www/vendor/@windwalker-io/unicorn/dist/')
      // '@': './www/@assets',
    }
  }
};
