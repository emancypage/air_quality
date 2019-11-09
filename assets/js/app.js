/**
 * Stylesheet
 */
require('bootstrap/dist/css/bootstrap.min.css');
require('malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css');
require('@fortawesome/fontawesome-free/css/all.min.css');
require('../css/app.less');

/**
 * JavaScript
 */
require('bootstrap');
const $ = require('jquery');
require('malihu-custom-scrollbar-plugin');
const main = require('./main');
const navbar = require('./navbar');

main($);
navbar($);