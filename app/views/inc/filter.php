<div class="left-side col-md-2" style="visibility: visible">
    <div class="pr-3">
        <?php if (!empty($_SESSION) && $_SESSION["role"] === "Admin" ) : ?>
        <div class="left-btn mb-3">
            <a href="<?php echo URLROOT; ?>/addJobs/add" class="btn btn-info">
                <small><i class="fas fa-plus"></i></small>&nbsp;Add Job
            </a>
        </div>
        <?php endif; ?>
        <?php if(isset($provinces_name)) : ?>
            <h1 class="page-container"><?php echo $provinces_name;?></h1>
        <?php endif; ?>
        <div class="province-header mb-1">
            <h3 class="label"><i class="fas fa-map"></i>&nbsp;&nbsp;Province</h3>
        </a>
        </div>
        <div class="province-container filter-container">
            <form action="<?php echo URLROOT; ?>/search" method="get" class="province filter jb-recommend" id="provinces">
                <ul class="province filter jb-recommend p-0" id="province-filter">
                </ul>
            </form>
        </div>
        <div class="province-header mb-1">
            <h3 class="label"><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Location</h3>
        </div>
        <div class="province-container filter-container">
            <form action="<?php echo URLROOT; ?>/search" method="get" class="province filter jb-recommend" id="location">
                <ul class="province filter jb-recommend p-0" id="job_location">
                    <?php foreach ($data['job_location'] as $job_location) : ?>
                        <li>
                            <input type="checkbox" name="<?php echo $job_location->job_location; ?>" id="<?php echo $job_location->job_location_slug; ?>">
                                <label for="<?php echo $job_location->job_location_slug; ?>" class="m-0">
                                    <?php echo $job_location->job_location; ?>
                                </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </form>
        </div>
        
        <div class="province-header mb-1">
            <h3 class="label"><i class="fas fa-calendar-alt"></i></i>&nbsp;&nbsp;Type</h3>
        </div>
        <div class="province-container filter-container">
            <form action="<?php echo URLROOT; ?>/search" method="get" class="province filter jb-recommend" id="type">
                <ul class="province filter jb-recommend" id="onjani">
                    <?php foreach ($data['onjani'] as $onjani) : ?>
                        <li>
                            <input type="checkbox" name="<?php echo $onjani->job_type; ?>" id="<?php echo $onjani->job_type_slug; ?>">
                            <label for="<?php echo $onjani->job_type_slug; ?>"><?php echo $onjani->job_type; ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </form>
        </div>
        <div class="province-header mb-1">
            <h3 class="label"><i class="fas fa-book-reader"></i>&nbsp;&nbsp;Education</h3>
        </div>
        <div class="province-container filter-container">
            <form action="<?php echo URLROOT; ?>/search" method="get" class="province filter jb-recommend" id="type">
                <ul class="province filter jb-recommend" id="job_education">
                    <?php foreach ($data['job_education'] as $job_education) : ?>
                        <li>
                            <input type="checkbox" name="<?php echo  $job_education->job_education; ?>" id="<?php echo  $job_education->job_education_slug; ?>">
                            <label for="<?php echo $job_education->job_education_slug; ?>"><?php echo $job_education->job_education; ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </form>
        </div>
        <div class="province-header mb-1">
            <h3 class="label"><i class="fas fa-clock"></i>&nbsp;&nbsp;Experience</h3>
        </div>
        <div class="province-container filter-container">
            <form action="<?php echo URLROOT; ?>/search" method="get" class="province filter jb-recommend" id="type">
                <ul class="province filter jb-recommend" id="experience">
                    <?php foreach ($data['experience'] as $experience) : ?>
                        <li>
                            <input type="checkbox" name="<?php echo $experience->job_experience; ?>" id="<?php echo $experience->job_experience_slug; ?>">
                            <label for="<?php echo $experience->job_experience_slug; ?>"><?php echo $experience->job_experience_slug; ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </form>
        </div>
        <div class="province-header mb-1">
            <h3 class="label"><i class="fas fa-industry"></i>&nbsp;&nbsp;Category</h3>
        </a>
        </div>
        <div class="province-container filter-container">
            <form action="<?php echo URLROOT; ?>/search" method="get" class="province filter jb-recommend" id="type">
                <ul class="province filter jb-recommend" id="owantoni">
                    <?php foreach ($data['category'] as $job_category) : ?>
                        <li>
                            <input type="checkbox" name="<?php echo $job_category->job_category; ?>" id="<?php echo $job_category->job_category_slug; ?>">
                            <label for="<?php echo $job_category->job_category_slug; ?>"><?php echo $job_category->job_category; ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </form>
        </div>
    </div>
    <?php require APPROOT .'/views/inc/adsense-sidebar.php'; ?>
</div>