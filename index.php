<?php get_header(); ?>

<!-- MENU ********************************************************************* -->
<!-- ************************************************************************** -->
<div id="main">
    <div id="menu">
        <div id="bereichsmenu">
            <h2><a name="bereichsmenumarke" id="bereichsmenumarke">Bereichsmenu</a></h2>
            <?php get_sidebar(); ?>
        </div>
        <div id="kurzinfo" >
            <?php if (!dynamic_sidebar( 3 )) : ?>
                <div id="faulogo" class="logo">
                    <p>
                        <a title="To the portal of the Friedrich-Alexander-Universit&auml;t" href="http://www.uni-erlangen.de"><img src="<?php bloginfo('template_url') ?>/grafiken/fau.png" width="130" height="43" alt="Friedrich-Alexander - Universit&auml;t Erlangen-N&uuml;rnberg" /></a>
                    </p>
                </div>
                <div id="blogslogo" class="logo">
                    <p>
                        <a title="Blogs@FAU Homepage" href="/"><img src="<?php bloginfo('template_url') ?>/grafiken/blogs.png" width="120" height="81" alt="Blogs@FAU" /></a>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- CONTENT ****************************************************************** -->
    <!-- ************************************************************************** -->       
    <div id="content">

        <a name="contentmarke" id="contentmarke"></a>   
        <!-- Inhaltsinfo*************************************************************** -->
        <!-- ************************************************************************** -->       		
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php
        $posted_on = sprintf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s' ),
            'meta-prep meta-prep-author',
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr( get_the_time() ),
                get_the_date()
            ),
            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                esc_attr( sprintf( __( 'View all posts by %s' ), get_the_author() ) ),
                get_the_author()
            )
        );
        ?>
        <div class="post" id="post-<?php the_ID(); ?>">
        <?php if ( ! is_page() ): ?>
            <?php if ( ! is_single() ): ?>
            <h2 class="storytitle">
                <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>
            <?php endif; ?>
            <p class="meta">
            <?php echo $posted_on; ?>
            </p>
            <?php endif; ?>
            
            <div class="storycontent">
            <?php if( ! is_single() && has_post_format( 'gallery' ) ) : ?>

                <?php if ( post_password_required() ) : ?>
                    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>' ) ); ?>

                <?php else : ?>
                    <?php
                    $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
                    if ( $images ) :
                        $total_images = count( $images );
                        $image = array_shift( $images );
                        $image_img_tag = wp_get_attachment_image( $image->ID, 'medium', 0, array( 'class' => 'flexible bordered' ) );
                      ?>
                      <div class="post-content">
                        <div class="gallery-thumb">
                            <a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
                        </div>

                        <p>
                            <em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images ),
                                'href="' . esc_url( get_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
                                number_format_i18n( $total_images )
                            ); ?></em>
                        </p>
                      </div>
                  <?php endif; ?>
                  <?php the_excerpt(); ?>
                <?php endif; ?>  

            <?php else : ?>
                <?php the_content(__('(more...)')); ?>
                
            <?php endif; ?>
            </div>

            <?php if( is_single() ) : ?>
            <?php
                /* translators: used between list items, there is a space after the comma */
                $categories_list = get_the_category_list( __( ', ' ) );

                /* translators: used between list items, there is a space after the comma */
                $tag_list = get_the_tag_list( '', __( ', ' ) );
                if ( '' != $tag_list ) {
                    $utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.' );
                } elseif ( '' != $categories_list ) {
                    $utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.' );
                } else {
                    $utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.' );
                }
                
                $edit_post_link = get_edit_post_link();
                if( '' != $edit_post_link )
                    $edit_post_link = sprintf( ' <a href="%s">'.__( 'Edit' ).'</a>', $edit_post_link );
                
                printf(
                    '<p style="background: none repeat scroll 0 0 #E5E5E5;">'.$utility_text.' %7$s</p>',
                    $categories_list,
                    $tag_list,
                    esc_url( get_permalink() ),
                    the_title_attribute( 'echo=0' ),
                    get_the_author(),
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    $edit_post_link
                );
            ?>
            <?php else: ?>
            <p class="feedback">
                <?php wp_link_pages(); ?>
                <?php if (!post_password_required()) : ?>
                <?php comments_popup_link(false, __('Comments') . ' (1)', __('Comments') . ' (%)'); ?>&nbsp;
                <?php endif; ?>

            </p>
            <?php endif; ?>
        </div>

        <?php comments_template(); ?>

        <?php endwhile;       
        else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>

        <div class="navigation">
            <p><?php next_posts_link('<span class="meta-nav">&larr;</span> Older posts') ?></p>
            <p style="float: right;"><?php previous_posts_link('Newer posts <span class="meta-nav">&rarr;</span>') ?></p>           
        </div>

        <p class="noprint">
            <a href="#seitenmarke">Nach oben</a>
        </p>
        <hr id="vorfooter" />
    </div><!-- /content -->

</div><!-- /main --> 

<?php get_footer(); ?>
