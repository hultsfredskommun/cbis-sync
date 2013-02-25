<?php

add_action('admin_init', 'hk_cbis_options_init' );
add_action('admin_menu', 'hk_cbis_options_add_page');

// Init plugin options to white list our options
function hk_cbis_options_init(){
	register_setting( 'hk_cbis_options_options', 'hk_cbis', 'hk_cbis_options_validate' );
}

// Add menu page
function hk_cbis_options_add_page() {
	//add_menu_page('HK CBIS Settings', 'CBIS settings', 'manage_options', 'administrator', __FILE__, 'hk_cbis_options_do_page');
	add_options_page('HK CBIS Settings', 'CBIS Settings', 'manage_options', 'hk_cbis_options', 'hk_cbis_options_do_page') ;
}

// Draw the menu page itself
function hk_cbis_options_do_page() {
	?>
	<div class="wrap">
		<h2>Settings for CBIS Sync</h2>
		<form id="form_hk_options" method="post" action="options.php">


			<?php settings_fields('hk_cbis_options_options'); ?>
			<?php $options = get_option('hk_cbis'); ?>

			<?php submit_button(); ?>


			<p><input type="text" name="hk_cbis[test]" value="<?php echo $options['test']; ?>" /></p>


			<?php print_r( get_option('hk_cbis') ); ?>

			<h3>Kategorier och menyer</h3>
			
			<p><label for="hk_cbis[startpage_cat]">Välj kategori som är startsida.</label><br/>
			<?php 
				$args = array(
					'orderby'            => 'ID', 
					'order'              => 'ASC',
					'echo'               => 1,
					'selected'           => esc_attr( $options["startpage_cat"] ),
					'hierarchical'       => 1, 
					'name'               => 'hk_cbis[startpage_cat]',
					'depth'              => 0,
					'taxonomy'           => 'category',
					'show_count'         => true,
					'hide_empty'         => false,
					'hide_if_empty'      => false,
					'show_option_all' => 'Ingen' );  
				wp_dropdown_categories( $args ); 
			?>
			</p>

			
			<h3>CBIS sync</h3>
			<p><input type="checkbox" name="hk_cbis[enable_cron]" value="1"<?php checked( 1 == $options['enable_cron'] ); ?> /> <label for="hk_cbis[enable_cron]">Aktivera synkronisering.</label></p>

			<p><label for="hk_cbis[hk_cbis_rss]">Rss to sync CBIS. </label><br/><input size="80" type="text" name="hk_cbis[hk_cbis_rss]" value="<?php echo $options['hk_cbis_rss']; ?>" /></p>
			

			<h3>Cron</h3>
			<p>Last run <?php echo Date("Y-m-d H:i:s",$options["hk_cbis_sync_time"]); ?>: <br><?php echo $options["hk_cbis_sync_log"]; ?></p>

			
			//JGFUTHL3N4MSCR7JRAH6PLZR2G3Y2XV1
			<?php 
			define('CBIS_API_KEY', 'JGFUTHL3N4MSCR7JRAH6PLZR2G3Y2XV1');

            $example = new CbisExample();
            
            // Print & Save categories
	        add_action('hk_save_cat', 'hk_save_categories');
            $categories = $example->getCategories();
            echo '<h1>CATEGORIES (' . count($categories) . ')</h1>';
	        // function hk_save_categories() {
	        //     $name 	= $value->Name;
	        //     $id 	= $value->Id;
	        //     $event_category = array(
	        // 	get_cat_ID($id),
	        // 	get_cat_ID($name));
	        // 	wp_set_post_categories($post_ID, $event_category);
	        // }
	        add_action('hk_save_cat', 'hk_save_categories');
            foreach ($categories as $value) { ?>

	            	<?php echo $value->Id . " " . $value->Name; ?>
					<?php 
					$args = array(
					'orderby'            => 'ID', 
					'order'              => 'ASC',
					'echo'               => 1,
					'selected'           => esc_attr( $options['cbis_cat_'.$value->Id] ),
					'hierarchical'       => 1, 
					'name'               => 'hk_cbis[cbis_cat_'.$value->Id.']',
					'depth'              => 0,
					'taxonomy'           => 'category',
					'show_count'         => true,
					'hide_empty'         => false,
					'hide_if_empty'      => false,
					'show_option_all' => 'Ingen' );  
					wp_dropdown_categories($args);
					echo '<br/>' ?>
				
			<?php 
			// $hk_id = count($categories);
			// echo $hk_id[16467];
            }
            // print_r($categories);


            // add_filter('edited_terms', 'hk_category_update');
            // function hk_category_update($term_id) {
            // 	if($_REQUEST['taxonomy'] == 'category'):
            // 		$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
            // 		$tag_extra_fields[$term_id]['my_title'] = $_REQUEST['submit'];
            // 		update_option(MY_CATEGORY_FIELDS, $tag_extra_fields);
            // 	endif;
            // }

            //Get all products
            // $products = $example->getProducts();
            // echo '<h1>PRODUCTS (' . count($products) . ')</h1>';
            // print_r($products);
            
            //Search products
            $example_options = array('categoryId' => 1234, 'filter' => array('WithOccasionsOnly' => TRUE, 'ExcludeProductsNotInCurrentLanguage' => TRUE));
            $product_search = $example->getProducts($example_options);
            echo '<h1>PRODUCT SEARCH (' . count($product_search) . ')</h1>';
            print_r($product_search);
			?>
			



			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function hk_cbis_options_validate($input) {
	// Our first value is either 0 or 1
	//$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
	
	// Say our second option must be safe text with no HTML tags
	//$input['sometext'] =  wp_filter_nohtml_kses($input['sometext']);
	
	return $input;
}

?>