// public/js/delete_warning.js

$(document).ready(function() {
    // Attach event listener to the delete button
    $('.btn-danger').on('click', function() {
        // Display the warning message modal
        $('#warningModal').modal('show');
    });

    // Handle the cancel button click event
    $('.btn-white').on('click', function() {
        // Hide the warning message modal
        $('#warningModal').modal('hide');
    });
});
