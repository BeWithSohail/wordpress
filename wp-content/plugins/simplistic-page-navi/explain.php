		<table class="form-table">
		<tr valign="top">
		<td>Load style sheet</td>
		<td><input type="number" name="splcpn_options[style]" value="<?php echo ( int )$this->ret_option['style']; ?>"  min="0" max="6"></td>
		<td>* <?php _e( '0:Don\'t load the style sheet (or specify it directly in the template using a function), 1:standard square design, 2:circle design, 3:circle white back, 4:circle orange back, 5:simple square, 6:white gradation', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Reverse List</td>
		<td><select name="splcpn_options[reverse]">
		<?php
			$selected = array( '', '' );
			if ( '1' === $this->ret_option['reverse'] ) {
				$selected[1] = ' selected';
			} else {
				$selected[0] = ' selected';
			}
		?>
		<option value="1"<?php echo $selected[1]; ?>><?php _e( 'reverse list', 'splcpnl' ); ?></option>
		<option value="0"<?php echo $selected[0]; ?>><?php _e( 'standard left start', 'splcpnl' ); ?></option>
		</select></td>
		<td>* <?php _e( 'The list can be specified in reverse order from right to left.',  'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Visibility of direct Jump box</td>
		<td><input type="number" name="splcpn_options[above]" value="<?php echo intval( $this->ret_option['above'] ); ?>" min="2" max="1000"></td>
		<td>* <?php _e( 'Specify the minimum number of all pages to display the input box for direct jump, and hide it if you enter a number that exceeds the number of all pages. Default is 7 pages.', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Pixel value of madia query's max-width</td>
		<td><input type="number" name="splcpn_options[nr_style]" value="<?php echo ( int )$this->ret_option['nr_style']; ?>" min="0" max="1500"></td>
		<td>* <?php _e( 'This number sets the pixel value of max-width in media query for narrow screens such as mobile devices. The style of the hidden elements are output by wp_head. 0 means no style is output. The default value is 770.', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>list of minimum unit</td>
		<td><select name="splcpn_options[minimum_unit]">
		<?php
			$selected = array( '', '' );
			if ( '0' === $this->ret_option['minimum_unit'] ) {
				$selected[0] = ' selected';
			} else {
				$selected[1] = ' selected';
			}
		?>
		<option value="1"<?php echo $selected[1]; ?>><?php _e( 'standard', 'splcpnl' ); ?></option>
		<option value="0"<?php echo $selected[0]; ?>><?php _e( 'minimun', 'splcpnl' ); ?></option>
		</select></td>
		<td>* <?php _e( 'Displays a page list with the minimum number of elements required.', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Number of pages that adjacent to current page to display list</td>
		<td><input type="number" name="splcpn_options[adjacent_num]" value="<?php echo ( int )$this->ret_option['adjacent_num']; ?>" min="1" max="5"></td>
		<td>* <?php _e( 'Enter the number of pages to display that are adjacent to the current page. Centered on the current page, if there are page numbers that can be displayed, they will be displayed on both sides of next/prev. The number to be entered is the number for one side only. <br>For example, if the current page number is 5, and you set this number to 2, the adjacent number displays will be 3, 4, 5, 6, and 7, two on each side of the current page.', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Maximum number of larger page to display list</td>
		<td><input type="number" name="splcpn_options[larger_page]" value="<?php echo ( int )$this->ret_option['larger_page']; ?>" min="0" max="5"></td>
		<td>* <?php _e( 'Larger page means a multiple of 10. Specifies the number of larger page numbers to be displayed when there are many pages. This is also valid before and after the current page number, and all you need to specify is the number on one side of it. <br>For example, if 2 is specified for this number, the current page number is 25, and the total number of pages is 50, the page numbers displayed will be 10,20,...25,...,30,40. If 0 is specified, the larger pages will not be displayed at all.', 'splcpnl' ); ?></td>
		</tr>

		<tr valign="top">
		<td>Maximum number of hundreds place pages to display list</td>
		<td><input type="number" name="splcpn_options[distant_num]" value="<?php echo ( int )$this->ret_option['distant_num']; ?>" min="0" max="5"></td>
		<td>* <?php _e( 'Specifies the number of page numbers in multiples of 100 to be displayed when there are a large number of pages and when the distance from the beginning or end is large.', 'splcpnl' ); ?></td>
		</tr>

		<tr valign="top">
		<td>Label of 'to first page'</td>
		<td><input type="text" name="splcpn_options[top_label]" value="<?php echo esc_attr( $this->ret_option['top_label'] ); ?>" maxlength="6"></td>
		<td>* <?php _e( 'Enter a string of up to 6 characters to be displayed on the label of the link on the top page.', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Label of 'to last page'</td>
		<td><input type="text" name="splcpn_options[last_label]" value="<?php echo esc_attr( $this->ret_option['last_label'] ); ?>" maxlength="6"></td>
		<td>* <?php _e( 'Enter a string of up to 6 characters to be displayed on the label of the link on the last page.', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Connection string</td>
		<td><input type="text" name="splcpn_options[connection_str]" value="<?php echo esc_attr( $this->ret_option['connection_str'] ); ?>" maxlength="3"></td>
		<td>* <?php _e( 'Enter the connecting string to be displayed between page numbers when they are far apart, such as when multiples of 10 are displayed. 3 characters max.', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Id string of parent div tag</td>
		<td><input type="text" name="splcpn_options[div_id]" value="<?php echo esc_attr( $this->ret_option['div_id'] ); ?>" maxlength="20"></td>
		<td>* <?php _e( 'Specifies the string for the id attribute of the parent <div> element. Default is "pagenavilist".', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Font size</td>
		<td><input type="number" name="splcpn_options[font_size]" value="<?php echo ( int )$this->ret_option['font_size']; ?>"  min="-10" max="10"></td>
		<td>* <?php _e( 'Specifies the font size; select 0 to disable. -10 : 0.5em ~ 10 : 1.5em, at intervals of 0.05em.', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Text-align of id="toppagelink" &lt;nav&gt; tag</td>
		<td><select name="splcpn_options[top_text_align]">
		<?php
			$selected = array( '', '', '', '' );
			if ( '1' === $this->ret_option['top_text_align'] ) {
				$selected[1] = ' selected';
			} elseif ( '2' === $this->ret_option['top_text_align'] ) {
				$selected[2] = ' selected';
			} elseif ( '3' === $this->ret_option['top_text_align'] ) {
				$selected[3] = ' selected';
			} else {
				$selected[0] = ' selected';
			}
		?>
		<option value="0"<?php echo $selected[0]; ?>><?php _e( 'disable', 'splcpnl' ); ?></option>
		<option value="1"<?php echo $selected[1]; ?>><?php _e( 'left', 'splcpnl' ); ?></option>
		<option value="2"<?php echo $selected[2]; ?>><?php _e( 'right', 'splcpnl' ); ?></option>
		<option value="3"<?php echo $selected[3]; ?>><?php _e( 'center', 'splcpnl' ); ?></option>
		</select></td>
		<td>* <?php _e( 'The text-align setting of the &lt;nav&gt; tag ( id="toppagelink" ) of the outermost parent element. ', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Margin of id="toppagelink"  &lt;nav&gt; tag</td>
		<td><input type="text" name="splcpn_options[top_margin]" value="<?php echo esc_attr( $this->ret_option['top_margin'] ); ?>" maxlength="24"></td>
		<td>* <?php _e( 'The margin setting of the &lt;nav&gt; tag ( id="toppagelink" ) of the outermost parent element. Invalid if nothing is entered. top:right:bottom:left, separated by ":". Available units, px, %, auto, if the unit is omitted and it is just a number, it will be px. Can be abbreviated in the same way as normal css formatting. Example: only one number 10, two 20:auto, three 10px:0:20%, all -20px:0:30:50%.', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Text-align of id="bottompagelink" &lt;nav&gt; tag</td>
		<td><select name="splcpn_options[bottom_text_align]">
		<?php
			$selected = array( '', '', '', '' );
			if ( '1' === $this->ret_option['bottom_text_align'] ) {
				$selected[1] = ' selected';
			} elseif ( '2' === $this->ret_option['bottom_text_align'] ) {
				$selected[2] = ' selected';
			} elseif ( '3' === $this->ret_option['bottom_text_align'] ) {
				$selected[3] = ' selected';
			} else {
				$selected[0] = ' selected';
			}
		?>
		<option value="0"<?php echo $selected[0]; ?>><?php _e( 'disable', 'splcpnl' ); ?></option>
		<option value="1"<?php echo $selected[1]; ?>><?php _e( 'left', 'splcpnl' ); ?></option>
		<option value="2"<?php echo $selected[2]; ?>><?php _e( 'right', 'splcpnl' ); ?></option>
		<option value="3"<?php echo $selected[3]; ?>><?php _e( 'center', 'splcpnl' ); ?></option>
		</select></td>
		<td>* <?php _e( 'The text-align setting of the &lt;nav&gt; tag ( id="bottompagelink" ) of the outermost parent element. ', 'splcpnl' ); ?></td>
		</tr>
		<tr valign="top">
		<td>Margin of id="bottompagelink"  &lt;nav&gt; tag</td>
		<td><input type="text" name="splcpn_options[bottom_margin]" value="<?php echo esc_attr( $this->ret_option['bottom_margin'] ); ?>" maxlength="24"></td>
		<td>* <?php _e( 'The margin setting of the &lt;nav&gt; tag ( id="bottompagelink" ) of the outermost parent element. Same as "toppagelink".', 'splcpnl' ); ?></td>
		</tr>

		<tr>
		<td colspan="3">
		<p>* <?php _e( 'However, when it comes to style settings, I recommend that you disable all of the above style-related options and put them all together in the theme\'s style sheet, just like any other style settings.', 'splcpnl' ); ?></p>
		</td>
		</tr>

		<tr valign="top">
		<td>Erase wp_link_pages output of theme default.</td>
		<td><select name="splcpn_options[hidden_wplinkpages]">
		<?php
			$selected = array( '', '' );
			if ( '0' === $this->ret_option['hidden_wplinkpages'] ) {
				$selected[0] = ' selected';
			} else {
				$selected[1] = ' selected';
			}
		?>
		<option value="1"<?php echo $selected[1]; ?>><?php _e( 'erase', 'splcpnl' ); ?></option>
		<option value="0"<?php echo $selected[0]; ?>><?php _e( 'show', 'splcpnl' ); ?></option>
		</select></td>
		<td>* <?php _e( 'This setting allows you to erase the list of navigation pagenumbers emitted by the standard WordPress function wp_link_pages.', 'splcpnl' ); ?></td>
		</tr>

		</tr>
		<tr valign="top">
		<td> Page-lists outputted by javascript</td>
		<td><input type="text" name="splcpn_options[js_output]" value="<?php echo esc_attr( $this->ret_option['js_output'] ); ?>" width="100"></td>
		<td>* <?php _e( 'With this setting, you specify the ID attribute of the HTML element for which you want to place the page-list, and the plugin will insert the page-list as the first and last element of that element using Javascript. default is ""( empty string )->disabled<br>For example, the ID of the html element of main content of the standard WordPress theme ("21", "19", "17", "16") is "content", and "20" is "site-content".<br>If you have no experience with HTML at all, try entering the word "search" in this option box. If the plugin can successfully find the main content, it might work.<br>', 'splcpnl' ); ?>
				<?php _e( 'Then, if you specify that ID followed by "^" as a delimiter and fill in the CSS styling, you can set an inline style for each page-list inserted at the beginning and end.<br>Each should be separated by "^". -> ID^top-style(option)^bottom-style(option)<br>eg. content^width:50%;font-size:1.2em;background-color:lightblue;^font-size:0.9em;<br>', 'splcpnl' ); ?>
				<?php _e( 'If either style is specified, the page-list element will not be inserted if the other is left blank. If you need both, either specify nothing for both, or specify some style for both. For example, position:relative;.<br>eg. search^font-size:1.2em; -> only top, search^^font-size:1.2em; -> only bottom', 'splcpnl' ); ?>
		</td>
		</tr>

		<tr valign="top">
		<td>Register block</td>
		<td><select name="splcpn_options[en_gutenblock]">
		<?php
			$selected = array( '', '' );
			if ( '0' === $this->ret_option['en_gutenblock'] ) {
				$selected[0] = ' selected';
			} else {
				$selected[1] = ' selected';
			}
		?>
		<option value="1"<?php echo $selected[1]; ?>><?php _e( 'enable', 'splcpnl' ); ?></option>
		<option value="0"<?php echo $selected[0]; ?>><?php _e( 'disable', 'splcpnl' ); ?></option>
		</select></td>
		<td>* <?php _e( 'This plugin has a custom block for Gutenberg Block-Editor. Activation of its registration.', 'splcpnl' ); ?></td>
		</tr>
		</table>

		<?php submit_button(); ?>
	</form>

	<p><?php _e( 'It is common to display two page link lists, one at the top of the page and one at the bottom. In such case, when the function is called a second time, the list created the first time is reused from memory to avoid having the same process performed twice.', 'splcpnl' ); ?></p>
	<p><?php _e( 'If you want to uninstall the plugin, you can do so from the plugin page, and the option values will be removed from the database.', 'splcpnl' ); ?></p>
	<hr>
	<p><?php _e( 'Usage', 'splcpnl' ); ?></p>
	<p><?php _e( 'A reliable way to display the page-list where you want it to display is to put the "splcpn_echopager" template tag in the template where you want it to display, as shown below.', 'splcpnl' ); ?></p>
	<p><?php _e( 'However, if you don\'t want to touch HTML or php, you may want to try the "Page-lists outputted by javascript" option above.', 'splcpnl' ); ?></p>

	<pre>
		&lt;?php
			if ( function_exists( 'splcpn_echopager' ) ) {
				splcpn_echopager( 1 );
			}
		?&gt;
	</pre>
	<p><?php _e( 'If you specify one parameter and a value of 1, as in this case, the HTML will be output as follows.', 'splcpnl' ); ?></p>
	<pre>&lt;nav id="toppagelink"&gt;&lt;div class="wp-pagenavi"&gt;...</pre>
	<p><?php _e( 'On the other hand, if you set 0 or if you omit it ( 0 is the default value and can be omitted ), it looks like the following, allowing detailed position settings for each when displayed twice within the same page.', 'splcpnl' ); ?></p>
	<pre>&lt;nav id="bottompagelink"&gt;&lt;div class="wp-pagenavi"&gt;...</pre>
	<p><?php _e( 'When the following parameters are specified as the second argument in an array, the first argument cannot be omitted even if the first argument value is 0 of default value. Also, be sure to put the values of the arguments in single or double quotes.', 'splcpnl' ); ?></p>
	<p><?php _e( 'The last parameter "max_page_num" is not an option value. For example, when you get a list of the specific category post using the WP_Query at a "static" page, "$wp_query->max_num_pages" may not have a value. In that case, pagenation will be not displayed. You should be able to get the total number of pages somehow, so just specify that value in this parameter and it will work.', 'splcpnl' ); ?></p>
	<pre>
		if ( function_exists( 'splcpn_echopager' ) ) {
			$args = array(
				'reverse' =&gt; '0', // 0:normal( from left ) 1:reverse( from right )
				'above' =&gt; '7', // Show jump-box when the total number of pages is more than this number, default:7
				'minimum_unit' =&gt; '1', // 0:minimum-list 1:full-list
				'adjacent_num'=&gt; '3',//  Number of pages that adjacent to current page to be displayed, 1-5
				'larger_page'=&gt; '3',// Number of pages that multiples of 10 to be displayed, 0-5
				'top_label' =&gt; 'Top',
				'last_label' =&gt; 'Last',
				'connection_str'=&gt;'~',// Connection string, empty is disable.
				'div_id'=&gt;'pagenavilist',// ID name of parent div tag.
				'font_size'=&gt;'0',//specify font size. set 0 to disable. -10 : 0.5em ~ 10 : 1.5em, at intervals of 0.05em.
				'top_text_align'=&gt;'0',// Text-align of id="toppagelink" of "nav" tag. 0 : disable, 1:left, 2: right, 3:center.
				'top_margin'=&gt;'',// Margin of  id="toppagelink" of "nav" tag. Empty is disable, top:right:bottom:left. This value can have from one to four values same as the format of css.
				'bottom_text_align'=>'0',// Text-align of  id selector "bottompagelink" of "nav" tag. 0 : disable, 1:left, 2: right, 3:center.
				'bottom_margin'=>'',// Margin of  id selector "bottompagelink" of "nav" tag. Same as "top_margin". 
				'distant_num'=>'3',// Number of pages that multiples of 100 to be displayed when the wide distance from the edge label.
				'max_page_num'=&gt;$wp_query->max_num_pages,// The total number of pages. This value is required when value of $wp_query->max_num_pages is empty or disable.
			);
			splcpn_echopager( 0, $args );
		}
	</pre> 
	<p><?php _e( 'You can have two different page-lists displayed on the same page by specifying a parameter as the second argument.', 'splcpnl' ); ?></p>
	<p><?php _e( 'In addition, when you want to change the style for each page, you set the "Load style sheet" option to 0 and call the function of "direct_splcpn_style" before wp_head () in header.php. You can specify the style sheet to be loaded for each page.', 'splcpnl' ); ?></p>
	<p><?php _e( 'For example, you can randomly change the style on each page by doing the following.', 'splcpnl' ); ?></p>
	<pre>
		&lt;?php
			if ( function_exists( 'direct_splcpn_style' ) ) {
				$splcpn_num = rand( 1, 6 );
				direct_splcpn_style( $splcpn_num );
			}
			wp_head();
		?&gt;
	</pre>
</div>
