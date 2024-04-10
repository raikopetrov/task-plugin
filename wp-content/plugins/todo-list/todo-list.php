<?php
/*
Plugin Name: ToDo List
Description: Simple to-do list plugin with CRUD operations in the WordPress admin area.
Author: Rayko Petrov
Author URI: https://www.linkedin.com/in/raikopetrov/
Version: 1.0.0
Text Domain: todo-list
*/

function todo_list_activate() {
    todo_list_create_tasks_table();
    todo_list_create_comments_table();
    todo_list_update_tasks_table();  
}

function todo_list_update_tasks_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tasks';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        title varchar(255) NOT NULL,
        description text NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        priority text NOT NULL,
        due_date date NOT NULL,
        closed tinyint(1) NOT NULL DEFAULT 0,
        file_url varchar(255) DEFAULT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

register_activation_hook(__FILE__, 'todo_list_activate');

function todo_list_create_comments_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'task_comments';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        task_id mediumint(9) NOT NULL,
        comment text NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        FOREIGN KEY (task_id) REFERENCES {$wpdb->prefix}tasks(id) ON DELETE CASCADE
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function todo_list_admin_menu() {
    add_menu_page('ToDo List', 'ToDo List', 'manage_options', 'todo_list', 'todo_list_admin_page', 'dashicons-list-view');
}
add_action('admin_menu', 'todo_list_admin_menu');

function todo_list_admin_page() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'view';
    switch ($action) {
        case 'add_new':
            include(plugin_dir_path(__FILE__) . 'templates/add-task-form.php');
            break;
        case 'edit':
            include(plugin_dir_path(__FILE__) . 'templates/edit-task-form.php');
            break;
        default:
            include(plugin_dir_path(__FILE__) . 'templates/admin-page.php');
            break;
    }
}
function todo_list_add_task() {
    if (!isset($_POST['todo_list_nonce']) || !wp_verify_nonce($_POST['todo_list_nonce'], 'todo_list_action')) {
        wp_die('Security check failed');
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'tasks';
    $title = sanitize_text_field($_POST['title']);
    $description = sanitize_textarea_field($_POST['description']);
    $priority = sanitize_text_field($_POST['priority']);
    $due_date = sanitize_text_field($_POST['due_date']);
    
    $wpdb->insert($table_name, [
        'title' => $title,
        'description' => $description,
        'priority' => $priority,
        'due_date' => $due_date
    ], ['%s', '%s', '%s', '%s']);
    
    wp_redirect(admin_url('admin.php?page=todo_list'));
    exit;
}
add_action('admin_post_add_task', 'todo_list_add_task');

add_action('admin_post_edit_task', 'todo_list_edit_task');  // Ensure this is connected correctly
function todo_list_edit_task() {
    if (!isset($_POST['edit_task_nonce'], $_POST['task_id']) || !wp_verify_nonce($_POST['edit_task_nonce'], 'edit_task_action')) {
        wp_die('Security check failed.');
    }

    $task_id = intval($_POST['task_id']);
    $title = sanitize_text_field($_POST['title']);
    $description = sanitize_textarea_field($_POST['description']);
    $priority = sanitize_text_field($_POST['priority']);
    $due_date = sanitize_text_field($_POST['due_date']);

    global $wpdb;
    $table_name = $wpdb->prefix . 'tasks';

    $result = $wpdb->update($table_name, [
        'title' => $title,
        'description' => $description,
        'priority' => $priority,
        'due_date' => $due_date
    ], ['id' => $task_id], ['%s', '%s', '%s', '%s'], ['%d']);

    if ($result === false) {
        wp_die('Failed to update task.');
    }

    wp_redirect(admin_url('admin.php?page=todo_list'));
    exit;
}

add_action('admin_post_delete_task', 'todo_list_delete_task');
function todo_list_delete_task() {
    if (!isset($_POST['delete_task_nonce']) || !wp_verify_nonce($_POST['delete_task_nonce'], 'delete_task_action')) {
        wp_die('Security check failed');
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'tasks';
    $task_id = isset($_POST['task_id']) ? intval($_POST['task_id']) : 0;

    $result = $wpdb->delete(
        $table_name,
        ['id' => $task_id],
        ['%d']
    );

    if ($result === false) {
        wp_die('Failed to delete task');
    }

    wp_redirect(admin_url('admin.php?page=todo_list'));
    exit;
}

function todo_list_admin_enqueue_scripts($hook) {
    if ('toplevel_page_todo_list' !== $hook) {
        return;
    }
    wp_enqueue_style('todo-list-admin-style', plugins_url('/css/admin-style.css', __FILE__));
    wp_enqueue_style('todo-list-custom-style', plugins_url('/css/style.css', __FILE__));
    wp_enqueue_script('todo-list-admin-script', plugins_url('/js/admin-scripts.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'todo_list_admin_enqueue_scripts');
?>

<link rel="stylesheet" href="<?php echo plugins_url('/css/style.css', __FILE__); ?>">
<link rel="stylesheet" href="<?php echo plugins_url('/css/admin-style.css', __FILE__); ?>">

<script src="<?php echo plugins_url('/js/scripts.js', __FILE__); ?>"></script>
<script src="<?php echo plugins_url('/js/admin-scripts.js', __FILE__); ?>"></script>