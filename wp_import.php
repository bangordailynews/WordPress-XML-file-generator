<?php
/*
By William P. Davis (http://wpdavis.com) for Bangor Daily News (http://bangordailynews.com), CoPress (http://copress.org) and The Maine Campus (http://mainecampus.com)
LICENSE: Released under GPL (http://www.gnu.org/licenses/gpl.html). You may use this script for free for any use. However, if you make changes and distribute it you must release the code under the GPL license.
Report changes or bugs to will@wpdavis.com or at http://dev.bangordailynews.com
*/

//Set a few global variables
$accepted_authors = array( );
$default_author = 'My Default Author';
$site_url = 'http://example.com/'; // Make sure you have the trailing slash


function slugitizer( $string ) {
   return strtolower( str_replace( " ", "-", preg_replace( "/[^a-zA-Z0-9 ]/", "", $string ) ) );
}

header( 'Content-Description: File Transfer' );
header( 'Content-Disposition: attachment; filename=IMPORT-XML-' . $_GET['number'] . '.xml' );
header( 'Content-Type: application/xml; charset=UTF-8' );
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";

?> 

<rss version="2.0"
	xmlns:excerpt="http://wordpress.org/export/1.0/excerpt/"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:wp="http://wordpress.org/export/1.0/"
>

<channel>
	<title>My Site</title>
	<link>http://example.com/</link>
	<description></description>
	<pubDate>Thu, 28 May 2009 16:06:40 +0000</pubDate>
	<generator>http://wordpress.org/?v=2.7.1</generator>
	<language>en</language>
	<wp:wxr_version>1.0</wp:wxr_version>
	<wp:base_site_url>http://example.com/</wp:base_site_url>
	<wp:base_blog_url>http://example.com/</wp:base_blog_url>
<?

$connect = mysql_connect( "localhost", "u", "p" ) or die( mysql_error( ) );
mysql_select_db( "my_db" ) or die( mysql_error( ) );
mysql_set_charset( 'utf8', $connect ); 
$limit = ( $_GET['number'] - 1 ) * 1000;
$result = mysql_query("SELECT * FROM my_posts
	WHERE MY MYSQL QUERY

	ORDER BY ID ASC
	LIMIT " . $limit . ",1000");
	
while( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {
	//Set some variables for the post
	$post_id = ;
	$post_title = ;
	$tags = array( );
	$date_created = ;
	$author = ;
	$post_excerpt = ;
	$subhed = ;
	$categories = array( );
	$post_content = ;
	
	$images = array(
		array(
			'photo_id' => 12345,
			'photo_path' => 'http://example.com/images/full-uncropped-image-path.jpg',
			'photo_title' => 'Title for the photo (could be name of photo)',
			'photo_caption' => 'Full caption',
			'photo_description' => 'Description, which could include caption and additional information',
			'photo_credit' => 'Photographer Name',
			'photo_date' => ,
		),
	
	);


	//We're going to standardize some fields and replace some characters that can cause problems
	//left single curly quote, right single curly quote, left double curly quote, right double curly quote and emdash
	$originalchars = array( chr(145), chr(146), chr(147), chr(148), chr(151) );
	$replacechars = array( '&lsquo;','&rsquo;','&ldquo;','&rdquo;','&mdash;' );
	
	$slug = slugitizer( $post_title );
	$post_title = str_replace( "’", "&rsquo;", str_replace( "‘", "&lsquo;", strip_tags( $post_title ) ) );
	$unixtime = strtotime( $date_created );
	$pubdate = date( 'D, d M Y H:i:s', $unixtime )." +0000";
	$post_date = date( 'Y-m-d H:i:s', $unixtime );
	$month = date('m', $unixtime);
	$day = date('d', $unixtime);
	$year = date('Y', $unixtime);

?>
	<item>
		<title><![CDATA[<?php echo $post_title; ?>]]></title>
		
		<link><?php echo $site_url; ?><?php echo $year; ?>/<?php echo $month; ?>/<?php echo $day; ?>/<?php echo $slug; ?>/</link>
		<pubDate><?php echo $pubdate; ?></pubDate>

		<?php if( in_array( $author, $accepted_authors ) ) { ?>
			<dc:creator><![CDATA[<?php echo trim( $author ); ?>]]></dc:creator>
		<?php } else { ?>
			<dc:creator><![CDATA[<?php echo default_author; ?>]]></dc:creator>
			<wp:postmeta>
				<wp:meta_key>_byline</wp:meta_key>
				<wp:meta_value><?php echo $author; ?></wp:meta_value>
			</wp:postmeta>
		<?php } ?>

		<?php
		foreach ($categories as $category) {
			if ( !empty( $category ) ) {
				$category = trim( $category );
				$cat_slug = slugitizer( $category );
				?>
				<category><![CDATA[<?php echo $category; ?>]]></category>
				<category domain="category" nicename="<?php echo $cat_slug; ?>"><![CDATA[<?php echo $category; ?>]]></category>
			<?php
			}
		}
		?>

		<?php
		foreach ( $tags as $tag ) {
			if( !empty( $tag )) {
			$tag_slug = slugitizer( $tag );
			?>

				<category domain="tag" nicename="<?php echo $tag_slug; ?>"><![CDATA[<?php echo $tag; ?>]]></category>
			
			<?php
			}
		}
		?>
	
		<guid isPermaLink="false"><?php echo $site_url; ?>?p=<?php echo $post_id; ?></guid>
		<description></description>
		<content:encoded><![CDATA[<?php echo $post_content; ?>]]></content:encoded>
		<excerpt:encoded><![CDATA[<?php echo $post_excerpt; ?>]]></excerpt:encoded>
		<wp:post_id><?php echo $post_id; ?></wp:post_id>
		<wp:post_date><?php echo $post_date; ?></wp:post_date>
		<wp:post_date_gmt><?php echo $post_date; ?></wp:post_date_gmt>
		<wp:comment_status>open</wp:comment_status>
		<wp:ping_status>closed</wp:ping_status>
		<wp:post_name><?php echo $slug; ?></wp:post_name>

		<wp:status>publish</wp:status>
		<wp:post_parent>0</wp:post_parent>
		<wp:menu_order>0</wp:menu_order>
		<wp:post_type>post</wp:post_type>
		<wp:post_password></wp:post_password>
		
		<wp:postmeta>
			<wp:meta_key>_old_id</wp:meta_key>
			<wp:meta_value><?php echo $post_id; ?></wp:meta_value>
		</wp:postmeta>

		<wp:postmeta>
			<wp:meta_key>_subheadline</wp:meta_key>
			<wp:meta_value><![CDATA[<?php echo $subhed; ?>]]></wp:meta_value>
		</wp:postmeta>

	</item>
		

	<?php
	//Now we'll loop through all the photos and put them in the same XML file
	foreach( $photos as $photo ) {
		$parent = $post_id;
		$photo_id = $photo[ 'photo_id' ];
		$image_path = $photo[ 'photo_path' ];
		$filename = $photo[ 'photo_title' ];
		$caption = $photo[ 'photo_caption' ];
		$description = $photo[ 'photo_description' ];
		$credit = $photo[ 'photo_credit' ];
		$unixtime = strtotime( $photo[ 'photo_date' ] );
		$photo_date = date( 'Y-m-d H:i:s', $unixtime );
		$pubdate = date( 'D, d M Y H:i:s', $unixtime ) . " +0000";
		?>
		
		<item>
			<title><![CDATA[<?php echo $filename; ?>]]></title>
				<link><?php echo $site_url; ?>?attachment_id=<?=$photo_id ?></link>
				<pubDate><?php echo $pubdate; ?></pubDate>
				
				<guid isPermaLink="false"><?php echo $image_path ?></guid>
				<description></description>
				<content:encoded><![CDATA[<?php echo $description; ?>]]></content:encoded>
				<excerpt:encoded><![CDATA[<?php echo $caption; ?>]]></excerpt:encoded>
				<wp:post_id><?php echo $photo_id; ?></wp:post_id>
				<wp:post_date><?php echo $photo_date; ?></wp:post_date>
				<wp:post_date_gmt><?php echo $photo_date; ?></wp:post_date_gmt>
				<wp:comment_status>open</wp:comment_status>
				<wp:ping_status>open</wp:ping_status>
				<wp:post_name></wp:post_name>
				<wp:status>inherit</wp:status>
				<wp:post_parent><?php echo $parent; ?></wp:post_parent>
				<wp:menu_order>0</wp:menu_order>
				<wp:post_type>attachment</wp:post_type>
				<wp:post_password></wp:post_password>
				<wp:is_sticky>0</wp:is_sticky>
				<wp:attachment_url><?php echo $image_path ?></wp:attachment_url>
				
				<?php if( in_array( $credit, $accepted_authors ) ) { ?>
					<dc:creator><![CDATA[<?php echo trim( $credit ); ?>]]></dc:creator>
				<?php } else { ?>
					<wp:postmeta>
						<wp:meta_key>_media_credit</wp:meta_key>
						<wp:meta_value><?php echo trim( $credit ); ?></wp:meta_value>
					</wp:postmeta>
				<?php } ?>
				
		</item>
			<?php
	}
}
?>

</channel>
</rss>

