<div class="left-side col-md-3" style="visibility: visible">
    <div class="empty"></div>
    <div class="highlight-grey">
        <?php if(isset($provinces_name)) : ?>
            <h1 class="page-container"><?php echo $provinces_name;?></h1>
        <?php endif; ?>
        <div class="province-header mb-1">
            <h3 class="label">Ndawoni</h3>
        </div>
        <div class="province-container filter-container">
            <ul class="province filter jb-recommend" id="job_location">
                <?php foreach ($data['job_location'] as $job_location) : ?>
                <li class="p-0"><a href="<?php echo URLROOT . '/' .$province_slug . '/job_location/' . $job_location->job_location_slug . "/"; ?>"><?php echo $job_location->job_location; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="province-header mb-1">
            <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="onjani" href="#onjani" class="collapsed jb-collapse">
                <span class="label">Imisebenzi Enjani</span>
                <span class="rsaquo">&rsaquo;</span>
            </a>
        </div>
        <div class="province-container filter-container">
            <ul class="province filter multi-collapse collapse" id="onjani">
                <?php foreach ($data['onjani'] as $onjani) : ?>
                <li><a href="<?php echo URLROOT . '/' .$province_slug . '/onjani/' . $onjani->job_type_slug . "/"; ?>"><?php echo $onjani->job_type; ?> (<?php echo $onjani->count; ?>)</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- <div class="province-header mb-1">
            <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="ijob_education" href="#ijob_education" class="collapsed jb-collapse">
                <span class="label">Ijob_education</span>
                <span class="rsaquo">&rsaquo;</span>
            </a>
        </div>
        <div class="province-container filter-container">
            <ul class="province filter multi-collapse collapse" id="ijob_education">
                <?php foreach ($data['job_education'] as $job_education) : ?>
                <li><a href="<?php echo URLROOT . '/' .$province_slug . '/job_education/' . $job_education->job_education_slug . "/"; ?>"><?php echo $job_education->job_education; ?> (<?php echo $job_education->count; ?>)</a></li>
                <?php endforeach; ?>
            </ul>
        </div>   
        <div class="province-header mb-1">
            <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="experience" href="#experience" class="collapsed jb-collapse">
                <span class="label">Experience</span>
                <span class="rsaquo">&rsaquo;</span>
            </a>
        </div>
        <div class="province-container filter-container">
            <ul class="province filter multi-collapse collapse" id="experience">
                <?php foreach ($data['experience'] as $experience) : ?>
                <li><a href="<?php echo URLROOT . '/' .$province_slug . '/experience/' . $experience->experience_slug . "/"; ?>"><?php echo $experience->experience; ?> (<?php echo $experience->count; ?>)</a></li>
                <?php endforeach; ?>
            </ul>
        </div> -->
        <div class="province-header mb-1">
        <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="owantoni" href="#owantoni" class="collapsed jb-collapse">
            <span class="label">Imisebenzi Yantoni</span>
            <span class="rsaquo">&rsaquo;</span>
        </a>
        </div>
        <div class="province-container filter-container">
            <ul class="province filter multi-collapse collapse" id="owantoni">
                <?php foreach ($data['category'] as $job_category) : ?>
                <li><a href="<?php echo URLROOT . '/' .$province_slug . '/category/' . $job_category->job_category_slug . "/"; ?>"><?php echo $job_category->job_category; ?> (<?php echo $job_category->count; ?>)</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="province-header mb-1">
        <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="provinces" href="#provinces" class="collapsed jb-collapse">
            <span class="label">Kweyiphi Province</span>
            <span class="rsaquo">&rsaquo;</span>
        </a>
        </div>
        <div class="province-container filter-container mb-3">
            <ul class="province filter multi-collapse collapse" id="provinces">
                <?php foreach ($data['provinces'] as $province) : ?>
                <li><a href="<?php echo URLROOT . '/' . $province->province_slug . '/'; ?>"><?php echo $province->province; ?> (<?php echo $province->count; ?>)</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php require APPROOT .'/views/inc/adsense-sidebar.php'; ?>
</div>