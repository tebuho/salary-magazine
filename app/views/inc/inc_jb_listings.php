<?php $date = new Convert; ?>

<div class="main-content">
    <div class="body-container container">
        <?php require APPROOT .'/views/inc/right-side_home.php'; ?>
        <div class="center-side col-md-7">
            <div class="top-ad">
                <?php require APPROOT .'/views/inc/top_ad.php'; ?>
            </div>    
            <section class="section-search__imisebenzi pt-1 pb-3 highlight-grey d-none">
                <div class="container p-0">
                    <div class="section-search__form pt-2 m-auto">
                        <form action="<?php echo URLROOT; ?>/<?php echo $province_slug; ?>/search" method="GET">
                            <div class="col search-imisebenzi mt-3 col-sm-12 search-home pl-0">
                                <input type="text" name="search" class="mb-0 form-control form-control-lg" placeholder="Ukhangela ntoni? Bhala apha and search" autofocus>
                                <button type="submit" class="btn btn btn-info">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <?php require  APPROOT .'/views/inc/jb_province_index.php'; ?>
        </div>
        <?php require APPROOT ."/views/inc/filter.php"; ?>
    </div>
</div>