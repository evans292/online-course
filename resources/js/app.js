require('./bootstrap');
require('alpinejs');

import Swal from "sweetalert2";
import Vue from "vue";
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css'

Vue.use(VueToast);

window.deleteConfirm = function(title, formId)
{
    Swal.fire({
        icon: 'warning',
        text: `Do you want to delete this (${title}) ?`,
        showCancelButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: '#e3342f',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

window.greet = function(args, position = 'top') 
{
    Vue.$toast.success(`Hello ${args}!`, {
        duration: 1500,
        dismissible: true,
        position: position
       })    
}

window.success = function(args) 
{
    Vue.$toast.success(`${args}`, {
        duration: 1500,
        dismissible: true,
        position: 'bottom-right'
       })    
}



