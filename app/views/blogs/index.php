<?php require APPROOT .'/views/inc/header.php'; ?>
<?php $date = new Convert; ?>
    <div class="main-content add-job">
        <div class="page container search-province">
            <div class="page-container">
                <h1>Chatroom</h1>
            </div>
            <div class="page-container page-container__search">
                <form action="<?php echo URLROOT; ?>/blogs/search" method="get" class="form-inline">
                    <input class="job-search form-control" name="search" type="search" placeholder="Search apha">
                    <button class="job-search__btn" name="submit">Search</button>
                </form>
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
            <div class="center-side col-md-7">
                <div class="card-lo-msebenzi heading-container card-lokubuza">
                    <div class="user-feed__meta">
                        <div class="add-content">
                            Buza ukuba ikhona into ofuna ukuyibuza. Uthethe ukuba ikhona into ofuna ukuyithetha.&nbsp;<a href="<?php echo URLROOT .'/blogs/bhala'; ?>">Cofa apha</a>
                        </div>
                    </div>
                </div>
                <?php foreach ($data['blogs'] as $blog): ?>
                    <?php echo flash('message_ye_blog'); ?>
                    <div class="card-lo-msebenzi heading-container blog-card">
                        <div class="content-container">
                            <div class="img-card__container pt-2">
                               <div class="content-preview p-3">
                                <div class="avatar-container">
                                        <span><?php echo $blog->igama; ?> <?php echo $blog->fani; ?></span><br>
                                        <span class="timeline-date"><?php echo $date->convertDayDate($blog->pub_date); ?> ka <?php echo $date->convertMonthYear($blog->pub_date); ?></span>
                                    </div>
                                    <?php if (isset($_SESSION['id_yomntu']) && $blog->id_yomntu == $_SESSION['id_yomntu']) : ?>
                                        <div class="follow">
                                            <a href="<?php echo URLROOT; ?>/blogs/edit/<?php echo $blog->blogId; ?>" class="edit-link follow-btn">Edit</a>
                                        </div>
                                    <?php endif; ?>
                                    <br>
                                    <!-- <h2><?php echo "<a href='" . URLROOT ."/blogs/phendula/" . $blog->blogId . "'>" . $blog->title . "</a>"; ?></h2> -->
                                    <?php echo implode(' ', array_slice(explode(' ', $blog->body), 0, 25)) . "..."; ?>
                                    <p><a href="<?php echo URLROOT ."/blogs/blog/$blog->slug"; ?>"><strong>Cofa apha</strong></a></p>
                               </div>
                                <div class="blog-image__holder">
                                    <?php if (!empty($blog->image)) : ?>
                                        <a class="img-blog__index" href='<?php echo URLROOT ."/blogs/blog/$blog->slug"; ?>'>
                                            <img src="<?php echo URLROOT; ?>/img/blogs/<?php echo $blog->image; ?>" alt="<?php echo $blog->title; ?>">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="left-side col-md-2">
                <?php require APPROOT .'/views/inc/adsense-sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>