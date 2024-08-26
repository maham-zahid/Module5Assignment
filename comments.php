<?php
/**
 * The template for displaying Comments.
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    
    static $heading_displayed = false;
    
    if ( have_comments() ) :

        
        if ( ! $heading_displayed ) :
            ?>
            <hr class="divider-line comments-divider">
            <h2 class="comments-heading">Comments</h2>
            <hr class="divider-line comments-divider">
            <?php
            $heading_displayed = true;
        endif;
        
        ?>
        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'callback'    => 'custom_comment_format',
                'type'        => 'comment',
            ) );
            ?>
        </ol>

        
        <hr class="comments-form-divider">

        <h3 class="comment-form-heading"><?php _e('Post Your Comment', 'wp-blog-theme'); ?></h3>

        <div class="comment-form-container">
            <?php
            comment_form(array(
                'title_reply' => '', 
                'comment_field' => '<p class="comment-form-field"><label for="comment">' . __('Comment *', 'wp-blog-theme') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
                'fields' => array(
                    'author' => '<div class="comment-meta-fields-wrapper">
                                    <div class="comment-meta-field">
                                        <label for="author">' . __('Name *', 'wp-blog-theme') . '</label>
                                        <input id="author" name="author" type="text" value="" aria-required="true">
                                    </div>',
                    'email' => '<div class="comment-meta-field">
                                    <label for="email">' . __('Email *', 'wp-blog-theme') . '</label>
                                    <input id="email" name="email" type="text" value="" aria-required="true">
                                </div>',
                    'url' => '<div class="comment-meta-field">
                                    <label for="url">' . __('Website', 'wp-blog-theme') . '</label>
                                    <input id="url" name="url" type="text" value="">
                                </div>
                            </div>', 
                ),
                'class_submit' => 'comment-submit-button',
                'submit_button' => '<input type="submit" class="%1$s" id="%2$s" value="Submit">',
            ));
            ?>
        </div>

    <?php else: ?>
        <div class="comment-form-container">
            <?php comment_form(); ?>
        </div>
    <?php endif; ?>

</div>
