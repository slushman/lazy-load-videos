<?php

/**
 * The view for the help page
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Lazy_Load_Videos
 * @subpackage Lazy_Load_Videos/classes/views
 */

?><h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<h2>Shortcode</h2>
<p>To display a list of Lazy_Load_Videos on a page, use the following shortcode. The simplest version of the shortcode is:</p>
<pre><code>[employeelist]</code></pre>
<p>Enter that in the Editor on any page or post to display a list of Lazy_Load_Videos.</p>
<p>Here are the custom attributes accepted by the shortcode:</p>

<h3>department</h3>
<p>The department attribute limits the employee list to display only Lazy_Load_Videos from the chosen department. The value needs to be the slug of the department.
<p>Examples:</p>
<ul>
	<li>department="sales"</li>
	<li>department="creditors-rights"</li>
</ul>
<p>The department attribute also accepts comma-separated lists of departments slugs to display Lazy_Load_Videos from more than one department.
<p>Example:</p>
<ul>
	<li>department="sales,creditors-rights"</li>
</ul>
<h2>Building a Layout in the Shortcode</h2>
<p>Lazy_Load_Videos comes with a simple layout for the shortcode. While developers should be able change the layout using action hooks, a site admin can use the shortcode to create a layout of their choosing. By default, the employee list layout is image, name, and job title.</p>
<p>To use the shortcode to build a layout, use the "show" attribute like follows:</p>
<pre><code>[employeelist show="image,name,job_title"]</code></pre>
<p>Enter each part of the layout as a comma-separated list. The example above generates the default layout.</p>
<h3>Content Options</h3>
<p>Here are the options for creating a custom layout in the shortcode:</p>
<dl>
	<dt><dfn>name</dfn></dt>
	<dd>The name of the employee</dd>
	<dt><dfn>image or headshot</dfn></dt>
	<dd>The employee headshot</dd>
	<dt><dfn>job_title</dfn></dt>
	<dd>The employee's job title (notice the underscore)</dd>
	<dt><dfn>description</dfn></dt>
	<dd>The employee's content</dd>
	<dt><dfn>email_address</dfn></dt>
	<dd>The employee's email address as a mailto link.</dd>
	<dt><dfn>fax_number</dfn></dt>
	<dd>The employee's fax number</dd>
	<dt><dfn>vcard</dfn></dt>
	<dd>A link to the employee's downloadable vCard</dd>
	<dt><dfn>phone_office</dfn></dt>
	<dd>The employee's office phone number as a tel: link</dd>
	<dt><dfn>phone_cell</dfn></dt>
	<dd>The employee's cell phone number as a tel: link</dd><!--  -->
	<dt><dfn>social_links</dfn></dt>
	<dd>An unordered list of all the employee's social network profiles, as linked SVG icons (with proper screen reader text).</dd>
	<dt><dfn>address</dfn></dt>
	<dd>The employee's full address - street 1, street 2, city, state, and zip code.</dd>
	<dt><dfn>street1</dfn></dt>
	<dd>The employee street address.</dd>
	<dt><dfn>street2</dfn></dt>
	<dd>The employee street address 2.</dd>
	<dt><dfn>city</dfn></dt>
	<dd>The employee's city</dd>
	<dt><dfn>state</dfn></dt>
	<dd>The employee's state</dd>
	<dt><dfn>zipcode</dfn></dt>
	<dd>The employee's zip code</dd>
	<dt><dfn>building</dfn></dt>
	<dd>The employee's building</dd>
	<dt><dfn>office</dfn></dt>
	<dd>The employee's office number</dd>
</dl>
<h3>Layout Options</h3>
<p>These additional items are useful for styling, linking, etc:</p>
<dl>
	<dt><dfn>container_begin or box_begin</dfn></dt>
	<dd>Generates a content box so you can more easily style a particular section of the content. This is a div with the class "employee-content-container".</dd>
	<dt><dfn>container_end or box_end</dfn></dt>
	<dd>Ends the content box. This generates the closing div tag. If a container_begin or box_begin is included without a matching end, the end will be automatically included at the end of the layout (just before a link_end that may be auto-generated). Does nothing without a container_begin or box_begin.</dd>
	<dt><dfn>link_begin</dfn></dt>
	<dd>The beginning of a link to the employee's page</dd>
	<dt><dfn>link_end</dfn></dt>
	<dd>The end of a link to the employee's page. If a link_begin is included without a matching link_end, the link_end will be automatically included at the end of the layout. Does nothing without a link_begin.</dd>
</dl>