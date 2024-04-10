<?php if (!defined('ABSPATH')) exit; ?>

<div class="wrap-admin">
    <h1>Add New Task</h1>
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add_task">
        <?php wp_nonce_field('todo_list_action', 'todo_list_nonce'); ?>
        <div class="form-field">
            <label for="title">Title</label>
            <input name="title" type="text" id="title" value="" required>
        </div>
        <div class="form-field">
            <label for="description">Description</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div class="form-field">
            <label for="priority">Priority</label>
            <select name="priority" id="priority">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>
        <div class="form-field">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" required>
        </div>
        <input type="submit" class="button button-primary" value="Save Task">
    </form>
</div>