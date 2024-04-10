<?php
/*
Template Name: ToDo List Page
*/
ob_start();
get_header();

global $wpdb;
$table_name = $wpdb->prefix . 'tasks';
$tasks = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tasks ORDER BY created_at DESC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    todo_list_handle_post_requests();
}

function todo_list_handle_post_requests() {
    global $wpdb;
    if (isset($_POST['close_task_id'], $_POST['close_task_nonce']) && wp_verify_nonce($_POST['close_task_nonce'], 'close_task_action')) {
        $task_id = intval($_POST['close_task_id']);
        $result = $wpdb->delete($wpdb->prefix . 'tasks', ['id' => $task_id], ['%d']);
        if ($result) {
            error_log("Task deleted successfully, rows affected: $result");
        } else {
            error_log("Failed to delete task: " . $wpdb->last_error);
        }
        wp_redirect(esc_url_raw($_SERVER['REQUEST_URI']));
        exit;
    } elseif (isset($_POST['comment_task_id'], $_POST['comment'], $_POST['comment_nonce']) && wp_verify_nonce($_POST['comment_nonce'], 'add_comment_action')) {
        $comment_task_id = intval($_POST['comment_task_id']);
        $comment = sanitize_text_field($_POST['comment']);
        $result = $wpdb->insert($wpdb->prefix . 'task_comments', [
            'task_id' => $comment_task_id,
            'comment' => $comment
        ], ['%d', '%s']);
        if ($result) {
            error_log("Comment added successfully");
        } else {
            error_log("Failed to add comment: " . $wpdb->last_error);
        }
        wp_redirect(esc_url_raw($_SERVER['REQUEST_URI']));
        exit;
    }
}
?>
<div class="container">
    <?php if ($tasks) : ?>
        <ul class="todo-list">
            <?php foreach ($tasks as $task) : ?>
                <li>
                    <h2><?php echo esc_html($task->title); ?></h2>
                    <p><?php echo esc_html($task->description); ?></p>
                    <p>Created at: <?php echo esc_html($task->created_at); ?></p>
                    <p>Due Date: <?php echo esc_html($task->due_date); ?></p>
                    <p>Priority: <?php echo esc_html($task->priority); ?></p>
                    <form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
                        <input type="hidden" name="close_task_id" value="<?php echo $task->id; ?>">
                        <?php wp_nonce_field('close_task_action', 'close_task_nonce'); ?>
                        <button type="submit">Delete Task</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No tasks found.</p>
    <?php endif; ?>
</div>
<?php
get_footer();
ob_end_flush();
?>