"use strict"; module.exports = {
  blank: {
    area: 'frontend',
    name: 'Magento/blank',
    locale: 'en_US',
    files: [ 'css/styles-m', 'css/styles-l', 'css/email', 'css/email-inline' ],
    dsl: 'less'
  },
  luma: {
    area: 'frontend',
    name: 'Magento/luma',
    locale: 'en_US',
    files: [ 'css/styles-m', 'css/styles-l' ],
    dsl: 'less'
  },
  backend: {
    area: 'adminhtml',
    name: 'Magento/backend',
    locale: 'en_US',
    files: [ 'css/styles-old', 'css/styles' ],
    dsl: 'less'
  },
  juno: {
    area: 'frontend',
    name: 'Macademy/juno',
    locale: 'en_US',
    files: [ 'css/styles-m', 'css/styles-l' ],
    dsl: 'less'
  }
}