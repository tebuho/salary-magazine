<?php echo flash('message_yomsebenzi'); ?>
<div class="highlight-grey">
<?php if (!empty($data['imisebenzi'])) { ?>
        <?php for ($i = 0; $i < count($data['imisebenzi']); $i++) {
            if ($i === 6 && count($data['imisebenzi']) >= 12 || $i == 11) {
                require APPROOT .'/views/inc/infeed-ad.php';
            }?>
            <div class="card-lo-msebenzi heading-container pr-0 pl-0">
                <div class="job-meta">
                    <div class="job-meta_tags">
                        <span class="badge badge-light"><?php echo $data['imisebenzi'][$i]->msebenzi_onjani; ?></span>
                        <span class="badge badge-light"><a href="<?php echo URLROOT . '/pages/ngowantoni/' . $data['imisebenzi'][$i]->ngowantoni;?>"><?php echo $data['imisebenzi'][$i]->ngowantoni; ?></a></span>
                    </div>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin" || isset($_SESSION['id_yomntu']) && $data['imisebenzi'][$i]->id_yomntu == $_SESSION['id_yomntu']) : ?>
                        <div class="follow">
                            <a href="<?php echo URLROOT; ?>/<?php echo $province_slug; ?>/edit/<?php echo $data['imisebenzi'][$i]->slug; ?>" class="edit-link follow-btn">Edit</a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="job-title__index">
                    <div class="label">
                        <a href="<?php echo URLROOT; ?>/<?php echo $data['imisebenzi'][$i]->province_slug; ?>/umsebenzi/<?php echo $data['imisebenzi'][$i]->slug; ?>" class="umsebenzi-card__title">
                            <h6><?php echo $data['imisebenzi'][$i]->job_title; ?> </h6>
                        </a>
                        <?php
                        $page = explode("/", $_GET['url']);
                        if($page[0] == "pages") : ?>
                            <p><?php echo $data['imisebenzi'][$i]->gama_le_company; ?> - <?php echo $data['imisebenzi'][$i]->ndawoni; ?>, <?php echo $data['imisebenzi'][$i]->province; ?></p>
                        <?php else : ?>

                        <p><?php echo $data['imisebenzi'][$i]->gama_le_company; ?> - <?php echo $data['imisebenzi'][$i]->ndawoni; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php }                   
        //Pagination
        require  APPROOT .'/views/inc/pagination.php';
    } else { ?>
        <p>Ingathi akukho msebenzi okhoyo. Xa ufuna ukufaka omnye <a href="<?php echo URLROOT ; ?>/addJobs/add">Cofa apha.</a></p>
    <?php } ?>
</div>