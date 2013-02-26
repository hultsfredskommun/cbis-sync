<?php
/*
Plugin Name: CBIS Sync
Plugin URI: http://wordpress.org/extend/plugins/cbis-sync/
Description: Sync selected information from CBIS database to Wordpress posts.
Author: Jonas Hjalmarsson, Hultsfreds kommun
Version: 0.9
Author URI: http://www.hultsfred.se
*/

/*  Copyright 2013 Jonas Hjalmarsson (email: jonas.hjalmarsson@hultsfred.se)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/*
TODO

Sync CBIS products to wp posts and also set in which WP-category the posts should be created.

1. i.e. Products in the CBIS-category "Galleri och konst" should be placed as posts in WP-category 
   "Kultur (under Kultur & fritid)"
2. Create sync cron job to be able to sync ever day or every day, (also sync every time you press save 
   on option page)
3. Create the actual posts with title and content and keep record of what is synced by setting custom 
   field cbis_id to the products "Id".
4. Add button to wipe all posts that are created by CBIS sync, i.e. all posts that have custom_field 
   cbis_id set.
5. Also sync 
  * attached images
  * GPS-position
  * ExpirationDate
  * Granskad mail?
  
CATEGORY
Array ( 
	[16467] => stdClass Object ( 
		[Id] => 16467 
		[OrganizationId] => 15774 
		[Name] => Boende 
		[DefaultTemplateId] => 83 
		[Status] => Active 
		[ParentCategoryId] => 16466 
		[DisplayOrder] => 2 
		[Icon] => 
		[Parent] => 0 
		[Children] => 
			Array ( [0] => 16544 [1] => 16545 [2] => 16546 [3] => 16547 [4] => 16548 [5] => 16549 [6] => 16550 [7] => 16551 [8] => 16552 ) 
	) 
	[16544] => stdClass Object ( 
		[Id] => 16544 
		[OrganizationId] => 15774 
		[Name] => Hotell och pensionat 
		[DefaultTemplateId] => 83 
		[Status] => Active 
		[ParentCategoryId] => 16467 
		[DisplayOrder] => 3 
		[Icon] => 
		[Parent] => 16467 
		[Children] => Array ( ) 
	) 

	
PRODUCTS
Array ( 
	[0] => stdClass Object ( 
		[Id] => 303753 
		[SystemName] => Tveta kyrka 
		[TrackingPixelUrl] => http://tracking.info.citybreak.com/tracking/pixel.gif?o=15774&c=237&p=303753&l=2&t=1 
		[UrlName] => Tveta_kyrka_303753 
		[Name] => Tveta Church 
		[ForeignProductId] => 0 
		[CitybreakPackageId] => 0 
		[OrganizationId] => 15774 
		[Version] => 16 
		[TemplateId] => 76 
		[Image] => stdClass Object ( 
			[MediaId] => 6991018 
			[MediaType] => Image 
			[Url] => http://images.citybreak.com/image.aspx?ImageId=1359349 
			[Width] => 4288 
			[Height] => 2848 
			[ProducedBy] => 
			[CopyrightBy] => 
			[ImageType] => Image ) 
		[Status] => Active 
		[PublishedDate] => 2013-02-15T12:07:08.07 
		[RevisionDate] => 2012-11-02T00:00:00 
		[ExpirationDate] => 0001-01-01T00:00:00 
		[Relevance] => Local 
		[ParentProductId] => 0 
		[ProductType] => Product 
		[IsHighlight] => 
		[Attributes] => stdClass Object ( 
			[AttributeData] => Array ( 
				[0] => stdClass Object ( 
					[Id] => 15916865 
					[AttributeId] => 99 
					[MetaType] => String 
					[Value] => stdClass Object ( 
						[Data] => Tveta Church ) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 11 
					[Language] => 2 ) 
				[1] => stdClass Object ( 
					[Id] => 15916866 
					[AttributeId] => 101 
					[MetaType] => String 
					[Value] => stdClass Object ( 
						[Data] => Today Tveta Church is one of the most popular wedding churches. ) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 11 
					[Language] => 2 ) 
				[2] => stdClass Object ( 
					[Id] => 15916867 
					[AttributeId] => 102 
					[MetaType] => String 
					[Value] => stdClass Object ( 
						[Data] => A famous church from the medieval period, in the 1100s. Most likely a sacrifice church, for the god "Oden" ("Woden"), was built on this place in heathen days. A wood sculpture from the 14th century is one of the main attractions in this church. While you are here don't miss the neighbouring charming village of Sinnerstad. ) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 11 
					[Language] => 2 ) 
				[3] => stdClass Object ( 
					[Id] => 15916870 
					[AttributeId] => 103 
					[MetaType] => String 
					[Value] => stdClass Object ( 
						[Data] => Location: Tveta, south of Målilla ) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 11 
					[Language] => 2 ) 
				[4] => stdClass Object ( 
					[Id] => 15916869 
					[AttributeId] => 107 
					[MetaType] => String 
					[Value] => stdClass Object ( 
						[Data] => (0)495-230 21 ) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 11 
					[Language] => 0 ) 
				[5] => stdClass Object ( 
					[Id] => 8113562 
					[AttributeId] => 113 
					[MetaType] => Double 
					[Value] => stdClass Object ( 
						[Data] => 57.324575071727 ) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 5 
					[Language] => 0 ) 
				[6] => stdClass Object ( 
					[Id] => 8113563 
					[AttributeId] => 114 
					[MetaType] => Double 
					[Value] => stdClass Object ( 
						[Data] => 15.811901092529 ) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 5 
					[Language] => 0 ) 
				[7] => stdClass Object ( 
					[Id] => 15731472 
					[AttributeId] => 115 
					[MetaType] => Media 
					[Value] => stdClass Object ( 
						[MediaList] => stdClass Object ( 
							[MediaObject] => Array ( 
								[0] => stdClass Object ( 
									[MediaId] => 6991018 
									[MediaType] => Image 
									[Url] => http://images.citybreak.com/image.aspx?ImageId=1359349 
									[Width] => 4288 
									[Height] => 2848 
									[Description] => Tveta kyrka med metertjocka väggar från 1100-talet är den mest anlitade vigselkyrkan i kontraktet. Tveta kyrka är formodligen en av de första kyrkorna i östra Småland. 
									[Keywords] => 
									[ProducedBy] => 
									[CopyrightBy] => 
									[ImageType] => Image ) 
								[1] => stdClass Object ( 
									[MediaId] => 4452020 
									[MediaType] => Image 
									[Url] => http://images.citybreak.com/image.aspx?ImageId=1087598 
									[Width] => 1181 
									[Height] => 569 
									[Description] => 
									[Keywords] => 
									[ProducedBy] => 
									[CopyrightBy] => 
									[ImageType] => Image ) 
							) 
						) 
					) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 10 
					[Language] => 0 ) 
				[8] => stdClass Object ( 
					[Id] => 8081920 
					[AttributeId] => 120 
					[MetaType] => String 
					[Value] => stdClass Object ( 
						[Data] => 57082 ) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 1 
					[Language] => 0 ) 
				[9] => stdClass Object ( 
					[Id] => 8081921 
					[AttributeId] => 121 
					[MetaType] => String 
					[Value] => stdClass Object ( 
						[Data] => Mörlunda ) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 1 
					[Language] => 0 ) 
				[10] => stdClass Object ( 
					[Id] => 17304815 
					[AttributeId] => 155 
					[MetaType] => MultiAttribute 
					[Value] => stdClass Object ( 
						[Values] => stdClass Object ( 
							[MultiAttributeObject] => Array ( 
								[0] => stdClass Object ( 
									[Id] => 0 
									[AttributeId] => 0 
									[ProductId] => 0 
									[OrganizationId] => 0 
									[MultiAttributeId] => 8 
									[MetaType] => Boolean 
									[Value] => stdClass Object ( 
										[Data] => ) 
									[Language] => 0 ) 
								[1] => stdClass Object ( 
									[Id] => 0 
									[AttributeId] => 0 
									[ProductId] => 0 
									[OrganizationId] => 0 
									[MultiAttributeId] => 1872 
									[MetaType] => Boolean 
									[Value] => stdClass Object ( 
										[Data] => ) 
									[Language] => 0 ) 
								[2] => stdClass Object ( 
									[Id] => 0 
									[AttributeId] => 0 
									[ProductId] => 0 
									[OrganizationId] => 0 
									[MultiAttributeId] => 1873 
									[MetaType] => Boolean 
									[Value] => stdClass Object ( 
										[Data] => ) 
									[Language] => 0 ) 
								[3] => stdClass Object ( 
									[Id] => 0 
									[AttributeId] => 0 
									[ProductId] => 0 
									[OrganizationId] => 0 
									[MultiAttributeId] => 1870 
									[MetaType] => 
									Boolean [Value] => 
									stdClass Object ( 
										[Data] => ) 
									[Language] => 0 ) 
								[4] => stdClass Object ( 
									[Id] => 0 
									[AttributeId] => 0 
									[ProductId] => 0 
									[OrganizationId] => 0 
									[MultiAttributeId] => 1871 
									[MetaType] => Boolean 
									[Value] => stdClass Object ( 
										[Data] => ) 
									[Language] => 0 ) 
							) 
						) 
					) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 16 
					[Language] => 0 ) 
				[11] => stdClass Object ( 
					[Id] => 15916871 
					[AttributeId] => 297 
					[MetaType] => Int 
					[Value] => stdClass Object ( 
						[Data] => 11 ) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 11 
					[Language] => 0 ) 
				[12] => stdClass Object ( 
					[Id] => 17304820 
					[AttributeId] => 550 
					[MetaType] => Boolean 
					[Value] => stdClass Object ( 
						[Data] => 1 ) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 16 
					[Language] => 0 ) 
				[13] => stdClass Object ( 
					[Id] => 15916868 
					[AttributeId] => 556 
					[MetaType] => String 
					[Value] => stdClass Object ( 
						[Data] => 0046 ) 
					[ProductId] => 303753 
					[OrganizationId] => 15774 
					[Version] => 11 
					[Language] => 0 ) 
			) 
		) 
		[Categories] => stdClass Object ( 
			[Category] => stdClass Object ( 
				[Id] => 16581 
				[OrganizationId] => 15774 
				[Name] => Kyrkor 
				[DefaultTemplateId] => 0 
				[Status] => Active 
				[ParentCategoryId] => 16574 
				[DisplayOrder] => 40 
				[Icon] => ) 
		) 
		[GeoNode] => stdClass Object ( 
			[Id] => 67085 
			[Name] => Hultsfred 
			[ParentId] => 67084 
			[OrgId] => 15774 
			[Type] => Undefined 
			[LeftValue] => 2 
			[RightValue] => 3 
			[CityCenterLatitude] => 
			[CityCenterLongitude] => 
			[CityCenterRadius] => ) 
		[Occasions] => stdClass Object ( ) 
		[SupplierId] => 
		[POIs] => stdClass Object ( 
			[POIs] => stdClass Object ( ) ) 
		[Duration] => 0 
		[ForeignProductIds] => stdClass Object ( ) 
		[LanguageId] => 2 
	)
)	
*/

include( plugin_dir_path( __FILE__ ) . 'cbis-sync-options.php');

/*
 * CBIS RSS CRONJOB
 */
function hk_cbis() {
	$options = get_option('hk_theme');
	$hk_cbis_check_time = time();
	$options["hk_cbis_check_time"] = $hk_cbis_check_time;
		
	$log = "No rss is checked.";
	$return = "";
	
	if ($options['hk_cbis_rss'] != "") :
		$log = "Checked rss " . date("Y-m-d H:i:s", strtotime("now")) . ".";
		$url = $options['hk_cbis_rss'];
		$rss =  simplexml_load_file($url);
		$has_new = "";
		$numjobs = count($rss->Assignments->Assignment);
		if ($numjobs > 0 ) {
			$log .= "<br>Found " . count($rss->Assignments->Assignment) . " available jobs in RSS.";
			
			$count = 0;
			foreach ($rss->Assignments->Assignment as $item)
			{
				$return .= "";

			} 
		}	
	else 
		$log .= "L&auml;gg till en rssl&auml;nk f&ouml;r att aktivera.";
	endif;
	$options["hk_cbis_log"] = $log;

	update_option("hk_theme", $options);
}
add_action("hk_cbis_event", "hk_cbis");
 

 // add special cron interval to wp schedules
function hk_cbis_add_scheduled_interval($schedules) {
 
    $schedules['hk_cbis_schedule'] = array('interval'=>900, 'display'=>'cbis cron (15 minutes)');
 
    return $schedules;
}
add_filter('cron_schedules', 'hk_cbis_add_scheduled_interval');


function hk_cbis_schedule_activation() {
	$options = get_option('hk_cbis');
	wp_clear_scheduled_hook('hk_cbis_event');
	if ($options['hk_cbis_rss'] != "") {
		if ( !wp_next_scheduled( 'hk_cbis_event' ) ) {
			wp_schedule_event( time(), 'hk_cbis_schedule', 'hk_cbis_event');
		}
	}
	else
	{
		if ( wp_next_scheduled( 'hk_cbis_event' ) ) {
			wp_clear_scheduled_hook('hk_cbis_event');
		}
	}
}
add_action('wp', 'hk_cbis_schedule_activation');




/**
 * Helper class that manages the API key for the CBIS API.
 *
 * @package cbis_product
 */
class CbisClient extends SoapClient {
    
    /**
     * Constructor for CbisClient
     * 
     * @param string $service
     * @param array $options 
     */
    function __construct($service, $options) {
        $url = 'http://api.info.citybreak.com';

        $this->service = $service;
        $this->apiKey = CBIS_API_KEY;
        $wsdl = sprintf('%s/%s.asmx?WSDL', $url, $service);
        
        // Enable logging of last request
        $options['trace'] = 1;

        try {
            parent::__construct($wsdl, $options);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    /**
     * Call the CBIS api
     * 
     * @param string $method
     * @param array $arguments
     * @return array 
     */
    public function __call($method, $arguments) {
        if (empty($arguments)) {
            $arguments[] = array('apiKey' => $this->apiKey);
        } else {
            $arguments[0] = array_merge(array('apiKey' => $this->apiKey), $arguments[0]);
        }

        $result = NULL;
        try {
            $result = parent::__call($method, $arguments);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
        return $result;
    }
}



class CbisExample {
    // Swedish is defined as 1 in CBIS   
    const CBIS_LANGUAGE_SV = 1;
    // English is defined as 2 in CBIS   
    const CBIS_LANGUAGE_EN = 2;

    /**
     * Returns an instance of the CbisClient.
     *
     * @param string $service
     *  The service that is to be accessed.
     * @return CbisClient
     */
    private function client($service, $options = array()) {
        return new CbisClient($service, array('encoding' => 'UTF-8') + $options);
    }

    /**
     * Normalizes results into arrays. This is necessary because the deserialized
     * xml from the soap client is inconsistent when it comes to collections of
     * elements that contain 1 versus 2 or more elements.
     *
     *    <a><b></b><a> => a->b == object
     *    <a><b></b><b></b><a> => a->b == array(object, object)
     *
     * @param mixed $v
     * @return array
     */
    private function cbis_array($v) {
        if (!is_array($v)) {
            $a = (array) $v;
            if (is_object($v) && empty($a)) {
                $v = array();
            } else {
                $v = array($v);
            }
        }
        return $v;
    }

    /**
     * An alternative to array_merge_recursive
     *
     * @return array
     */
    private function mergeRecursive() {
        $args = func_get_args();
        $a = array_shift($args);

        foreach ($args as $b) {
            foreach ($b as $key => $val) {
                if (is_array($val) && is_array($a[$key])) {
                    $b[$key] = $this->mergeRecursive($a[$key], $val);
                }
            }
            $a = array_merge($a, $b);
        }

        return $a;
    }

    /**
     * Fetches a list of categories from CBIS.
     *
     * @return array
     */
    public function getCategories($language = CbisExample::CBIS_LANGUAGE_EN) {
        // Consider caching the result here for faster access
        $client = $this->client('Categories');
        $categories = array();
        $result = $client->ListAll(array(
            'languageId' => $language,
            'parentCategoryId' => 0,
                ));
        if ($result) {
            foreach ($this->cbis_array($result->ListAllResult->Nodes->TreeNodeOfCategory) as $root) {
                $root->Data->Parent = 0;
                $this->addCategory($categories, $root);
            }
        }

        return $categories;
    }

    /**
     * Flattens the category tree from CBIS.
     *
     * @param array $categories
     * @param array $category
     * @return void
     */
    private function addCategory(&$categories, $category) {
        $categories[$category->Data->Id] = $category->Data;
        $category->Data->Children = array();
        if (isset($category->Children->TreeNodeOfCategory)) {
            foreach ($this->cbis_array($category->Children->TreeNodeOfCategory) as $child) {
                if ($child) {
                    $categories[$category->Data->Id]->Children[] = $child->Data->Id;
                    $categories[$child->Data->Id] = $child->Data;
                    $child->Data->Parent = $category->Data->Id;
                    $this->addCategory($categories, $child);
                }
            }
        }
    }

    /**
     * Gets products from CBIS.
     *
     * @param array $options
     *  The query options to send to CBIS.
     * @return array
     *  The raw product data. 
     */
    public function getProducts($options = array()) {
        $defaults = array(
            'languageId' => CbisExample::CBIS_LANGUAGE_EN,
            'categoryId' => 0,
            'templateId' => 0,
            'pageOffset' => 0,
            'itemsPerPage' => 0,
            'filter' => array(
                'Highlights' => FALSE,
                'WithOccasionsOnly' => FALSE,
                'IncludeArchivedProducts' => FALSE,
                'IncludeInactiveProducts' => FALSE,
                'BookableProductsFirst' => FALSE,
                'ExcludeProductsWhereNameNotInCurrentLanguage' => FALSE,
                'ExcludeProductsNotInCurrentLanguage' => FALSE,
                'ExcludeProductsWithoutOccasions' => FALSE,
                'OrderBy' => 'None',
                'SortOrder' => 'None',
                'RandomSortSeed' => 0,
                'SubCategoryId' => 0,
            ),
        );

        $options = $this->mergeRecursive($defaults, $options);
        $client = $this->client('Products');
		$result = $client->ListAll($options); // Consider caching this result for better performance
        $products = array();
        if (!empty($result->ListAllResult->Items->Product)) {
            $products = $this->cbis_array($result->ListAllResult->Items->Product);
            foreach ($products as $product) {
                $product->LanguageId = $options['languageId'];
                $newproducts[] = $product;
            }
        }
        return $newproducts;
    }

}
?>