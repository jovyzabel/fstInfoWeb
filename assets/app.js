/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/galery.css';


require("bootstrap");
require("bootstrap-icons/font/bootstrap-icons.css");
require("@fortawesome/fontawesome-free/css/all.min.css");
require("@fortawesome/fontawesome-free/js/all.js");

// require jQuery normally
const $ = require('jquery');

 // create global $ and jQuery variables
global.$ = global.jQuery = $;

// start the Stimulus application

import 'datatables.net-bs5';
import 'datatables.net-responsive-bs5'

import './counter'
import './datatable'

