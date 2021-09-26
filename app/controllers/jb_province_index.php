<div class="card-lo-msebenzi heading-container">
    <div class="job-meta">
        <div class="job-meta_tags">
            <span class="badge badge-light"><?php echo $data['imisebenzi'][$i]->job_type; ?></span>
            <span class="badge badge-light"><?php echo $data['imisebenzi'][$i]->category; ?></span>
        </div>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin" || isset($_SESSION['user_id']) && $data['imisebenzi'][$i]->user_id == $_SESSION['user_id']) : ?>
            <div class="follow">
                <a href="<?php echo URLROOT; ?>/<?php echo $province_slug; ?>/edit/<?php echo $data['imisebenzi'][$i]->slug; ?>" class="edit-link follow-btn">Edit</a>
            </div>
        <?php endif; ?>
    </div>
    <div class="job-title__index">
        <div class="label">
            <a href="<?php echo URLROOT; ?>/<?php echo $province_slug; ?>/umsebenzi/<?php echo $data['imisebenzi'][$i]->slug; ?>" class="umsebenzi-card__title">
                <h6><?php echo $data['imisebenzi'][$i]->job_title; ?> </h6>
            </a>
            <p><?php echo $data['imisebenzi'][$i]->gama_le_company; ?> - <?php echo $data['imisebenzi'][$i]->ndawoni; ?></p>
        </div>
    </div>
</div>