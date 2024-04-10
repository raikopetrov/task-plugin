<?php
/*
Template Name: ToDo List Page
*/

get_header();

global $wpdb;
$table_name = $wpdb->prefix . 'tasks';
$tasks = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");

?>
<div class="container">
    <h1>To-Do List</h1>
    <?php if ($tasks) : ?>
        <ul class="todo-list">
            <?php foreach ($tasks as $task) : ?>
                <li>
                    <h2><?php echo esc_html($task->title); ?></h2>
                    <p><?php echo esc_html($task->description); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No tasks found.</p>
    <?php endif; ?>
</div>
<?php

get_footer();
?>
