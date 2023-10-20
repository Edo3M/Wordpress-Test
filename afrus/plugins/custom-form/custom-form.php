<?php
/*
Plugin Name:  Custom Form
Description:  A plugin that adds a specific form that stores contact info on a database.
Version:      1.0
Author:       Edgardo Martínez
Author URI:   https://www.wpbeginner.com
*/

// Create shortcode
function custom_form_shortcode() {
    ob_start();
    ?>
    <form method="post">
        <div class="mb-3">
            <label for="name-field" class="form-label">Name:</label>
            <input type="text" name="name" id="name-field" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email-field" class="form-label">Correo Electrónico:</label>
            <input type="email" name="email" id="email-field" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="message-field" class="form-label">Message:</label>
            <textarea name="message" class="form-control" id="message-field" required></textarea>
        </div>

        <input type="submit" name="submit" value="<?php echo get_option('button_tag', 'Submit'); ?>" class="btn btn-primary">
    </form>
    <div id="form-message" class="mt-3 p-3"></div>
    <?php
    return ob_get_clean();
}

add_shortcode('custom_form', 'custom_form_shortcode');


// Handle database
function create_form_submissions_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'form_submissions';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(50) NOT NULL,
        email varchar(100) NOT NULL,
        message text NOT NULL,
        submission_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

register_activation_hook(__FILE__, 'create_form_submissions_table');

// Delete database on deactivation (commented)
/*function delete_form_submissions_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'form_submissions';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

register_deactivation_hook(__FILE__, 'delete_form_submissions_table');*/


// Process Form
function process_form() {
    global $wpdb;

    if (isset($_POST['submit'])) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_text_field($_POST['message']);

        $table_name = $wpdb->prefix . 'form_submissions';

        $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'email' => $email,
                'message' => $message,
                'submission_date' => current_time('mysql', true)
            )
        );

        wp_redirect(site_url('/thank-you/'));
        exit;
    }
}

add_action('init', 'process_form');

/*function enqueue_custom_script() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-script', plugin_dir_url(__FILE__) . 'custom-form.js', array('jquery'), '1.5', true);
    wp_localize_script('custom-script', 'custom_vars', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_custom_script');*/


// Admin options
function add_admin_options() {
    add_menu_page('Custom Form Options', 'Custom Form', 'manage_options', 'contact-options', 'form_options', 'dashicons-feedback
    ');
}
add_action('admin_menu', 'add_admin_options');

function form_options() {
    ?>
    <div class="wrap">
        <h2>Custom Form</h2>
        <p>Copy and paste this shortcode to add the contact form to your content: <code>[custom_form]</code></p>
        <form method="post" action="options.php">
            <?php settings_fields('custom_form_options'); ?>
            <?php do_settings_sections('custom_form'); ?>
            <input type="submit" class="button-primary" value="Save Changes">
        </form>
    </div>
    <?php
}

function register_options() {
    register_setting('custom_form_options', 'button_tag');
    add_settings_section('custom_form', 'Custom Form Settings', 'show_section_options', 'custom_form');
    add_settings_field('button_tag', 'Submit button tag', 'show_button_tag', 'custom_form', 'custom_form');
}
add_action('admin_init', 'register_options');

function show_section_options() {
    echo 'Customize submit button tag:';
}

function show_button_tag() {
    $tag = get_option('button_tag', 'Submit');
    echo '<input type="text" name="button_tag" value="' . esc_attr($tag) . '">';
}


// Get Submissions
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Custom_Submissions_List_Table extends WP_List_Table {
    function get_columns() {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name', 'submission-cookie-consent'),
            'email' => __('Email', 'submission-cookie-consent'),
            'message' => __('Message', 'submission-cookie-consent'),
            'submission_date' => __('Submission Date', 'submission-cookie-consent'),
        );
        return $columns;
    }

    function prepare_items() {
        //data
        $this->table_data = $this->get_table_data();

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $primary  = 'name';
        $this->_column_headers = array($columns, $hidden, $sortable, $primary);
        usort($this->table_data, array(&$this, 'usort_reorder'));
        
        $this->items = $this->table_data;
    }

    private function get_table_data() {
        global $wpdb;

        $table = $wpdb->prefix . 'form_submissions';

        return $wpdb->get_results(
            "SELECT * from {$table}",
            ARRAY_A
        );
    }

    private $table_data;

    function column_default($item, $column_name) {
        switch ($column_name) {
            case 'id':
            case 'name':
            case 'email':
            case 'message':
            case 'submission_date':
            default:
                return $item[$column_name];
        }
    }

    function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="element[]" value="%s" />',
            $item['id']
        );
    }

    protected function get_sortable_columns() {
        $sortable_columns = array(
            'name'  => array('name', false),
            'email' => array('email', false),
            'message' => array('message', false),
            'submission_date' => array('submission_date', false)
        );
        return $sortable_columns;
    }

    function usort_reorder($a, $b) {
        // If no sort, default to user_login
        $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'name';

        // If no order, default to asc
        $order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';

        // Determine sort order
        $result = strcmp($a[$orderby], $b[$orderby]);

        // Send final sort direction to usort
        return ($order === 'asc') ? $result : -$result;
    }
}

function add_submissions_submenu_page() {
    $page_title = 'Form Submissions';
    $menu_title = 'Form Submissions';
    $capability = 'manage_options';
    $menu_slug = 'custom-submissions';
    $function = 'submissions_list_init';

    add_submenu_page('contact-options', $page_title, $menu_title, $capability, $menu_slug, $function);
}

add_action('admin_menu', 'add_submissions_submenu_page');

function submissions_list_init() {
    $table = new Custom_Submissions_List_Table();

    echo '<div class="wrap"><h2>Submissions List</h2>';
    $table->prepare_items();
    $table->display();
    echo '</div>';
}