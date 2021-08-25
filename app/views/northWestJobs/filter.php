<div class="left-side col-md-2" style="visibility: visible">
    <h4 class="filter-label">Khetha</h4>
    <div class="province-header">
        <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="ndawoni" href="#ndawoni" class="collapsed jb-collapse">
            <span class="label">Ndawoni</span>
            <span class="rsaquo">&rsaquo;</span>
        </a>
    </div>
    <div class="province-container filter-container">
        <ul class="province filter multi-collapse collapse" id="ndawoni">
            <?php foreach ($data['ndawoni'] as $location) : ?>
            <li><a href="<?php echo URLROOT . '/northWestJobs/ndawoni/' . $location->ndawoni_slug; ?>"><?php echo $location->ndawoni; ?> (<?php echo $location->count; ?>)</a></li>
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
            <li><a href="<?php echo URLROOT . '/northWestJobs/onjani/' . $onjani->onjani_slug; ?>"><?php echo $onjani->msebenzi_onjani; ?> (<?php echo $onjani->count; ?>)</a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="province-header">
        <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="imfundo" href="#imfundo" class="collapsed jb-collapse">
            <span class="label">Imfundo</span>
            <span class="rsaquo">&rsaquo;</span>
        </a>
    </div>
    <div class="province-container filter-container">
        <ul class="province filter multi-collapse collapse" id="imfundo">
            <?php foreach ($data['mfundo'] as $mfundo) : ?>
            <li><a href="<?php echo URLROOT . '/northWestJobs/mfundo/' . $mfundo->mfundo_slug; ?>"><?php echo $mfundo->mfundo; ?> (<?php echo $mfundo->count; ?>)</a></li>
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
            <li><a href="<?php echo URLROOT . '/northWestJobs/experience/' . $experience->experience_slug; ?>"><?php echo $experience->experience; ?> (<?php echo $experience->count; ?>)</a></li>
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
            <?php foreach ($data['ngowantoni'] as $ngowantoni) : ?>
            <li><a href="<?php echo URLROOT . '/northWestJobs/ngowantoni/' . $ngowantoni->ngowantoni_slug; ?>"><?php echo $ngowantoni->ngowantoni; ?> (<?php echo $ngowantoni->count; ?>)</a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="province-header">
       <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="provinces" href="#provinces" class="collapsed jb-collapse">
           <span class="label">Province</span>
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
    <div class="col-md-2 left-side mb-3" style="visibility:visible">
        <?php require APPROOT .'/views/inc/adsense-sidebar.php'; ?>
    </div>
</div>