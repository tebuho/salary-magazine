
<div class="bhalisa-ngena__form pl-0 pr-0">
    <?php if (!isset($_SESSION['id_yomntu']) || empty($_SESSION['id_yomntu']) ): ?>
        <a href="<?php echo URLROOT; ?>/abantu/login">Login to Comment</a>
    <?php else: ?>
        <?php echo flash('message_yomsebenzi'); ?>
        <form action="<?php echo URLROOT; ?>/<?php echo $_GET['url']; ?>" method="post">
            <div class="form-container">
                <div class="input-label__container mb-3">
                    <div class="label-container">
                        <label for="closing_date">Comment</label>
                    </div>
                    <div class="input-container">
                        <textarea name="comment" id="comment" class="form-control <?php echo (!empty($data['comment_err'])) ? 'is-invalid' : ''; ?>" required="required">  
                        </textarea>
                        <span class="invalid-feedback"><?php echo $data['comment_err'] ?></span>
                        <script>
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'comment' );
                        </script>
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="input-container ">
                        <button class="form-btn__primary btn-block">Cofa xa Ugqibile</button>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>