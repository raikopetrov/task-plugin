jQuery(document).ready(function($) {
    $('.remove-to-do').click(function() {
        var taskId = $(this).data('task-id');
        $.post(ajaxurl, {
            action: 'remove_task',
            task_id: taskId
        }, function(response) {
            if(response == 'success') {
                alert('Task Deleted Successfully!');
                location.reload(); // Reload the page to update the list
            } else {
                alert('Failed to Delete Task');
            }
        });
    });
});
