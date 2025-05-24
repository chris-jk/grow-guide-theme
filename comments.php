<?php
/**
 * Comments Template
 */

if (post_password_required()) {
    return;
}
?>

<div class="comments-area" id="comments">
    <?php if (have_comments()): ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number == 1) {
                echo '1 Comment';
            } else {
                echo $comments_number . ' Comments';
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 50,
                'callback' => 'generic_comment_callback'
            ));
            ?>
        </ol>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
            <nav class="comment-navigation">
                <div class="nav-previous"><?php previous_comments_link('← Older Comments'); ?></div>
                <div class="nav-next"><?php next_comments_link('Newer Comments →'); ?></div>
            </nav>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
        <p class="no-comments">Comments are closed.</p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply' => 'Leave a Comment',
        'title_reply_to' => 'Reply to %s',
        'cancel_reply_link' => 'Cancel Reply',
        'label_submit' => 'Post Comment',
        'comment_field' => '<div class="comment-form-comment"><label for="comment">Comment *</label><textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required></textarea></div>',
        'fields' => array(
            'author' => '<div class="comment-form-author"><label for="author">Name *</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245" required /></div>',
            'email' => '<div class="comment-form-email"><label for="email">Email *</label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes" required /></div>',
            'url' => '<div class="comment-form-url"><label for="url">Website</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" /></div>',
        ),
    ));
    ?>
</div>
