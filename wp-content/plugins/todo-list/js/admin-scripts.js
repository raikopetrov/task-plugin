document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.button.action.delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            if (!confirm('Are you sure you want to delete this task? This action cannot be undone.')) {
                event.preventDefault(); 
            }
        });
    });
});
