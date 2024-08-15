// assets/app.js
const $ = require('jquery');
global.$ = global.jQuery = $;
require('bootstrap');
import 'bootstrap/dist/css/bootstrap.css';
import './styles/app.scss';
import 'htmx.org';
import 'core-js';
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
window.htmx = require('htmx.org');

$(document).ready(function (){
    $('.btn-modify-quantity').click(function (){
       const modifier = $(this).data('modifier');
       let actualQuantity = $(this).siblings('.quantity').val();
       let newQuantity = actualQuantity;
       const totalInShoppingCart = parseInt($('#totalShoppingCartItems').text(),10);

       if(modifier === 'add') {
           newQuantity = ++actualQuantity;
       } else if(modifier === 'remove') {
           newQuantity = --actualQuantity;
       }

       if(newQuantity > 0 && (newQuantity+totalInShoppingCart) <=3) {
            $(this).siblings('.quantity').val(newQuantity);
       }

    });
});