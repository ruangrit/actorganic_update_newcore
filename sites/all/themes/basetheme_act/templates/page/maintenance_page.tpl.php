<?php
// $Id: page.tpl.php,v 1.11.2.2 2010/08/06 11:13:42 goba Exp $

/**
 * @file
 * Displays a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or
 *   'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   element.
 * - $head: Markup for the HEAD element (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the
 *   current path, whether the user is logged in, and so on.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled in
 *   theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been
 *   disabled in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been
 *   disabled.
 * - $primary_links (array): An array containing primary navigation links for
 *   the site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links
 *   for the site, if they have been configured.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the
 *   view and edit tabs when displaying a node).
 * - $content: The main content of the current Drupal page.
 * - $right: The HTML for the right sidebar.
 * - $node: The node object, if there is an automatically-loaded node associated
 *   with the page, and the node ID is the second argument in the page's path
 *   (e.g. node/12345 and node/12345/revisions, but not comment/reply/12345).
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic
 *   content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <!--[if Gecko]><!-->  
	<link type="text/css" rel="stylesheet" media="all" href="/sites/all/themes/basetheme_act/css/firefox.css">
  <!--<![endif]-->  
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyled Content in IE */ ?> </script>
</head>
<body id="base-fixed" class="<?php print $body_classes; ?>">
<?php print $conmsg_msg; ?>
  <div id="wrapper" class="<?php print $wrapper_classes; ?>">
    <div id="header-wrapper">
	    <div id="header" class="clear-block">
		    <div class="skip-nav">
		      <a href="#container">Skip to main content</a>
		    </div>
		    <div id="branding">
		      <?php if ($logo or $site_name): ?>
		        <?php if ($title): ?>
		          <div class="site-name">
		            <?php if (!empty($logo)): ?>
		              <a href="<?php print $front_page; ?>" title="<?php print $site_name; ?>" id="logo">
		                <img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" />
		              </a>
		            <?php endif; ?>
					    </div>           
		        <?php else: /* Use h1 when the content title is empty */ ?>     
		          <h1 class="site-name">
		            <?php if (!empty($logo)): ?>
		              <a href="<?php print $front_page; ?>" title="<?php print $site_name; ?>" id="logo">
		               <img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" />
		              </a>
		            <?php endif; ?>
		          </h1>
		        <?php endif; ?>
		      <?php endif; ?>
		
		      <blockquote id="site-slogan">
		        <?php if (!empty($site_slogan)): ?>
		          <?php print $site_slogan; ?>
		        <?php endif; ?>
		      </blockquote> <!-- /site-slogan -->
		    </div> <!-- /branding -->
		
			  <?php if (!empty($header_top)): ?>
			    <div id="header-top">
			      <?php print $header_top; ?>
			    </div>
			  <?php endif; ?>
		  
		    <?php if (!empty($header)): ?>
		      <div id="header-region">
		        <?php print $header; ?>
		      </div>
		    <?php endif; ?>
	    </div> <!-- /header -->
	  </div> <!-- /header-wrapper  -->

    <div id="container-wrapper">	
   	  <div id="container" class="clear-block">
   	  
   	  <?php if (!empty($messages)): print $messages; endif; ?>
		  <?php if (!empty($help)): print $help; endif; ?>
   	  
	    <?php if (!empty($feature)): ?>
	      <div id="feature">
	        <?php print $feature; ?>
	      </div> <!-- /feature -->
	    <?php endif; ?>
	
	      <div id="main" class="column">
	        <div id="main-content">
	        
	        <?php if (!empty($breadcrumb)): ?>
	          <div id="breadcrumb">
	            <?php print $breadcrumb; ?>
	          </div>
	        <?php endif; ?>
	
	        <div id="content">
	           <?php if (!empty($content_top)): ?>
	            <div id="content-top" class="section">
	              <?php print $content_top; ?>
	            </div> <!-- /content_top -->
	          <?php endif; ?>
	          
	          <div id="content-inner" class="clear-block">
	
		          <?php if ($tabs): ?>
		            <div class="local-tasks">
		              <div class="clear-block">
		                <?php print $tabs; ?>
		              </div>
		            </div>
		          <?php endif; ?>
		          
		          <?php if (!empty($before_content)): ?>
	              <?php print $before_content; ?>
  	          <?php endif; ?>
		      	          
	            <?php print $content; ?> <!-- /main content -->
	            <div class="skip-nav">
	              <a href="#container">Skip to Top</a>
	            </div>
	
	          <?php if (!empty($content_bottom)): ?>
	            <div id="content-bottom" class="section clear-block">
	              <?php print $content_bottom; ?>
	            </div> <!-- /content_bottom -->
	          <?php endif; ?>
	
	          </div> <!-- /content-inner -->
	        </div> <!-- /content -->
	        
		      <?php if (!empty($left)): ?>
		        <div id="sidebar-left" class="column sidebar">
		          <?php print $left; ?>
		        </div> <!-- /sidebar-left -->
		      <?php endif; ?>
		      	        
		      <?php if (!empty($right)): ?>
		        <div id="sidebar-right" class="column sidebar">
		          <?php print $right; ?>
		        </div> <!-- /sidebar-right -->
		      <?php endif; ?>
	
	      </div></div> <!-- /main-content /main -->	
	    </div> <!-- /container -->
    </div> <!-- /container-wrapper -->
    
    <div id="footer-wrapper" class="clear-block">
	    <div id="footer">
	      <?php if (!empty($footer)): print $footer; endif; ?>
	    </div> <!-- /footer -->
	  </div> <!-- /footer-wrapper -->
	  
  </div> <!-- /wrapper -->
  
    <?php print $closure; ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=192822880848264";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>
