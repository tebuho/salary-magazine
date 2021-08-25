<?php require APPROOT .'/views/inc/header.php'; ?>
    <div class="main-content outer">
        <div class="container">
            <div class="col-md-12">
                <h1>Employers</h1>
            </div>
        </div>
        <div class="body-container container">
            <?php require APPROOT .'/views/inc/right-side_home.php'; ?>
            <div class="center-side col-md-6">
                <div class="top-ad">
                    <?php require APPROOT .'/views/inc/top_ad.php'; ?>
                </div>    
                <div class="profile-content m-0">
                    <section class="section-search__imisebenzi pt-1 pb-3 highlight-grey">
                        <div class="container p-0">
                            <div class="section-search__form pt-2 m-auto">
                                <form action="<?php echo URLROOT; ?>/employers/search" method="POST">
                                    <div class="col search-imisebenzi mt-3 col-sm-12 search-home pl-0">
                                        <input type="text" name="search" class="mb-0 form-control form-control-lg" placeholder="Ukhangela ntoni? Bhala apha and search" autofocus>
                                        <button type="submit" class="btn btn-primary-sm">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                    <?php include  APPROOT .'/views/inc/pagination.php'; ?>
                    <?php echo flash('message_yomsebenzi'); ?>
                    <div class="highlight-grey">
                            <?php
                                if(!empty($data['employers'])) {
                                    for ($x = 0; $x < count($data['employers']); $x++) {
                                        if($x === 6 && count($data['employers']) >= 12 || $x === 11) {
                                            require APPROOT .'/views/inc/infeed-ad.php';
                                        }
                                        ?>
                                        <div class="card-lo-msebenzi heading-container pr-0 pl-0">
                                            <div class="job-meta">
                                                <div class="job-meta_tags">
                                                    <span class="badge badge-light"><?php echo $data['employers'][$x]->type; ?></span>
                                                </div>
                                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") : ?>
                                                    <div class="follow">
                                                        <a href="<?php echo URLROOT; ?>/employers/edit/<?php echo $data['employers'][$x]->employer_slug; ?>" class="edit-link follow-btn">Edit</a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="job-title__index">
                                                <div class="label">
                                                    <a href="<?php echo URLROOT; ?>/employers/employer/<?php echo $data['employers'][$x]->employer_slug; ?>" class="umsebenzi-card__title">
                                                        <h6><?php echo $data['employers'][$x]->employer; ?></h6>
                                                    </a>
                                                    <p><?php echo count(explode(", ", $data['employers'][$x]->provinces)) == 9 ? "All Provinces" : $data['employers'][$x]->provinces; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                            } ?>
                    </div>
                    <?php include  APPROOT .'/views/inc/pagination.php'; ?>
                </div>
            </div>
        <?php require APPROOT ."/views/employers/filter.php"; ?>
        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>