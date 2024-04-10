<div class="wrap">
    <h1 class="wp-heading-inline">ToDo List</h1>
    <a href="<?php echo admin_url('admin.php?page=todo_list&action=add_new'); ?>" class="page-title-action">Add New Task</a>
    <hr class="wp-header-end">

    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th scope="col" id="id" class="manage-column column-id">ID</th>
                <th scope="col" id="title" class="manage-column column-title">Title</th>
                <th scope="col" id="description" class="manage-column column-description">Description</th>
                <th scope="col" id="priority" class="manage-column column-priority">Priority</th>
                <th scope="col" id="created_at" class="manage-column column-created_at">Created at</th>
                <th scope="col" id="due_date" class="manage-column column-due_date">Due Date</th>
                <th scope="col" id="actions" class="manage-column column-actions">Actions</th>
            </tr>
        </thead>
        <tbody id="the-list">
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks';
        $tasks = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");

        if ($tasks) :
            foreach ($tasks as $task) :
                ?>
                <tr>
                    <td class="column-id"><?php echo esc_html($task->id); ?></td>
                    <td class="column-title"><?php echo esc_html($task->title); ?></td>
                    <td class="column-description"><?php echo esc_html($task->description); ?></td>
                    <td class="column-priority"><?php echo esc_html($task->priority); ?></td>
                    <td class="column-created_at"><?php echo esc_html($task->created_at); ?></td>
                    <td class="column-due_date"><?php echo esc_html($task->due_date); ?></td>
<td class="column-actions">
                        <a href="<?php echo admin_url('admin.php?page=todo_list&action=edit&task_id=' . $task->id); ?>" class="button action">Edit</a>
                        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="display:inline;">
                            <input type="hidden" name="action" value="delete_task">
                            <input type="hidden" name="task_id" value="<?php echo esc_attr($task->id); ?>">
                            <input type="submit" class="button action" value="Delete" onclick="return confirm('Are you sure you want to delete this task?');">
                            <?php wp_nonce_field('delete_task_action', 'delete_task_nonce'); ?>
                        </form>
                    </td>
                </tr>
                <?php
            endforeach;
        else :
            ?>
            <tr>
                <td colspan="6">No tasks found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
