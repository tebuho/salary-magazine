<div class="page container">
    <div class="page-container">
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><span>Buyela emva</span></a>
    </div>
</div>

<div class="body-container container">
    <div class="col-md-2 left-side mb-3 hide-mobile" style="visibility:visible">
        <div class="empty"></div>
        <?php require APPROOT .'/views/inc/adsense-sidebar.php'; ?>
    </div>

    <div class="center-side center-side__margin col-md-7">
        <!-- Start AdSense -->
        <div class="top-ad">
            <?php require APPROOT .'/views/inc/top_ad.php'; ?>
        </div>
        <!-- End AdSense -->
        <div class="card-lo-msebenzi cofa-card-lo__msebenzi heading-container p-0">
            <div class="card-lo-msebenzi__container highlight-grey">
                <?php echo flash('comment_message'); ?>
                <?php echo flash('comment_error'); ?>
                <?php if ($data['umsebenzi']->job_closing_date == "1970-01-01" && $data['since_pub_date'] > 7 || $data['umsebenzi']->job_closing_date == NULL && $data['since_pub_date'] > 7) : ?>
                <p class="mt-2 p-1 border border-danger flash-message" style="line-height:normal"><small>Lo msebenzi uphelelwe. If ubungena closing date then ixesha lawo lidlulile. Imisebenzi engena closing date siyigcina intsuku ezisixhenxe.</small></p>
                <?php elseif($data['umsebenzi']->job_closing_date !== "1970-01-01" && $data['umsebenzi']->job_closing_date < date('Y-m-d')) : ?>
                <p class="mt-1 p-1 border border-danger flash-message" style="line-height:normal"><small>Lo msebenzi uphelelwe. Closing date yawo ibi nge <?php echo $data['umsebenzi']->closingDate; ?>.</small></p>
                <?php endif; ?>
                <!-- Alert when a new job has been successfully uploaded -->
                <?php echo flash('message_yomsebenzi'); ?>
                <h3 class="mt-2"><?php echo $data['umsebenzi']->job_title; ?> </h3>
                <p><?php echo $data['umsebenzi']->gama_le_company; ?> - <?php echo $data['umsebenzi']->ndawoni; ?>, <?php echo $data['umsebenzi']->province; ?></p>
                <p><?php echo $data['umsebenzi']->job_type; ?><?php echo !empty($data['umsebenzi']->category) ? " | " . $data['umsebenzi']->category : ""; ?></p>
                <?php if($data['umsebenzi']->user_id != 2055) : ?>
                    <p><?php echo $data['umsebenzi']->job_closing_date == "1970-01-01" ? "Closing date ayichazwanga" : "Closing date yi " . $data['umsebenzi']->closingDate; ?></p>
                <?php endif; ?>
            </div>
            <div class="description-yo__msebenzi p-0">
                <?php if ( !empty($data['umsebenzi']->image) ): ?>
                    <div class="img-card__container mb-3">
                        <img class="m-0" src="<?php echo URLROOT; ?>/img/imisebenzi/<?php echo $data['umsebenzi']->image; ?>" alt="<?php echo $data['umsebenzi']->label; ?>">
                    </div>
                <?php endif; ?>
                    <?php echo $data['jb_specification']; ?>
                    <?php if ($data['umsebenzi']->job_closing_date >= date('Y-m-d') || $data['umsebenzi']->job_closing_date == "1970-01-01" && $data['since_pub_date'] <= 7 || $data['umsebenzi']->job_closing_date == NULL && $data['since_pub_date'] <= 7) : ?>
                        <!-- Application method -->
                        <div class="description-yo__msebenzi pr-0">
                            <?php
                                if (!empty($data['umsebenzi']->job_hand_application)) {
                                    echo "<div class='highlight-grey'><strong class='mb-1'>Application Address:</strong><br>" . $data['umsebenzi']->job_hand_application . "</div>";
                                }
                            ?>
                            <?php
                                if (!empty($data['umsebenzi']->apply_nge_email)) {
                                echo "<p class='mb-3'><strong>Aplaya nge Email</strong><br></p><ul><li><a href='mailto:" . $data['umsebenzi']->apply_nge_email . "'>" . $data['umsebenzi']->apply_nge_email . "</a></li></ul>";
                                }
                            ?>
                            <?php
                                if (!empty($data['umsebenzi']->apply_nge_website)) {
                                echo "<a href='" . $data['umsebenzi']->apply_nge_website. "' target='_blank' class='job-search__btn'>Cofa to apply kwi website ye company</a>";
                                }
                            ?>
                        </div>
                    <?php elseif($data['umsebenzi']->job_closing_date >= date('Y-m-d') || $data['umsebenzi']->job_closing_date == "1970-01-01" && $data['since_pub_date'] <= 7 || $data['umsebenzi']->job_closing_date == NULL && $data['since_pub_date'] <= 7): ?>
                    <p class="mt-1 p-1 border border-danger" style="line-height:normal"><small>Lo msebenzi uphelelwe. Closing date yawo ibingachazwanga and thina imisebenzi engena closing date siyigcina intsuku ezisixhenxe.</small></p>
                    <?php else : ?>
                        <p class="mt-1 p-1 border border-danger flash-message flash-message-bottom" style="line-height:normal"><small>Lo msebenzi uphelelwe. Closing date yawo ibi nge <?php echo $data['umsebenzi']->closingDate; ?>.</small></p>
                    <?php endif; ?>
                    <div class="share-btn pt-3">
                        <div class="sharethis-inline-share-buttons mt-3"></div>
                    </div>
                    <div class="contributor">
                        <?php if ($data['umntu']->igama != "Graylink"): ?>
                            <em>Lo msebenzi ufakwe ngu <a href="<?php echo URLROOT; ?>/abantu/cv/<?php echo $data['umntu']->id ?>"><?php echo $data['umntu']->igama . " " . $data['umntu']->fani; ?></a> nge <?php echo $date->convertDayDate($data['umsebenzi']->created_at); ?> ka <?php echo $date->convertMonthYear($data['umsebenzi']->created_at); ?></em>
                        <?php endif; ?>
                    </div>
            </div>
        </div>         
        <div class="mt-2">
            <!-- AdSense -->
            <?php require APPROOT .'/views/inc/bottom_ad.php'; ?>
            <!-- End AdSense -->
        </div>
    </div>
    <?php require APPROOT .'/views/inc/right-sidebar.php'; ?>
</div> 