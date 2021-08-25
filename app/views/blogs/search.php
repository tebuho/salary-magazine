<?php require APPROOT .'/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/chatroom-navbar.php'; ?>
<?php $date = new Convert; ?>
    <div class="main-content">
        <div class="page container search-province">
            <div class="page-container">
                <h1>Blogs Results</h1>
            </div>
            <div class="page-container page-container__search">
                <form action="<?php echo URLROOT; ?>/blogs/search" method="get" class="form-inline">
                    <input class="job-search form-control" name="search" type="search" placeholder="<?php echo $_GET['search']; ?>">
                    <button class="job-search__btn">Search</button>
                </form>
            </div>
        </div>
        <div class="body-container container">
            <div class="right-side profile-sidebar">
                <div class="sidebar-container">
                    <h3>Please note</h3>
                    <hr />
                    <p>This website is written in isiXhosa. For the English version please click on English.</p>
                </div>
            </div>
            <div class="center-side profile-content">
                <div class="card-lo-msebenzi heading-container card-lokubuza">
                    <div class="user-feed__meta">
                        <div class="add-content">
                            Cofa apha if ufuna ukubhala i-blog yakho.&nbsp;<a href="<?php echo URLROOT .'/blogs/bhala'; ?>">Cofa apha</a>
                        </div>
                    </div>
                </div>
                <?php foreach ($data['blogs'] as $blog): ?>
                    <?php echo flash('message_ye_blog'); ?>
                    <div class="card-lo-msebenzi heading-container timeline-card">
                        <div class="user-feed__meta">
                            <div class="avatar-container">
                                <h5><?php echo $blog->igama; ?></h5>
                            </div>
                            <div class="avatar-container">
                                <a href='<?php echo URLROOT ."/blogs/phendula/$blog->blogId"; ?>'>&nbsp;<span class="timeline-date"><?php echo $date->convertDayDate($blog->pub_date); ?> ka <?php echo $date->convertMonthYear($blog->pub_date); ?></span></a>
                            </div>
                            <?php if (isset($_SESSION['id_yomntu']) && $blog->id_yomntu == $_SESSION['id_yomntu']) : ?>
                                <div class="follow">
                                    <a href="<?php echo URLROOT; ?>/blogs/edit/<?php echo $blog->blogId; ?>" class="edit-link follow-btn">Edit</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="content-container">
                            <div class="img-card__container pt-2">
                                <h2><?php echo $blog->title; ?></h2>
                                <p>
                                    <?php echo substr($blog->body, 0, 140); ?><?php echo strlen($blog->body) > 140 ? "... <a href='" . URLROOT ."blogs/phendula/" . $blog->blogId . "'>cofa apha</a>" : ''; ?>
                                </p>
                                <a class="img-blog__index" href='<?php echo URLROOT ."/blogs/phendula/$blog->blogId"; ?>'>
                                    <img src="<?php echo URLROOT; ?>/img/blogs/<?php echo $blog->image; ?>" alt="<?php echo $blog->title; ?>">
                                </a>
                            </div>
                            <div class="social-commentary">
                                <div class="user-to__do">
                                    <a href='<?php echo URLROOT ."/blogs/phendula/$blog->blogId"; ?>'>
                                        <i class="far fa-comment-alt"></i> Phendula
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="left-side">
                <div class="province-header">
                    <h4>Profile</h4>
                </div>
                <div class="province-container filter-container">
                    <ul class="province filter">
                        <li><a href="">About</a></li>
                        <li><a href="">CV</a></li>
                        <li><a href="">Imisebenzi</a></li>
                        <li><a href="">blogs</a></li>
                        <li><a href="">Izikhalazo</a></li>
                        <li><a href="">Abantu</a></li>
                        <li><a href="">Images</a></li>
                        <li><a href="">Magazine</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>