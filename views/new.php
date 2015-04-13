<h2><?php echo __( 'Add New Flag', 'post-flagger' ) ?></h2>

<div id="poststuff">
	<div id="post-body" class="metabox-holder columns-2">
		<div id="post-body-content">

			<form action="admin-post.php" method="post" name="edit-form">
				<input type="hidden" name="action" value="pf_create_flag"/>

				<div class="pf-form-field primary">
					<input type="text" name="name" id="name" placeholder="<?php echo __( 'Add a flag name', 'post-flagger' ) ?>"/>
				</div>
				<div class="pf-form-field">
					<label for="slug">Slug</label>
					<input type="text" name="slug" id="slug" placeholder="<?php echo __( 'e.g. view', 'post-flagger' ) ?>"/>
				</div>
				<div class="pf-form-field">
					<label for="unflagged_code"><?php echo __( 'Unflagged Code', 'post-flagger' ) ?></label>
					<textarea name="unflagged_code" id="unflagged_code" cols="30" rows="5"></textarea>
                    <p class="legend">
                        <?php echo __( 'Use html whithout quotes. e.g.', 'post-flagger' ) ?> <code>&lt;img src=star.png /&gt;</code>
                    </p>
				</div>
				<div class="pf-form-field">
					<label for="flagged_code"><?php echo __( 'Flagged Code', 'post-flagger' ) ?></label>
					<textarea name="flagged_code" id="flagged_code" cols="30" rows="5"></textarea>
                    <p class="legend">
                        <?php echo __( 'Use html whithout quotes. e.g.', 'post-flagger' ) ?> <code>&lt;img src=star.png /&gt;</code>
                    </p>
				</div>
				<div>
					<a class="button button-large" href="options-general.php?page=post-flagger-options"><?php echo __( 'Cancel', 'post-flagger' ) ?></a>
					<input type="submit" class="button button-primary button-large" value="<?php echo __( 'Create Flag', 'post-flagger' ) ?>"/>
				</div>
			</form>

		</div>
	</div>
</div>

