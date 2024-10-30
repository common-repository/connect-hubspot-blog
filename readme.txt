=== Connect hubspot blog ===
Contributors: rohitcse05
Donate link: https://er-rohit-kumar.business.site/
Tags: HubSpot, blogs, analytics, connect, marketing analytics,all blogs,blog-category, blog-listing, hubspot
Requires at least: 3.3
Stable tag: 4.3
Tested up to: 5.3.2
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Connect hubspot blog for WordPress is a powerful plugin that allow to include directly your HubSpot blog and much more in pages, articles, and wherever you want.

== Description ==

Connect hubspot blog WordPress blogs connector is a powerful plugin that allow to include directly your HubSpot blog and much more in pages, articles, and wherever you want.
 
Major features in Connect hubspot blog include:
 
*   Automatic get all posts from HubSpot blog via API
*   Number of columns configurable
*   Number of posts configurable
*   Number of posts per page configurable
*   Blogs Content enable/disable configurable
*   List type list/slider configurable
 
You’ll need an HubSpot API key to use it. Keys are free. To get your HubSpot API key, please follow the link here: https://app.hubspot.com/keys/get. This can also be viewed by navigating to your Account Menu and selecting Integrations.

== Installation ==

1. Upload `connect-hubspot-blog.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress admin.
3. Put your hubspot API key in Hubspot API section and save the setting
4. After configuration Place the Snippet from taking `GET SHORTCODE` Button. For Example: `[chb-blog id=6513512292 limit=10 cols=3 perpage=3 listtype=List showtext=1]` or `<?php echo do_shortcode('[chb-blog id=6513512292 limit=10 cols=3 perpage=3 listtype=List showtext=1]'); ?>`. Place `[chb-blog]` or `<?php echo do_shortcode('[chb-blog]'); ?>` in your templates or pages.

== Frequently asked questions ==

= What is Hubspot? =

HubSpot is a developer and marketer of software products for inbound marketing and sales. It was founded by Brian Halligan and Dharmesh Shah in 2006. Its products and services aim to provide tools for social media marketing, content management, web analytics and search engine optimization.

= How do I find my HubSpot API key? =

if you have admin access in your account, you can access your HubSpot API key in your integrations settings.

  * In your HubSpot account, click your account name in the top right corner, then click Integrations.
  * In the left sidebar menu, navigate to Integrations > API key.
  * If a key has never been generated for your account, click Generate API key. 
  * Once an API key has been created for your account, the key will appear here. Click Copy to copy the API key to your clipboard. 

= How do I creat a HubSpot API key? =

To create an API key:

  * Navigate to the APIs & Services→Credentials panel in GCP Console.
  * Select Create credentials, then select API key from the dropdown menu.
  * Click the Create button. The API key created dialog box displays your newly created key.

== Screenshots ==

1. Api settings tab
2. Blog Settings tab
3. Code Snippet Popup

== Changelog ==

= 1.0.0 =
* Release Date: April 25th, 2019 , initial release.

= 1.0.0 =
* Updated settings saved message#1

= 1.0.0 =
* Backend UI improved#2

= 1.0.1 =
* some bug fixed

= 1.0.2 =
* Added listing in slider and an option for user to select list tyle/list slider type in backend 

= 1.0.3 =
* Error fixing
