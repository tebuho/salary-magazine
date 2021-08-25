<?php require APPROOT .'/views/inc/header.php'; ?>
<?php $date = new Convert; ?>
<div class="main-content add-job">
    <div class="page container search-province">
        <div class="page-container">
            <h1>Testimonials</h1>
        </div>
    </div>
    <div class="body-container container">
        <div class="right-side profile-sidebar">
            <div class="sidebar-container">
                <h3>Please note</h3>
                <hr />
                <p>This website is written in isiXhosa. For the English version please click on English.</p>
            </div>
        </div>
        <div class="center-side profile-content m-0">
            <div class="card-lo-msebenzi heading-container card-lokubuza highlight-grey">
                <div class="user-feed__meta">
                    <div class="add-comment">
                        <p class="add-comment__p">Testimony yakho uyibhala ngokucofa ku le ndawo ibhalwe Testify.</p>
                        <a href="<?php echo URLROOT .'/testimonials/add'; ?>" class="btn btn-primary btn-sm">Testify</a>
                    </div>
                </div>
            </div>
            <?php echo flash('message_yombuzo'); ?>
            <?php if (!empty($data['testimonials'])) { ?>
                <div class="highlight-grey">
                    <?php for ($i = 0; $i < count($data['testimonials']); $i++) {
                        if ($i === 6 && count($data['testimonials']) >= 12 || $i == 11) {
                            require APPROOT .'/views/inc/infeed-ad.php';
                        } ?>
                        <div class="card-lo-msebenzi heading-container index-title mb-3">
                            <div class="content-box__index">
                                <div class="responder-box">
                                    <div class="comment-avatar"><?php echo $data['testimonials'][$i]->initials; ?></div>
                                    <div class="user-feed__meta card-header ml-3 pb-3">
                                        <div class="avatar-container">
                                            <h5><?php echo ucfirst(strtolower($data['testimonials'][$i]->igama)); ?> <?php echo ucfirst(strtolower($data['testimonials'][$i]->fani)); ?></h5>
                                        </div>
                                        <div class="avatar-container">
                                            <span class="timeline-date"><?php echo $date->convertDayDate($data['testimonials'][$i]->created_at); ?> ka <?php echo $date->convertMonthYear($data['testimonials'][$i]->created_at); ?></span>
                                        </div>
                                    </div>
                                    <div class="follow pr-2">
                                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin" || isset($_SESSION['id_yomntu']) && $data['imisebenzi'][$i]->id_yomntu == $_SESSION['id_yomntu']) : ?>
                                        <a id="testimonial-<?php echo $data['testimonials'][$i]->id; ?>" href="<?php echo URLROOT; ?>/testimonials/edit/<?php echo $data['testimonials'][$i]->slug; ?>" class="edit-testimonial follow-btn" data-target="#editModal-<?php echo $data['testimonials'][$i]->id; ?>" data-toggle="modal">Edit</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="content-container">
                                    <div class="testimonial-content">
                                        <p class="mb-2"><?php echo $data['testimonials'][$i]->testimonial; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="editModal-<?php echo $data['testimonials'][$i]->id; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header highlight-grey">
                                        <h5 class="modal-title font-weight-bold" id="editModalLabel">Edit testimonial yakho</h5>
                                        <button type="button" class="close cancel" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="update-testimonial-<?php echo $data['testimonials'][$i]->id; ?>">
                                        <div class="modal-body pt-0 pb-0" id="modal-body">
                                            <textarea id="edit-area-<?php echo $data['testimonials'][$i]->id; ?>" rows="5" cols="5" class="form-control p-0 border border-white shadow-none edit-area"></textarea>
                                        </div>
                                        <div class="modal-footer pb-2 pt-2">
                                            <span id="err-msg" class="text-danger"></span>
                                            <button type="button" class="btn btn-secondary btn-sm cancel" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary btn-sm" data-dismiss="modal" id="save-edit-<?php echo $data['testimonials'][$i]->id; ?>">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php }
                    //Pagination -->
                    include APPROOT .'/views/inc/pagination.php'; ?>
                </div>
            <?php } else { ?>
                <div class="card-lo-msebenzi heading-container">
                    <div class="user-feed__meta">
                        <div class="add-comment">
                            <p class="add-comment__p">Akukho Testimonial ekhoyo. Cofa ku le ndawo ibhalwe Testify xa ufuna ukubhala.</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="left-side">
            <div class="province-header">
                <h4>Profile</h4>
            </div>
            <div class="province-container filter-container">
                <ul class="province filter">
                    <li><a href="">About</a></li>
                    <li><a href="">CV</a></li>
                    <li><a href="">Imisebenzi</a></li>
                    <li><a href="">Izaziso</a></li>
                    <li><a href="">Izikhalazo</a></li>
                    <li><a href="">Abantu</a></li>
                    <li><a href="">Images</a></li>
                    <li><a href="">Magazine</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>