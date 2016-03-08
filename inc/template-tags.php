<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package brandi
 */

if ( ! function_exists( 'brandi_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function brandi_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
                           esc_attr( get_the_date( 'c' ) ),
                           esc_html( get_the_date() ),
                           esc_attr( get_the_modified_date( 'c' ) ),
                           esc_html( get_the_modified_date() )
                          );

    $posted_on = sprintf(
        __( '<i class="glyphicon glyphicon-calendar post-meta-icon"></i> %s', 'post date', 'brandi' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    $byline = sprintf(
        __( '<i class="glyphicon glyphicon-user post-meta-icon"></i> %s', 'post author', 'brandi' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'brandi_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function brandi_entry_footer() {
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( esc_html__( ', ', 'brandi' ) );
        if ( $categories_list && brandi_categorized_blog() ) {
            printf( '<span class="cat-links">' . __( '<i class="glyphicon glyphicon-folder-close post-meta-icon"></i> %1$s ', 'brandi' ) . '</span>', $categories_list ); // WPCS: XSS OK.
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html__( ', ', 'brandi' ) );
        if ( $tags_list ) {
            printf( '<span class="tags-links">' . __( '<i class="glyphicon glyphicon-tags post-meta-icon"></i> %1$s', 'brandi' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        }
    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link( esc_html__( 'Leave a comment', 'brandi' ), esc_html__( '1 Comment', 'brandi' ), esc_html__( '% Comments', 'brandi' ) );
        echo '</span>';
    }

    edit_post_link(
        sprintf(
            /* translators: %s: Name of current post */
            esc_html__( 'Edit %s', 'brandi' ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ),
        '<span class="edit-link">',
        '</span>'
    );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function brandi_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'brandi_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'brandi_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so brandi_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so brandi_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in brandi_categorized_blog.
 */
function brandi_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'brandi_categories' );
}
add_action( 'edit_category', 'brandi_category_transient_flusher' );
add_action( 'save_post',     'brandi_category_transient_flusher' );

/**
 * The posts navigation found in the blog list
 */
function brandi_get_the_posts_navigation( $args = array() ){
    /*$navigation = '';

    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
        $args = wp_parse_args( $args, array(
            'prev_text'          => __( 'Older posts' ),
            'next_text'          => __( 'Newer posts' ),
            'screen_reader_text' => __( 'Posts navigation' ),
        ) );

        $next_link = get_previous_posts_link( $args['next_text'] );
        $prev_link = get_next_posts_link( $args['prev_text'] );

        if ( $prev_link ) {
            $navigation .= '<div class="nav-previous">' . $prev_link . '</div>';
        }

        if ( $next_link ) {
            $navigation .= '<div class="nav-next">' . $next_link . '</div>';
        }

        $navigation = _navigation_markup( $navigation, 'posts-navigation', $args['screen_reader_text'] );
    }

    return $navigation;*/

    if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
        $args = wp_parse_args( $args, array(
            'prev_text'          => __( 'Older posts' ),
            'next_text'          => __( 'Newer posts' ),
            'screen_reader_text' => __( 'Posts navigation' ),
        ) );

        $next_link = get_previous_posts_link( $args['next_text'] . ' <span aria-hidden="true">&rarr;</span>'  );
        $prev_link = get_next_posts_link( '<span aria-hidden="true">&larr;</span> ' . $args['prev_text'] );
        
        ob_start();

        ?>

            <nav class="navigation posts-navigation" role="navigation">

                <h2 class="sr-only"><?php echo $args['screen_reader_text']; ?></h2>
                <ul class="pager posts-pager">
                    <?php if ( $prev_link ): ?>
                        <li class="previous"><?php echo $prev_link; ?></li>
                    <?php endif; ?>
                    
                    <?php if ( $next_link ): ?>
                        <li class="next"><?php echo $next_link; ?></li>
                    <?php endif; ?>
                </ul>

            </nav>

        <?php
        
    }

    echo ob_get_clean();

}