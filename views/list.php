<?php
//Create an instance of our package class...
$testListTable = new PF_Flags_Table();
//Fetch, prepare, sort, and filter our data...
$testListTable->prepare_items();
?>

<h2><?php echo __( 'My Flags', 'post-flagger' ).' '.pf_add_new_button(); ?></h2>

<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
<form id="flags-filter" method="get">
	<!-- For plugins, we also need to ensure that the form posts back to our current page -->
    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
	<!-- Show my WP_List_Table -->
	<?php $testListTable->display(); ?>
</form>