<?php require APPROOT .'/views/inc/header.php'; ?>
<?php $date = new Convert; ?>
<div class="main-content add-job">
    <div class="page container">
        <div class="page-container">
            <a href="<?php echo URLROOT; ?>/blogs"><span>Buyela emva</span></a>
        </div>
    </div>
        <!-- Start AdSense -->
        <?php require APPROOT .'/views/inc/infeed-ad.php'; ?>
        <!-- End AdSense -->

        <div class="body-container container">
            <div class="right-side col-md-3">
                <div class="sidebar-container">
                    <h3>Please note</h3>
                    <hr />
                    <p>This website is written in isiXhosa. For the English version please click on English.</p>
                </div>
            </div>
            <div class="center-side col-md-8">
                    <?php echo flash('message_ye_blog'); ?>
                    <?php echo flash('comment_error'); ?>
                    <div class="card-lo-msebenzi heading-container">
                        <div class="content-container">
                            <div class="img-card__container pt-2 mb-3">
                                <div class="avatar-container">
                                    <span><?php echo $data['body']->igama; ?> <?php echo $data['body']->fani; ?></span><br>
                                    <span class="timeline-date"><?php echo $date->convertDayDate($data['body']->pub_date); ?> ka <?php echo $date->convertMonthYear($data['body']->pub_date); ?></span>
                                </div>
                                <?php if (isset($_SESSION['id_yomntu']) && $data['body']->id_yomntu == $_SESSION['id_yomntu']) : ?>
                                    <div class="follow">
                                        <a href="<?php echo URLROOT; ?>/blogs/edit/<?php echo $data['body']->blogId; ?>" class="edit-link follow-btn">Edit</a>
                                    </div>
                                <?php endif; ?>
                                <br>
                                <!-- <h2><?php echo "<a href='" . URLROOT ."/blogs/phendula/" . $data['body']->blogId . "'>" . $data['body']->title . "</a>"; ?></h2> -->
                                <?php echo $data['body']->body; ?>
                            </div>
                            <?php require APPROOT .'/views/blogs/comments.php'; ?>
                            <?php require APPROOT .'/views/blogs/phendula.php'; ?>
                        </div>
                    </div>
                </div>
                <div class="left-side col-md-1">
                    <?php require APPROOT .'/views/inc/adsense-sidebar.php'; ?>
                </div>
            </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>