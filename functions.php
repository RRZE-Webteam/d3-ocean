<?php
function _rrze_setup() {
    
	add_theme_support( 'automatic-feed-links' );
    
    add_theme_support( 'post-formats', array( 'gallery' ) );
    
    add_theme_support( 'post-thumbnails' );
        
}

add_action( 'after_setup_theme', '_rrze_setup' );

function _rrze_widgets_init() {
    // sidebar-1
    register_sidebar( array(
        'name' => __( 'Bereichsmenü' ),
        'description'   => __( 'Dieser Bereich ist für der Bereichsmenü (linke Spalte) vorgesehen.' ),
        'before_widget' => '<li>',
        'after_widget' => '</ul></li>',
        'before_title' => '<span class="aktiv">',
        'after_title' => '</span><ul>',
    ));

    // sidebar-2
    register_sidebar( array(
        'name' => __( 'Zielgruppennavigation' ),
        'description' => __( 'Dieser Bereich ist für die Zielgruppennavigation (im Kopfteil) vorgesehen.' ),
        'before_widget' => '<div class="space">',
        'after_widget' => '</div>',
        'before_title' => '<!--',
        'after_title' => '-->',
    ));

    // sidebar-3
    register_sidebar( array(
        'name' => __( 'Kurzinfo' ),
        'description' => __( 'Dieser Bereich ist für die Kurzinformationen (unter Bereichsmenü) vorgesehen.' ),
        'before_widget' => '<div class="blog">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    // sidebar-4
    register_sidebar( array(
        'name' => __( 'Zusatzinfo' ),
        'description' => __( 'Dieser Bereich ist für die Zusatzinformationen (im Fußteil) vorgesehen. Hier könnten hilfreiche Links oder sonstige Informationen stehen, welche auf jeder Seite eingeblendet werden sollen. Diese Angaben werden bei der Ausgabe auf dem Drucker nicht mit ausgegeben!' ),
        'before_widget' => '<div class="blog">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
}

add_action( 'widgets_init', '_rrze_widgets_init' );

function _rrze_list_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), ' ' ); ?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
