<div id="comments">
<?php if ( post_password_required() ) : ?>
    <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.' ); ?></p>
</div><!-- #comments -->
<?php
	return;
endif;
?>
<?php if ( get_comments_number() ) : ?>
    <h3 id="comments-title"><?php
    printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number() ),
    number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
    ?></h3>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <div class="navigation">
            <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>' ) ); ?></div>
        </div>
    <?php endif; ?>

    <ol class="commentlist">
        <?php wp_list_comments( array( 'callback' => '_rrze_list_comments' ) ); ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <div class="navigation">
            <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Ältere Kommentare' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>' ) ); ?></div>
        </div>
    <?php endif; ?>

<?php else : ?>
	<?php if ( ! comments_open() ) : ?>
        <p class="nocomments"><?php _e( 'Comments are closed.' ); ?></p>
    <?php endif; ?>

<?php endif; ?>

<?php comment_form(); ?>

</div><!-- #comments -->
