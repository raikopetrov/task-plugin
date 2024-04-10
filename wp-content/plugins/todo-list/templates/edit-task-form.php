<?php
global $wpdb; 
if (!isset($_GET['task_id']) || empty($_GET['task_id'])) {
    wp_die('Task ID is required.');
}
$task_id = intval($_GET['task_id']);
$task = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}tasks WHERE id = %d", $task_id));

if (!$task) {
    wp_die('Task not found.');
}
?>

<div class="wrap">
    <h1>Edit Task</h1>
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="edit_task">
        <input type="hidden" name="task_id" value="<?php echo esc_attr($task->id); ?>">
        <?php wp_nonce_field('edit_task_action', 'edit_task_nonce'); ?>
        <div class="form-field">
            <label for="title">Title</label>
            <input name="title" type="text" id="title" value="<?php echo esc_attr($task->title); ?>" required>
        </div>
        <div class="form-field">
            <label for="description">Description</label>
            <textarea name="description" id="description" required><?php echo esc_textarea($task->description); ?></textarea>
        </div>
        <div class="form-field">
            <label for="priority">Priority</label>
            <select name="priority" id="priority">
                <option value="Low" <?php selected($task->priority, 'Low'); ?>>Low</option>
                <option value="Medium" <?php selected($task->priority, 'Medium'); ?>>Medium</option>
                <option value="High" <?php selected($task->priority, 'High'); ?>>High</option>
            </select>
        </div>
        <div class="form-field">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" value="<?php echo esc_attr($task->due_date); ?>" required>
        </div>
        <input type="submit" class="button button-primary" value="Update Task">
    </form>
</div>