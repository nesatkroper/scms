// // bootstrap-validation.js - Standalone version
// (() => {
//     'use strict';

//     // Fetch all forms that need validation
//     const forms = document.querySelectorAll('.needs-validation');
//     // Loop over them and prevent submission
//     Array.from(forms).forEach(form => {
//         form.addEventListener('submit', event => {
//             if (!form.checkValidity()) {
//                 event.preventDefault();
//                 event.stopPropagation();
//             }

//             form.classList.add('was-validated');
//         }, false);

//         // Add input event listeners for real-time validation
//         const inputs = form.querySelectorAll('input, select, textarea');
//         inputs.forEach(input => {
//             input.addEventListener('input', () => {
//                 if (input.checkValidity()) {
//                     input.classList.remove('is-invalid');
//                     input.classList.add('is-valid');
//                 } else {
//                     input.classList.remove('is-valid');
//                     input.classList.add('is-invalid');
//                 }
//             });
//         });
//     });
// })();