Wordpress web page

=== Description ===
Our web page is just basic structure, with styles and form. Structure of a web page is created automatically, you just need to add a new post and sort it into categories. Then we create a form where it automatically prefills data from the url address. So if you are a user you just clicked on the buttons of your problem and then at the end you clicked on the button which reconnects you to the form, with prefill data what you chose before.

=== What we have done === 
	We add three new templates, for contract,  featured article (which is basic post with buttons) and for form. Every template is consist of two files ({name} Page Template and {name}-content.php)

	We add a new function in functions.php, where we add a new category for every post you publish. It is important for our structure. But when you don't want to add a new category for example you made a contract and you don't need to make it like a parent post. You must comment on this function. So it is just for basic structure. But you don't have hierarchical sorting so you must edit thi manually.

	In template of featured article is automatic query which compare post title with category name and if names are same it add new button of post what category consist. Important thing

	We added a site with a form that is automatically prefilled from the URL address. In form is also Captcha for preventing bots or bored peoples from sending invalid forms.


=== Functions ===

== function automatic_category( $new_status, $old_status, $post) ==

	This function compare old and new status and recognise if post is publish or updated

	If post is publish it create new category with name of post_title but if post_title has “contr” in it (it means it is contract) it doesn't create category

	If a post is updated, it controls if category exists and if yes then updates a title from post_title because the name of category and post_title must be the same for the query to work right. But if a category doesn't exist it does nothing.


== The Query ==

	First we add some arguments($args) and then we join a query with them

	If query contains some post it compare the category_name with post_title and makes buttons from post in category

	It shows only post with featured image and title




=== Contacts ===

If you need or you don't understand something you can just ask us.

	Marek Kozel +420 776 051 397 mkozel1@pojfm.cz
	Ondřej Zahorán +420  ozahoran@pojfm.cz


=== interior Techup ===
Contributors: wptexture      
Requires at least:  5.4
Tested up to:       5.9
Requires PHP:       5.6
Stable tag:         1.2
License:            GPLv3 or later
License URI: https://www.gnu.org/licenses/license-list.html#GNUGPLv3
Tags: left-sidebar, right-sidebar, one-column, two-columns, three-columns, four-columns, grid-layout, custom-colors, custom-background, custom-logo, custom-menu, custom-header, editor-style, featured-images, footer-widgets, sticky-post, full-width-template, theme-options, translation-ready, threaded-comments, post-formats, rtl-language-support, blog, portfolio, e-commerce

== Description ==
interior Techup Theme. This is a child theme of Techup a Free WordPress Theme useful for Business, corporate and agency and Trade Institutional based websites. Theme has a full screen option. Theme is developed with creative design having multiple sections on Home Page. Theme has powerful features that let you write articles and blog posts with ease. It uses the best clean Construction practices, responsive HTML5, and on top of that, it is fast, simple, and easy to use. Use the Customizer to add your own background, page layout, site width and more. Theme is useful in NGO, Architecture, Builder, Construction, Technology, Health & Science, Religion, Property dealing and any kind of website. Theme has Slider, feature, callout, services, portfolio, testimonial, Team section. Theme support unlimited colors options too. You can customize logo and can add unlimited pages. Theme is responsive and supports all major plugins of WordPress.  
 
== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload Theme and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Copyright ==

interior Techup WordPress Theme, Copyright 2022, wptexture  
interior Techup is distributed under the terms of the GNU GPL

interior Techup bundles the following third-party resources:

	Font Awesome by Dave Gandy
    Licenses: SIL OFL 1.1, MIT, CC BY 3.0
    Source: https://github.com/FontAwesome/Font-Awesome

    Bootstrap by Twitter
    License: MIT
    Source: https://github.com/twbs/bootstrap

    Owl Carousel by David Deutsch
    License: MIT
    Source: https://github.com/OwlCarousel2/OwlCarousel2

    Magnific Popup by Dmitry Semenov
    License: MIT
    Source: http://dimsemenov.com/plugins/magnific-popup/

== screenshot ==

Image for theme screenshot 
License:  CCO 
License URL: https://pxhere.com/en/photo/1188666

Image for header background 
License:  CCO 
License URL: https://pxhere.com/en/photo/26634

Image for Testimonial background
License:  CCO 
License URL: https://pxhere.com/en/photo/649372

Image for Hero background
License:  CCO 
License URL: https://pxhere.com/en/photo/1447187