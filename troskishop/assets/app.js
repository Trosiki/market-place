// assets/app.js
const $ = require('jquery');
global.$ = global.jQuery = $;

require('bootstrap');
import 'bootstrap/dist/css/bootstrap.css';
import './styles/app.scss';
import 'htmx.org';
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
window.htmx = require('htmx.org');