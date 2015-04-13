<?php
//Our class extends the WP_List_Table class, so we need to make sure that it's there
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

/**
 * Class PF_Flags_Table
 */
class PF_Flags_Table extends WP_List_Table
{

    function __construct()
    {
        global $status, $page;

        //Set parent defaults
        parent::__construct(array(
            'singular' => 'flag',     //singular name of the listed records
            'plural' => 'flags',    //plural name of the listed records
            'ajax' => false        //does this table support ajax?
        ));

    }

    function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'name':
            case 'slug':
                return $item[$column_name];
            default:
                return print_r($item, true); //Show the whole array for troubleshooting purposes
        }
    }

    function column_name($item)
    {
        //Build row actions
        $actions = array(
            'edit' => sprintf('<a href="?page=%s&action=%s&flag=%s">' . __( 'Edit', 'post-flagger' ) . '</a>', $_REQUEST['page'], 'edit', $item['id']),
            'delete' => sprintf('<a href="?page=%s&action=%s&flag=%s">' . __( 'Edit', 'post-flagger' ) . '</a>', $_REQUEST['page'], 'delete', $item['id']),
        );

        //Return the title contents
        return sprintf('%1$s %2$s',
            /*$1%s*/
            $item['name'],
            /*$2%s*/
            $this->row_actions($actions)
        );
    }

    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/
            $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/
            $item['id']                //The value of the checkbox should be the record's id
        );
    }

    function column_shortcode($item)
    {
        return sprintf('[flag slug="%1$s"]',
            /*$1%s*/
            $item['slug']
        );
    }

    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
            'name' => __( 'Flag Name', 'post-flagger' ),
            'slug' => 'Slug',
            'shortcode' => 'Shortcode'
        );
        return $columns;
    }


    function get_sortable_columns()
    {
        $sortable_columns = array(//'name'     => array('name',false),     //true means it's already sorted
        );
        return $sortable_columns;
    }

    function get_bulk_actions()
    {
        $actions = array(
            'delete' => __( 'Delete', 'post-flagger' )
        );
        return $actions;
    }

    function process_bulk_action()
    {
        //Detect when a bulk action is being triggered...
        if ('delete' === $this->current_action()) {
            // Get flags and delete them
            foreach ($_GET['flag'] as $flag) {
                post_flagger_delete_flag($flag);
            }

            //Redirects to flags
            wp_redirect(admin_url('options-general.php?page='.$_GET['page'].'&m=2'));
            exit;
        }

    }


    function prepare_items()
    {
        global $wpdb; //This is used only if making any database queries

        $per_page = 10;


        /**
         * REQUIRED. Now we need to define our column headers. This includes a complete
         * array of columns to be displayed (slugs & titles), a list of columns
         * to keep hidden, and a list of columns that are sortable. Each of these
         * can be defined in another method (as we've done here) before being
         * used to build the value for our _column_headers property.
         */
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();


        /**
         * REQUIRED. Finally, we build an array to be used by the class for column
         * headers. The $this->_column_headers property takes an array which contains
         * 3 other arrays. One for all columns, one for hidden columns, and one
         * for sortable columns.
         */
        $this->_column_headers = array($columns, $hidden, $sortable);

        /**
         * Optional. You can handle your bulk actions however you see fit. In this
         * case, we'll handle them within our package just to keep things clean.
         */
        $this->process_bulk_action();

        /**
         * REQUIRED. Get the database data as an array
         */
        $data = post_flagger_get_flags('ARRAY_A');

        /**
         * REQUIRED for pagination. Let's figure out what page the user is currently
         * looking at. We'll need this later, so you should always include it in
         * your own package classes.
         */
        $current_page = $this->get_pagenum();

        /**
         * REQUIRED for pagination. Let's check how many items are in our data array.
         * In real-world use, this would be the total number of items in your database,
         * without filtering. We'll need this later, so you should always include it
         * in your own package classes.
         */
        $total_items = count($data);


        /**
         * The WP_List_Table class does not handle pagination for us, so we need
         * to ensure that the data is trimmed to only the current page. We can use
         * array_slice() to
         */
        $data = array_slice($data, (($current_page - 1) * $per_page), $per_page);


        /**
         * REQUIRED. Now we can add our *sorted* data to the items property, where
         * it can be used by the rest of the class.
         */
        $this->items = $data;


        /**
         * REQUIRED. We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args(array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page' => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items / $per_page)   //WE have to calculate the total number of pages
        ));
    }
}