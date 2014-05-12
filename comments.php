<?php
/*
 * The template for displaying Comments.
 *
 * @package WordPress
 * @subpackage Zemplate
 * @since Zemplate 2.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required())
    return;
?>

<div class="comments__list">

    <?php if (have_comments()) : ?>
        <h2>
            <?php printf(  'One comment on &ldquo;%2$s&rdquo;',
                            '%1$s comments on &ldquo;%2$s&rdquo;',
                            get_comments_number(),
                            number_format_i18n(get_comments_number()),
                            get_the_title()
               ); ?>
        </h2>

        <ol>
            <?php wp_list_comments('type=comment&callback=zemplate_comment'); ?>
        </ol>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
            <nav class="navigation" role="navigation">
                <h1 class="assistive-text section-heading"><?php echo 'Comment navigation'; ?></h1>
                <div class="nav-previous"><?php previous_comments_link('&larr; Older Comments'); ?></div>
                <div class="nav-next"><?php next_comments_link('Newer Comments &rarr;'); ?></div>
            </nav>
        <?php endif; // check for comment navigation ?>

        <?php
        /* If there are no comments and comments are closed, let's leave a note.
         * But we only want the note on posts and pages that had comments in the first place.
         */
        if (! comments_open() && get_comments_number()) : ?>
            <p><?php echo 'Comments are closed.'; ?></p>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php $args = array(
            comment_notes_after => '',
            comment_field => '<textarea placeholder="Comment" cols="45" rows="8" name="comment" aria-required="true"></textarea>'
       );
        comment_form($args);
    ?>

</div><!-- comments__list -->