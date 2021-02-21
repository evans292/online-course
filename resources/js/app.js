require('./bootstrap');
require('alpinejs');

import Swal from "sweetalert2";

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
