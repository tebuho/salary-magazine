<?php if(!empty($data['comments']) ) : ?>
    <div class="label-container mt-3">
        <label for="closing_date">Comments</label>
    </div>
    
        <?php echo error('comment_error'); ?>
        <div class="comments-card__holder border mt-3 pb-3 pr-3">
        <?php foreach ($data['comments'] as $comment) : ?>
        <div class="img-card__container pt-3 comment-card pl-3">
            <div class="pb-0 pl-0 pr-0">
                <div class="avatar-container">
                    <p class="comment-user mb-0">
                        <a href="<?php echo URLROOT; ?>/abantu/cv/<?php echo $comment->id_yomntu ?>">
                            <?php echo $comment->igama; ?> <?php echo $comment->fani; ?>
                        </a>
                        <small class="timeline-date"> nge <?php echo $date->convertDayDate($comment->updated_at); ?> ka <?php echo $date->convertMonthYear($comment->updated_at); ?></small>
                    </p>
                    
                    <small><?php echo !empty($comment->zazise) ? $comment->zazise : ""; ?></small>
                </div>
                <div class="card-body bg-light p-3 mt-2 rounded">
                    <div class="card-text">
                        <p><?php echo $comment->comment; ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
        </div>
<?php endif; ?>