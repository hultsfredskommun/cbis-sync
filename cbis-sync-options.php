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
		<h1>Settings for CBIS Sync</h1>
		<form id="form_hk_options" method="post" action="options.php">
			<?php settings_fields('hk_cbis_options_options'); ?>
			<?php $options = get_option('hk_cbis'); ?>


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
            
            //Print categories
            $categories = $example->getCategories();
            echo '<h1>CATEGORIES (' . count($categories) . ')</h1>';
            print_r($categories);
            
            //Get all products
            $products = $example->getProducts();
            echo '<h1>PRODUCTS (' . count($products) . ')</h1>';
            print_r($products);
            
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