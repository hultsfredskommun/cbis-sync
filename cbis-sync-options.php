<?php

add_action('admin_init', 'hk_cbis_options_init' );
add_action('admin_menu', 'hk_cbis_options_add_page');

// Init plugin options to white list our options
function hk_cbis_options_init(){
	register_setting( 'hk_cbis_options_options', 'hk_cbis', 'hk_cbis_options_validate' );
}

// Add menu page
function hk_cbis_options_add_page() {
	add_options_page('HK CBIS Settings', 'CBIS Settings', 'manage_options', 'hk_cbis_options', 'hk_cbis_options_do_page') ;
}



// Draw the menu page itself
function hk_cbis_options_do_page() {
	global $wpdb;

	?>
	<div class="wrap">
		<h2>Settings for CBIS Sync</h2>
		<form id="form_hk_options" method="post" action="options.php">


			<?php settings_fields('hk_cbis_options_options'); ?>
			<?php $options = get_option('hk_cbis'); 
			//echo "<br>update_categories  : " . $options["update_categories"];
			//echo "<br>enable_cron  : " . $options["enable_cron"];
			//echo "<br>update_products  : " . $options["update_products"];
			?>

			<?php submit_button(); ?>



			<?php //echo "<h3>DEBUG</h3>";
			//echo "<br>OPTIONS: <br>";
			//print_r( $options ); ?>

			
			<h3>CBIS sync</h3>
			<p><label for="hk_cbis[hk_cbis_key]">CBIS_API_KEY (i.e. JGFUTHL3N4MSCR7JRAH6PLZR2G3Y2XV1)</label><br/><input size="80" type="text" name="hk_cbis[hk_cbis_key]" value="<?php echo $options['hk_cbis_key']; ?>" /></p>
			<p><label for="hk_cbis[hk_cbis_author]">F&ouml;rfattare</label> <?php
			$args = array(
				'show_option_all'         => null, // string
				'show_option_none'        => null, // string
				'hide_if_only_one_author' => null, // string
				'orderby'                 => 'display_name',
				'order'                   => 'ASC',
				'include'                 => null, // string
				'exclude'                 => null, // string
				'multi'                   => false,
				'show'                    => 'display_name',
				'echo'                    => true,
				'selected'                => $options['hk_cbis_author'],
				'include_selected'        => false,
				'name'                    => "hk_cbis[hk_cbis_author]", // string
				'id'                      => "hk_cbis[hk_cbis_author]", // integer
				'class'                   => null, // string 
				'blog_id'                 => $GLOBALS['blog_id'],
				'who'                     => null // string
			);
			wp_dropdown_users( $args );
			?>
			
			<?php 
			// CRON
			if ( $options['hk_cbis_key'] != "" && $options['enable_cron'] == 1 && ! wp_next_scheduled( 'hk_cbis_hook' ) ) {
				wp_schedule_event( time(), 'daily', 'hk_cbis_hook' );
			}
			else if ( ($options['hk_cbis_key'] == "" || $options['enable_cron'] != 1) && wp_next_scheduled( 'hk_cbis_hook' ) ) {
				wp_clear_scheduled_hook( 'hk_cbis_hook' );
			}
			?>

			<h3>Cron</h3>
			<p><input type="checkbox" name="hk_cbis[enable_cron]" value="1"<?php checked( 1 == $options['enable_cron'] ); ?> /> <label for="hk_cbis[enable_cron]">Aktivera synkronisering.</label></p>
			<?php if (wp_next_scheduled( 'hk_cbis_hook' )) : ?>
			<p>N&auml;sta synkronisering <?php echo Date("Y-m-d H:i:s",wp_next_scheduled( 'hk_cbis_hook' )); ?></p>
			<?php else : ?>
			<p>Ingen automatisk synkronisering.</p>
			<?php endif; ?>

			<h3>Rensa upp</h3>
			<p><input type="checkbox" name="hk_cbis[cleanup]" value="1" /> <label for="hk_cbis[cleanup]">OBS! Detta tar bort allt som &auml;r synkat!</label></p>
			<?php
			if ( 1 == $options['cleanup'] ) {
				$querystr = "
					SELECT $wpdb->posts.* 
					FROM $wpdb->posts, $wpdb->postmeta
					WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
					AND $wpdb->postmeta.meta_key = 'cbis_product_id'  
				";

				$pageposts = $wpdb->get_results($querystr, OBJECT);
				foreach($pageposts as $post) {
					delete_post_meta($post->ID,"cbis_product_id");
					wp_delete_post($post->ID,true);
				}
				echo "NU &Auml;R DET RENT IGEN!!";
			}
			?>
			
			<?php 
			//JGFUTHL3N4MSCR7JRAH6PLZR2G3Y2XV1
			if ( 0 == $options['cleanup'] ) {
				define('CBIS_API_KEY', $options['hk_cbis_key']);


				$example = new CbisExample();
				
				// Print & Save categories
				if ($options["update_categories"])
				{
					echo '<h3>CBIS -> WP (' . count($categories) . ' stycken)</h3>';
					$categories = $example->getCategories(CbisExample::CBIS_LANGUAGE_SV);
					foreach ($categories as $value) {
							$args = array(
							'orderby'            => 'ID', 
							'order'              => 'ASC',
							'echo'               => 1,
							'selected'           => esc_attr( $options['cbis_cat'][$value->Id] ),
							'hierarchical'       => 1, 
							'name'               => 'hk_cbis[cbis_cat]['.$value->Id.']',
							'depth'              => 0,
							'taxonomy'           => 'category',
							'show_count'         => true,
							'hide_empty'         => false,
							'hide_if_empty'      => false,
							'show_option_all' => 'Ingen' );  
							wp_dropdown_categories($args);
							echo $value->Id . " " . $value->Name;
							echo '<br/>';
					}
				}
				else { ?>
					<h3>Kategorier</h3>
					<p><input type="checkbox" name="hk_cbis[update_categories]" value="1" /> <label for="hk_cbis[update_categories]">Skapa eller uppdatera kopplingar mellan CBIS kategorier och WordPress.</label></p>
					<?php foreach ($options["cbis_cat"] as $key => $value) { ?>
						<input type="hidden" name='hk_cbis[cbis_cat][<?php echo $key; ?>]' value='<?php echo $value; ?>'/>
					<?php } ?>
				<?php } ?>
				
				
				<h3>Produkter</h3>
				<p><input type="checkbox" name="hk_cbis[update_products]" value="1" /> <label for="hk_cbis[update_products]">Tvinga uppdatering produkter fr&aring;n CBIS till WordPress.</label></p>
				<?php 
				
				
				if ($options["update_products"] == 1)
				{
					$log = "Tvingad uppdatering: \n" . hk_cbis_update_products(true) . "\n\nF&ouml;rra uppdateringen som lyckades:\n";
				}

			// what to do with the rest?? How do we remove? Check all with custom_field cbis_product_id and compare...
			
			} // end if not checked cleanup
			
			
			// LOG
			
			?>
			<br><br>LOG: <br>
			<p><textarea name="hk_cbis[log]" cols=80 rows=15 ><?php echo $log; echo $options["log"];  ?></textarea></p>
			
			
			
			



			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

add_action( 'hk_cbis_hook', 'hk_cbis_update_products' );
function hk_cbis_update_products($returnlog = false) {

	global $wpdb;
	$options = get_option('hk_cbis');
	define('CBIS_API_KEY', $options['hk_cbis_key']);

	$example = new CbisExample();
	$wp_posts = array();
	
	$log = "Synkade senast " . Date("Y-m-d H:i:s") . "\n";

	// get all products
	$product_options = array(	
								'languageId' => CbisExample::CBIS_LANGUAGE_SV,
								'filter' => array(	'WithOccasionsOnly' => FALSE, 
													'ExcludeProductsNotInCurrentLanguage' => TRUE) 
													); 
	//print_r($product_options);
	$product_search = $example->getProducts($product_options);
	
	$log .= "Hittade " . count($product_search) . " CBIS produkter, synkar till wordpress \n";
	// abort if nothing found
	if (count($product_search) == 0) {
		$log .= "VARNING. Avslutade synkning utan ändringar " . Date("Y-m-d H:i:s") . "\n";

		$options = get_option('hk_cbis');
		$options["log"] = $log;
		$options["update_products"] = 0;
		update_option('hk_cbis', $options);
		if ($returnlog) 
			return $log;
		else
			return;

	}
	
	// else proceed syncing
	foreach ($product_search as $product) {
		$id = $product->Id;
		// just double check that not already added to wp_posts
		if (!array_key_exists($id, $wp_posts)) {
			$name = $product->Name;
			$content = "";
			$ingress = "";
			
			// get category or categories
			$wp_cat = array();
			if (!empty($product->Categories)) {								
				//print_r($product->Categories->Category);
				if (is_object($product->Categories->Category)) {
					$cat = $product->Categories->Category;
					if (array_key_exists($cat->Id, $options["cbis_cat"]) && $options["cbis_cat"][$cat->Id] != 0) {
						$wp_cat[] = $options["cbis_cat"][$cat->Id];
					}
				}
				else {
					if (!empty($product->Categories->Category)) : foreach ($product->Categories->Category as $cat) {
						if (array_key_exists($cat->Id, $options["cbis_cat"]) && $options["cbis_cat"][$cat->Id] != 0) {
							$wp_cat[] = $options["cbis_cat"][$cat->Id];
						}
					} endif;
				}
			}
		
			// get attributes and add to insert array if mapping category is found
			if (!empty($wp_cat)) {
				// get attributes
				
				foreach ($product->Attributes->AttributeData as $data) {
					//echo "data(" . $data->AttributeId . "): " . print_r($data->Value,true) . "<br>";
					switch($data->AttributeId) {
						case '101': //ingress
							$ingress = $data->Value->Data;
							break;
						case '102': //content
							$content = $data->Value->Data;
							break;
						case '115': //image
							if (count($data->Value->MediaList->MediaObject) > 1) {
								$imageurl = $data->Value->MediaList->MediaObject[0]->Url;
								$imagedescr = $data->Value->MediaList->MediaObject[0]->Description;
							}
							elseif (count($data->Value->MediaList->MediaObject) == 1) {
								$imageurl = $data->Value->MediaList->MediaObject->Url;
								$imagedescr = $data->Value->MediaList->MediaObject->Description;
							}
								
							break;
					}
					//Id
					//Name
					//Image
					//Excerpt (101)
					//Content (102)
					//Status
					//PublishDate
					//ExpirationDate
					//Address
					//GPS (113 & 114)
					//Contact

				}
				if ($ingress != "")
					$content = "<p class='ingress'>" . $ingress . "</p>" . $content . "";
				
				if ($imageurl != "") 
					$content = "<img src='$imageurl&width=540&height=315&fitaspect=1' alt='$description'/>" . $content;
					
				$wp_posts[$id] = array("name" => $name, "content" => $content, "category" => $wp_cat);
			}
		}
		
	}
	
	// end search products

	// insert posts
	$inserted = 0;
	$updated = 0;
	$unique = uniqid();
	$log .=  "L&auml;gg till eller uppdatera " . count($wp_posts) . " poster.\n";
	foreach ($wp_posts as $id => $cbispost) {
		$querystr = "
			SELECT $wpdb->posts.* 
			FROM $wpdb->posts, $wpdb->postmeta
			WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
			AND $wpdb->postmeta.meta_key = 'cbis_product_id' 
			AND $wpdb->postmeta.meta_value = '$id' 
		";

		$pageposts = $wpdb->get_results($querystr, OBJECT);

		$newpost = array(
			'comment_status' => 'closed', // 'closed' means no comments.
			'post_author'    => $options['hk_cbis_author'], // which author to assign post
			'post_content'   => $cbispost["content"], //The full text of the post.
			'post_status'    => 'publish', //Set the status of the new post.
			'post_title'     => $cbispost["name"], //The title of your post.
			'post_type'      => 'post', //You may want to insert a regular post, page, link, a menu item or some custom post type
		); 
		// if post exist, do update
		if ($pageposts) {
			$newpost['ID'] = $pageposts[0]->ID;  //Are you updating an existing post?
			$updated++;
		}
		else {
			$inserted++;
		}

		// insert or update post
		$wp_id = wp_insert_post($newpost, true);

		if (!is_wp_error($wp_id)) {				
			// set categories
			wp_set_post_terms($wp_id, $cbispost["category"], "category");

			// set custom fields
			add_post_meta($wp_id, 'cbis_product_id', $id, true) or update_post_meta($wp_id, 'cbis_product_id', $id);
			add_post_meta($wp_id, 'cbis_product_unique', $unique, true) or update_post_meta($wp_id, 'cbis_product_unique', $unique);
		}
		else
			$log .=  "is_error?";
		$log .=  "$inserted nya poster och $updated uppdaterade. (id: " . $wp_id . ")\n";

	} // end foreach insert posts
	$log .=  "Nu har det lagts till eller uppdaterats poster.\n";
	
	$log .=  "$inserted nya poster och $updated uppdaterade.\n";

	
	// clean up old
	$querystr = "
		SELECT $wpdb->posts.* 
		FROM $wpdb->posts, $wpdb->postmeta
		WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
		AND $wpdb->postmeta.meta_key = 'cbis_product_unique'  
		AND $wpdb->postmeta.meta_value != '$unique'  
		AND $wpdb->postmeta.meta_value != ''
	";

	$pageposts = $wpdb->get_results($querystr, OBJECT);
	$count = 0;
	foreach($pageposts as $post) {
		$count++;
		delete_post_meta($post->ID,"cbis_product_id");
		wp_delete_post($post->ID,true);
	}
	$log .=  "Nu &auml;r $count gamla poster som inte inneh&ouml;ll $unique borta.\n";
	
	$log .= "Avslutade synkning " . Date("Y-m-d H:i:s") . "\n";

	$options = get_option('hk_cbis');
	$options["log"] = $log;
	$options["update_products"] = 0;
	update_option('hk_cbis', $options);
	if ($returnlog) 
		return $log;
	else
		return;

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