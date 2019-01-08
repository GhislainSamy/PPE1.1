/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
const $ = require('jquery');

//require('jquery/dist/jquery.slim.min.js');
//require('popper.js/dist/umd/popper.min.js');
//require('bootstrap/dist/js/bootstrap.js');
//require('bootstrap/dist/js/bootstrap.min.js');

require('../css/app.css');
require('../js/index.js');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// var $ = require('jquery');


// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');
require('../css/style.css');
const logoPath = require('../images/imageAcc.png');
const Path = require('../images/logo_urc.png');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
