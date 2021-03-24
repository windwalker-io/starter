const path = require('path');

module.exports = {
  resolve: {
    alias: {
      '@js': path.resolve(__dirname, './www/assets/js'),
      '@view': path.resolve(__dirname, './www/assets/js/@view'),
      // '@': './www/@assets',
    }
  }
};
