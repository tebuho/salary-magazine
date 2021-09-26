<div class="left-side col-md-2" style="visibility: visible">
    <h4 class="filter-label">Select</h4>
    <div class="province-header">
        <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="ndawoni" href="#ndawoni" class="collapsed jb-collapse">
            <span class="label">Ndawoni</span>
            <span class="rsaquo">&rsaquo;</span>
        </a>
    </div>
    <div class="province-container filter-container">
        <ul class="province filter multi-collapse collapse" id="ndawoni">
            <?php foreach ($data['ndawoni'] as $job_location) : ?>
            <li><a href="<?php echo URLROOT . '/northernCapeJobs/ndawoni/' . $job_location->job_location_slug; ?>"><?php echo $job_location->ndawoni; ?> (<?php echo $job_location->count; ?>)</a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="province-header">
        <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="onjani" href="#onjani" class="collapsed jb-collapse">
            <span class="label">Onjani</span>
            <span class="rsaquo">&rsaquo;</span>
        </a>
    </div>
    <div class="province-container filter-container">
        <ul class="province filter multi-collapse collapse" id="onjani">
            <?php foreach ($data['onjani'] as $onjani) : ?>
            <li><a href="<?php echo URLROOT . '/northernCapeJobs/onjani/' . $onjani->job_type_slug; ?>"><?php echo $onjani->job_type; ?> (<?php echo $onjani->count; ?>)</a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="province-header">
        <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="ijob_education" href="#ijob_education" class="collapsed jb-collapse">
            <span class="label">Ijob_education</span>
            <span class="rsaquo">&rsaquo;</span>
        </a>
    </div>
    <div class="province-container filter-container">
        <ul class="province filter multi-collapse collapse" id="ijob_education">
            <?php foreach ($data['job_education'] as $job_education) : ?>
            <li><a href="<?php echo URLROOT . '/northernCapeJobs/job_education/' . $job_education->job_education_slug; ?>"><?php echo $job_education->job_education; ?> (<?php echo $job_education->count; ?>)</a></li>
            <?php endforeach; ?>
        </ul>
    </div>   
    <div class="province-header">
        <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="experience" href="#experience" class="collapsed jb-collapse">
            <span class="label">Experience</span>
            <span class="rsaquo">&rsaquo;</span>
        </a>
    </div>
    <div class="province-container filter-container">
        <ul class="province filter multi-collapse collapse" id="experience">
            <?php foreach ($data['experience'] as $experience) : ?>
            <li><a href="<?php echo URLROOT . '/northernCapeJobs/experience/' . $experience->experience_slug; ?>"><?php echo $experience->experience; ?> (<?php echo $experience->count; ?>)</a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="province-header">
       <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="owantoni" href="#owantoni" class="collapsed jb-collapse">
           <span class="label">Owantoni</span>
           <span class="rsaquo">&rsaquo;</span>
       </a>
    </div>
    <div class="province-container filter-container">
        <ul class="province filter multi-collapse collapse" id="owantoni">
            <?php foreach ($data['category'] as $category) : ?>
            <li><a href="<?php echo URLROOT . '/northernCapeJobs/category/' . $category->job_category_slug; ?>"><?php echo $category->category; ?> (<?php echo $category->count; ?>)</a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="province-header">
       <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="provinces" href="#provinces" class="collapsed jb-collapse">
           <span class="label">Province</span>
           <span class="rsaquo">&rsaquo;</span>
       </a>
    </div>
    <div class="province-container filter-container">
        <ul class="province filter multi-collapse collapse" id="provinces">
            <?php foreach ($data['provinces'] as $province) : ?>
            <li><a href="<?php echo URLROOT . '/' . $province->province_slug . '/'; ?>"><?php echo $province->province; ?> (<?php echo $province->count; ?>)</a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>