<?php

/**
 * Multilingual Domain
 */
load_plugin_textdomain( 'post-flagger', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/**
 * REQUIRED. Requires table class to show all flags
 */
require_once(plugin_dir_path(__FILE__) . 'classes/flags-table.php');

/**
 * Add init functions to plugin admin
 */
add_action('admin_init', 'post_flagger_admin_init');

/**
 * Add settings page to menu
 */
add_action('admin_menu', 'post_flagger_setup_menu');

/**
 * Safe buffer redirect
 */
function app_output_buffer()
{
    ob_start();
} // soi_output_buffer
add_action('init', 'app_output_buffer');

/**
 * Handles the add item to menu action
 * Adds a page to options page
 *
 */
function post_flagger_setup_menu()
{
    $page = add_options_page('Edit Post Flags', 'Post Flags', 'manage_options', 'post-flagger-options', 'post_flagger_options_init');

    add_action('admin_print_styles-' . $page, 'post_flagger_admin_styles');
}

function post_flagger_admin_init()
{
    /* Register our stylesheet. */
    wp_register_style('myPluginStylesheet', plugins_url('styles.min.css', __FILE__));
}

function post_flagger_admin_styles()
{
    //Enqueque styles.css
    wp_enqueue_style('myPluginStylesheet');
}

/**
 * Build options page
 *
 */
function post_flagger_options_init()
{

    $messages = array(
        'Flag successfully updated.',
        'Flag created!',
        'Flags sent to outter space!',
        'Opps that flag already exists!'
    )

    ?>

    <div class="wrap">

        <?php
        if (isset($_GET['m'])) {
            $messageId = $_GET['m'];
            post_flagger_admin_notice($messages[$messageId]);
        }

        if (isset($_GET['action'])) :

            switch ($_GET['action']) {
                case 'edit':
                    // Get the flag id in the URL
                    $flagId = $_GET['flag'];
                    // Get the flag data from the database
                    $flagData = post_flagger_get_flag_data_by_id($flagId, 'ARRAY_A');
                    // Render the edit form
                    post_flagger_render_view('edit', $flagData);
                    break;
                case 'new':
                    post_flagger_render_view('new');
                    break;
                case 'delete':
                    //If is an array of flags
                    if (is_array($_GET['flag'])) {
                        post_flagger_render_view('list');
                    } else {
                        // Delete flag
                        post_flagger_delete_flag($_GET['flag']);
                        // Redirect
                        wp_redirect(admin_url('options-general.php?page='.$_GET['page'].'&m=2'));
                    }
                    break;
            }

        else :
            post_flagger_render_view('list');
        endif;

        ?>
    </div>

<?php
}

/**
 * Adds the 'Add New' Button
 *
 * @param string $text
 * @param string $class
 * @return string
 */
function pf_add_new_button($text = 'Add new', $class = 'add-new-h2')
{
    if ($text == 'Add new') {
        $text = __( 'Add new', 'post-flagger' );
    }
    return '<a class="' . $class . '" href="?page=post-flagger-options&action=new">' . $text . '</a>';
}

/**
 * includes a view allocated in /views folder
 *
 * @param $name
 * @param array $args
 */
function post_flagger_render_view($name, $args = array())
{
    //Load the view path
    $viewPath = plugin_dir_path(__FILE__) . 'views/' . $name . '.php';

    //Convert the array elements into vars
    extract($args);

    //Include the view
    include($viewPath);
}

/**
 * Add action for update form
 */
add_action('admin_post_pf_update_flag', 'post_flagger_handle_update');

/**
 * Handle update action from edit form
 */
function post_flagger_handle_update()
{

    //Delete 'action' from the $_POST array
    unset($_POST['action']);

    //Update the database with the data passed
    post_flagger_update_flag($_POST);

    //Redirect to plugin settings page
    wp_redirect(admin_url('options-general.php?page=post-flagger-options&m=0'));
    exit;
}


/**
 * Add action for create form
 */
add_action('admin_post_pf_create_flag', 'post_flagger_handle_create');

/**
 * Handle create action from new form
 */
function post_flagger_handle_create()
{

    //Delete 'action' from the $_POST array
    unset($_POST['action']);

    $messageId = 1;

    //Check if flag slug does not exists
    if (!post_flagger_flag_exists($_POST['slug'])) {
        //Create the flag
        post_flagger_create_flag($_POST);
    } else {
        $messageId = 3;
    }

    //Redirect to plugin settings page
    wp_redirect(admin_url('options-general.php?page=post-flagger-options&m=' . $messageId));
    exit;
}

/**
 * Render a notice passed in the params
 *
 * @param $message
 * @param string $class
 */
function post_flagger_admin_notice($message, $class = 'updated')
{
    echo "<div class=\"$class\"> <p>$message</p></div>";
}

/**
 * Notices
 */
function pf_notice_flag_updated() {
	post_flagger_admin_notice('Flag successfully updated.');
}
function pf_notice_flag_created() {
	post_flagger_admin_notice('Flag created!');
}
function pf_notice_flag_deleted() {
	post_flagger_admin_notice('Flag sent to outter space!');
}
function pf_notice_flag_duplicated() {
	post_flagger_admin_notice('Opps that flag already exists!', 'error');
}

?>