<?php echo flash('message_yomsebenzi'); ?>
<div class="highlight-grey">
    <?php if (!empty($data['imisebenzi'])) { ?>
        <?php for ($i = 0; $i < count($data['imisebenzi']); $i++) {
            if ($i === 6 && count($data['imisebenzi']) >= 12 || $i == 11) {
                require APPROOT .'/views/inc/in_feed_index.php';
            }?>
            <div class="card-lo-msebenzi heading-container pr-0 pl-0">
                <div class="job-meta">
                    <div class="job-meta_tags">
                        <span class="badge badge-light"><?php echo $data['imisebenzi'][$i]->job_type; ?></span>
                        <span class="badge badge-light"><a href="<?php echo URLROOT . '/pages/category/' . $data['imisebenzi'][$i]->category;?>"><?php echo $data['imisebenzi'][$i]->category; ?></a></span>
                    </div>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin" || isset($_SESSION['user_id']) && $data['imisebenzi'][$i]->user_id == $_SESSION['user_id']) : ?>
                        <div class="follow">
                            <a href="<?php echo URLROOT; ?>/<?php echo $province_slug; ?>/edit/<?php echo $data['imisebenzi'][$i]->slug; ?>" class="edit-link follow-btn">Edit</a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="job-title__index">
                    <div class="label">
                        <a href="<?php echo URLROOT; ?>/<?php echo $data['imisebenzi'][$i]->province_slug; ?>/umsebenzi/<?php echo $data['imisebenzi'][$i]->slug; ?>" class="umsebenzi-card__title">
                            <h6><?php echo $data['imisebenzi'][$i]->job_title; ?></h6>
                        </a>
                            <p><?php echo $data['imisebenzi'][$i]->gama_le_company; ?> - <?php echo $data['imisebenzi'][$i]->ndawoni; ?>, <?php echo $data['imisebenzi'][$i]->province; ?></p>
                    </div>
                </div>
            </div>
        <?php }                   
        //Pagination
        require  APPROOT .'/views/inc/pagination.php';
    } elseif (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 2 || isset($_SESSION['user_id']) && $_SESSION['user_id'] == 3) { ?>
        <p class="m-0">Ingathi akukho msebenzi okhoyo. Xa ufuna ukufaka omnye <a href="<?php echo URLROOT ; ?>/addJobs/add">Cofa apha.</a></p>
    <?php } else { ?>
        <p class="m-0">Ingathi akukho msebenzi okhoyo.</p>
    <?php } ?>
</div>