<?php
/**
 * WDS_XML_Sitemap::generate_sitemap()
 * inspired by WordPress SEO by Joost de Valk (http://yoast.com/wordpress/seo/).
 */

/**
 * Infinite SEO pages optimization classes
 *
 * @package Infinite SEO
 * @since 1.3
 */

class WDS_XML_Sitemap {

	private $_data;
	private $_db;

	private $_items;

	public function __construct () {
		global $wpdb, $wds_options;
		if (!$wds_options['sitemap']) return false;

		$data = get_option('wds_sitemap_options');
		if (!@$data['sitemappath'] || !@$data['sitemappath']) return false;
		$this->_data = $data;
		$this->_db = $wpdb;

		$this->_init_items();

		// Refactor this!
		$this->generate_sitemap();
	}

	public function generate_sitemap () {
		global $wds_options;

		//this can take a whole lot of time on big blogs
    	set_time_limit(120);

		if (!$this->_items) $this->_load_all_items();

		$map = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

		if (@$wds_options['sitemap-stylesheet']) $map .= $this->_get_stylesheet('xml-sitemap');

		$image_schema_url = 'http://www.google.com/schemas/sitemap-image/1.1';
		$image_schema = @$wds_options['sitemap-images'] ? "xmlns:image='{$image_schema_url}'" : '';
		$map .= "<urlset xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd' xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' {$image_schema}>\n";
		foreach ($this->_items as $item) {
			$map .= "<url>\n";
			foreach ($item as $key => $val) {
				if ('images' == $key) {
					if (!$val) continue;
					if (!@$wds_options['sitemap-images']) continue;
					foreach ($item['images'] as $image) {
						$text = $image['title'] ? $image['title'] : $image['alt'];
						$map .= "<image:image>";
						$map .= "<image:loc>" . esc_url($image['src']) . '</image:loc>';
						$map .= "<image:title>" . ent2ncr($text) . '</image:title>';
						$map .= "</image:image>\n";
					}
				} else $map .= "<{$key}>{$val}</{$key}>\n";
			}
			$map .= "</url>\n\n";
		}
		$map .= "</urlset>";
		$this->_write_sitemap($map);
		$this->_postprocess_sitemap();
	}

	public static function notify_engines ($forced=false) {
		global $wds_options;
		if (!@$wds_options['sitemapurl']) return false;

		$result = array();
		$now = time();

		if ($forced || @$wds_options['ping-google']) {
			do_action('wds_before_search_engine_update', 'google');
			$resp = wp_remote_get('http://www.google.com/webmasters/tools/ping?sitemap=' . esc_url($wds_options['sitemapurl']));
			$result['google'] = array(
				'response' => $resp,
				'time' => $now,
			);
			do_action('wds_after_search_engine_update', 'google', (bool)(@$resp['response']['code'] == '200'), $resp);
		}
		if ($forced || @$wds_options['ping-yahoo']) {
			do_action('wds_before_search_engine_update', 'yahoo');
			$resp = wp_remote_get('http://search.yahooapis.com/SiteExplorerService/V1/ping?sitemap=' . esc_url($wds_options['sitemapurl']));
			$result['yahoo'] = array(
				'response' => $resp,
				'time' => $now,
			);
			do_action('wds_after_search_engine_update', 'yahoo', (bool)(@$resp['response']['code'] == '200'), $resp);
		}
		if ($forced || @$wds_options['ping-bing']) {
			do_action('wds_before_search_engine_update', 'bing');
			$resp = wp_remote_get('http://www.bing.com/webmaster/ping.aspx?sitemap=' . esc_url($wds_options['sitemapurl']));
			$result['bing'] = array(
				'response' => $resp,
				'time' => $now,
			);
			do_action('wds_after_search_engine_update', 'bing', (bool)(@$resp['response']['code'] == '200'), $resp);
		}
		if ($forced || @$wds_options['ping-ask']) {
			do_action('wds_before_search_engine_update', 'ask');
			$resp = wp_remote_get('http://submissions.ask.com/ping?sitemap=' . esc_url($wds_options['sitemapurl']));
			$result['ask'] = array(
				'response' => $resp,
				'time' => $now,
			);
			do_action('wds_after_search_engine_update', 'ask', (bool)(@$resp['response']['code'] == '200'), $resp);
		}

		update_option('wds_engine_notification', $result);
	}

	private function _get_stylesheet ($xsl) {
		$plugin_host = parse_url(WDS_PLUGIN_URL, PHP_URL_HOST);
		$xsl_host = preg_replace('~' . preg_quote('http://' . $plugin_host . '/') . '~', '', WDS_PLUGIN_URL);
		if (is_multisite() && defined('SUBDOMAIN_INSTALL') && !SUBDOMAIN_INSTALL) {
			$xsl_host = '../' . $xsl_host;
		}
		return "<?xml-stylesheet type='text/xml' href='{$xsl_host}wds-sitemaps/xsl/{$xsl}.xsl'?>\n";
	}

	private function _write_sitemap ($map) {
		$file = $this->_data['sitemappath'];
		@file_put_contents($file, $map);

		$f = @fopen("{$file}.gz", "w");
		if (!$f) return false;

		@fwrite($f, gzencode($map, 9));
		@fclose($f);

		return true;
	}

	private function _postprocess_sitemap () {
		// Throw a hook
		do_action('wds_sitemap_created');

		$this->notify_engines();

		// Update sitemap meta data
		update_option('wds_sitemap_dashboard', array(
			'items' => count($this->_items),
			'time' => time(),
		));
	}

	private function _extract_images ($content) {
		preg_match_all("|(<img [^>]+?>)|", $content, $matches, PREG_SET_ORDER);
		if (!$matches) return false;

		$images = array();
		foreach ($matches as $tmp) {
			$img = $tmp[0];

			$res = preg_match('/src=("|\')([^"\']+)("|\')/', $img, $match);
			$src = $res ? $match[2] : '';
			if ( strpos($src, 'http') !== 0 ) {
				$src = site_url($src);
			}

			$res = preg_match( '/title=("|\')([^"\']+)("|\')/', $img, $match );
			$title = $res ? str_replace('-', ' ', str_replace('_', ' ', $match[2])) : '';

			$res = preg_match( '/alt=("|\')([^"\']+)("|\')/', $img, $match );
			$alt = $res ? str_replace('-', ' ', str_replace('_', ' ', $match[2])) : '';

			$images[] = array(
				'src' => $src,
				'title' => $title,
				'alt' => $alt,
			);
		}
		return $images;
	}

	private function _init_items () {
		$this->_items = array();
	}

	/**
	 * Adds a single item into the sitemap queue.
	 */
	private function _add_item ($url, $priority, $freq='weekly', $time=false, $content='') {
		if (!$this->_items) $this->_init_items();
		$time = $time ? $time : time();
		$offset = date("O", $time);

		$item = array (
			'loc' => $url,
			'lastmod' => date("Y-m-d\TH:i:s",$time).substr($offset,0,3).":".substr($offset,-2),//date('Y-m-d', $time),
			'changefreq' => strtolower($freq),
			'priority' => sprintf("%.1f", $priority),
		);

		$item['images'] = $content ? $this->_extract_images($content) : array();

		$this->_items[] = $item;
	}

	/**
	 * Loads all items that will get into a sitemap.
	 */
	private function _load_all_items () {
		$this->_add_item(site_url(), 1, 'daily'); // Home URL
		$this->_load_post_items();
		$this->_load_taxonomy_items();
		// Load BuddyPress-specific items.
		if (defined('BP_VERSION') && is_main_site()) {
			$this->_load_buddypress_group_items();
			$this->_load_buddypress_profile_items();
		}
	}

	/**
	 * Loads BuddyPress Group items.
	 */
	private function _load_buddypress_group_items () {
		if (!function_exists('groups_get_groups')) return false; // No BuddyPress Groups, bail out.
		global $wds_options;
		if (!defined('BP_VERSION')) return false; // Nothing to do
		if (!(int)$wds_options['sitemap-buddypress-groups']) return false; // Nothing to do

		$groups = groups_get_groups(array('per_page', WDS_BP_GROUPS_LIMIT));
		$groups = @$groups['groups'] ? $groups['groups'] : array();

		//$total_users = (int)count_users();
		//$total_users = $total_users ? $total_users : 1;

		foreach ($groups as $group) {
			if (@$wds_options["exclude-buddypress-group-{$group->slug}"]) continue;

			//$priority = sprintf("%.1f", ($group->total_member_count / $total_users));
			$link = bp_get_group_permalink($group);
			$this->_add_item(
				$link,
				0.2, //$priority
				'weekly',
				strtotime($group->last_activity),
				$group->description
			);
		}
		return true;
	}

	/**
	 * Loads BuddyPress profile items.
	 */
	private function _load_buddypress_profile_items () {
		global $wds_options;
		if (!defined('BP_VERSION')) return false; // Nothing to do
		if (!(int)$wds_options['sitemap-buddypress-profiles']) return false; // Nothing to do

		$users = bp_core_get_users(array('per_page' => WDS_BP_PROFILES_LIMIT));
		$users = @$users['users'] ? $users['users'] : array();

		foreach ($users as $user) {
			$wp_user = new WP_User($user->id);
			$role = @$wp_user->roles[0];
			if (@$wds_options["exclude-profile-role-{$role}"]) continue;

			$link = bp_core_get_user_domain($user->id);
			$this->_add_item(
				$link,
				0.2,
				'weekly',
				strtotime($user->last_activity),
				$user->display_name
			);
		}
	}

	/**
	 * Loads posts into the sitemap.
	 */
	private function _load_post_items () {
		global $wds_options;

		$get_content = @$wds_options['sitemap-images'] ? 'post_content,' : '';

		$types = array();
		$raw = get_post_types(array(
			'public' => true,
			'show_ui' => true,
		));
		foreach ($raw as $type) {
			if (@$wds_options['post_types-' . $type . '-not_in_sitemap']) continue;
			$types[] = $type;
		}
		$types_query = "AND post_type IN ('" . join("', '", $types) . "')";
		$posts = $this->_db->get_results(
			"SELECT ID, {$get_content} post_parent, post_type, post_modified FROM {$this->_db->posts} " .
				"WHERE post_status = 'publish' " .
				"AND post_password = '' " .
				"{$types_query} " .
				"ORDER BY post_parent ASC, post_modified DESC LIMIT " . WDS_SITEMAP_POST_LIMIT
		);
		$posts = $posts ? $posts : array();

		foreach ($posts as $post) {
			if (wds_get_value('meta-robots-noindex', $post->ID)) continue; // Not adding no-index files
			if (wds_get_value('redirect', $post->ID)) continue; // Don't add redirected URLs

			$link = get_permalink($post->ID);

			$canonical = wds_get_value('canonical', $post->ID);
			$link = $canonical ? $canonical : $link;

			$priority = wds_get_value('sitemap-priority', $post->ID);
			$priority = $priority ? $priority : (
				$post->post_parent ? 0.6 : 0.8
			);

			$content = isset($post->post_content) ? $post->post_content : '';

			$this->_add_item(
				$link,
				$priority,
				'weekly',
				strtotime($post->post_modified),
				$content
			);
		}
	}

	/**
	 * Loads taxonomies into the sitemap.
	 */
	private function _load_taxonomy_items () {
		global $wds_options;

		$tax = array();
		$raw = get_taxonomies(array(
			'public' => true,
			'show_ui' => true,
		), 'objects');
		foreach ($raw as $tid => $taxonomy) {
			if (@$wds_options['taxonomies-' . $taxonomy->name . '-not_in_sitemap']) continue;
			$tax[] = $taxonomy->name;
		}
		$terms = get_terms($tax, array('hide_empty' => true));

		foreach ($terms as $term) {
			if (wds_get_term_meta($term, $term->taxonomy, 'wds_noindex')) continue;

			$canonical = wds_get_term_meta($term, $term->taxonomy, 'wds_canonical');
			$link = $canonical ? $canonical : get_term_link($term, $term->taxonomy);

			$priority = ($term->count > 10) ? 0.6 : ($term->count > 3) ? 0.4 : 0.2;

			$q = new WP_Query(array(
				'tax_query' => array(
					'taxonomy' => $term->taxonomy,
					'field' => 'id',
					'terms' => $term->term_id
				),
				'orderby' => 'date',
				'order' => 'DESC',
				'posts_per_page' => 1,
			));
			$time = $q->posts ? strtotime($q->posts[0]->post_date) : time();

			$this->_add_item(
				$link,
				$priority,
				'weekly',
				$time
			);
		}
	}
}

function wds_xml_sitemap_init() {
	global $plugin_page;

	if( isset( $plugin_page ) && $plugin_page == 'wds_wizard' ) {
		$wds_xml = new WDS_XML_Sitemap();
	}
}
add_action( 'admin_init', 'wds_xml_sitemap_init' );

function wds_sitemaps_read() {
	global $wds_options;

	$dir = wp_upload_dir();
	$path = trailingslashit($dir['basedir']);
	if (!is_dir($path)) {
		$path = $wds_options['sitemappath'];
	} else {
		$path = "{$path}sitemap.xml";
	}

	$is_gzip = preg_match('~\.gz$~i', $_SERVER['REQUEST_URI']);
	$path = $is_gzip ? "{$path}.gz" : $path;

	if (preg_match('~' . preg_quote('/sitemap.xml') . '(\.gz)?$~i', $_SERVER['REQUEST_URI'])) {
		if (file_exists($path)) {
			if ($is_gzip) header('Content-Encoding: gzip');
			header('Content-Type: text/xml');
			readfile($path);
			die;
		} else {
			$sitemap = new WDS_XML_Sitemap;
			if(file_exists($path)) {
				if ($is_gzip) header('Content-Encoding: gzip');
				header('Content-Type: text/xml');
				readfile( $path );
				die;
			} else wp_die( __( 'The sitemap file was not found.' , 'wds') );
		}
	}
}
add_action( 'init', 'wds_sitemaps_read' );

add_action('wp_ajax_wds_update_sitemap', create_function('', '$sitemap = new WDS_XML_Sitemap;'));
add_action('wp_ajax_wds_update_engines', create_function('', 'WDS_XML_Sitemap::notify_engines(1);'));

global $wds_options;
if (!@$wds_options['sitemap-disable-automatic-regeneration']) {
	add_action('delete_post', create_function('', '$sitemap = new WDS_XML_Sitemap;'));
	add_action('publish_post', create_function('', '$sitemap = new WDS_XML_Sitemap;'));

	add_action('delete_page', create_function('', '$sitemap = new WDS_XML_Sitemap;'));
	add_action('publish_page', create_function('', '$sitemap = new WDS_XML_Sitemap;'));
}