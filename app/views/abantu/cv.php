<?php require APPROOT .'/views/inc/header.php'; ?>
<?php $date = new Convert; ?>
    <div class="main-content bg-light">
        <?php require APPROOT .'/views/inc/infeed-ad.php'; ?>
        <div class="body-container container">
            <?php require APPROOT .'/views/inc/right-side_home.php'; ?>
            <div class="ml-3 mr-3 center-side profile-content col-md-6">
                <div class="experience-title pt-2">
                    <h3 class="page-container">Curriculum Vitae</h3>
                </div>
                <?php echo flash('message_ye_experience'); ?>
                <div class="experience-card cv border bg-white rounded p-3">
                    <div class="personal-details">
                        <div class="name">
                            <h1><?php echo $data['igama'] . " " . $data['fani']; ?></h1>
                        </div>
                    </div>
                    <div class="professional-profile">
                        <?php if(isset($_SESSION["id_yomntu"]) && $data["id"] === $_SESSION["id_yomntu"] ) : ?>
                            <small class="float-right"><a href="<?php echo URLROOT; ?>/abantu/profile/<?php echo $_SESSION['id_yomntu'] ?>">Edit</a></small>
                        <?php endif; ?>
                        <div class="profile-description">
                            <p class="profile-text"><?php echo $data["zazise"]; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="education">
                        <h3>Education
                            <?php if(isset($_SESSION["id_yomntu"]) && $data["id"] === $_SESSION["id_yomntu"] ) : ?>
                                <small class="float-right"><a href="<?php echo URLROOT; ?>/abantu/primarySecondaryEducation/<?php echo $_SESSION['id_yomntu'] ?>">Edit</a></small>
                            <?php endif; ?>
                        </h3>
                        <?php  if ( empty($data["tertiary_education"][0]->level_passed) ) : ?>
                            <div class="primary-secondary__education">
                                <p class="font-weight-bolder mb-1">
                                    <?php echo $data["school"]; ?>
                                </p>
                                <p><?php echo $data["grade"]; ?></p>
                            </div>
                        <?php endif; ?>
                        <?php foreach ( $data["tertiary_education"] as $tertiary ) : ?>
                            <div class="tertiary-education">
                                <p class="font-weight-bolder mb-1">
                                    <?php echo $tertiary->institution; ?>
                                </p>
                                <p><?php echo !empty($tertiary->level_passed)  ? $tertiary->level_passed . ", " . $tertiary->course : ""; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <hr>
                    <?php if ( !empty($data["work_experience"]) ) : ?>
                        <div class="work-experience">
                            <h3>Work Experience 
                                <?php if(isset($_SESSION["id_yomntu"]) && $data["id"] === $_SESSION["id_yomntu"] ) : ?>
                                    <small class="float-right"><a href="<?php echo URLROOT; ?>/abantu/experience/<?php echo $_SESSION['id_yomntu'] ?>">Edit</a></small>
                                <?php endif; ?>
                            </h3>
                            <?php foreach($data["work_experience"] as $company) { ?>
                                <div class="experience">
                                    <p class="mb-2">
                                        <strong><?php echo !empty($company->job_title) ? $company->job_title . ", " . $company->company : ""; ?></strong>
                                        <span class="float-right"><?php echo !empty($company->uqale_nini) ? $company->uqale_nini . " - " . $company->ugqibe_nini : ""; ?></span>
                                    </p>
                                    <?php echo $company->responsibilities; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <hr>
                    <?php endif; ?>
                    <?php if ( !empty($data["work_experience"]) ) : ?>
                        <div class="skills mb-3">
                            <h3>Skills &amp; Competencies 
                                <?php if(isset($_SESSION["id_yomntu"])  && $data["id"] === $_SESSION["id_yomntu"] ) : ?>
                                    <small class="float-right"><a href="<?php echo URLROOT; ?>/abantu/skills/<?php echo $_SESSION['id_yomntu'] ?>">Edit</a></small>
                                <?php endif; ?>
                            </h3>
                                <ul>
                                    <?php sort($data["skills"]); foreach ( $data["skills"] as $skill ) : ?>
                                        <?php if (!empty($skill->skill) ) { ?>
                                        <li><?php echo $skill->skill; ?></li>
                                    <?php } endforeach; ?>
                                </ul>
                        </div>
                    <?php endif; ?>
                    <div class="comment-like__share mt-3 d-none">
                        <div class="like-box d-inline pr-2">
                            <span><a href="#" id="likeCV"><i class="far fa-thumbs-up" id="far"></i>&nbsp;&nbsp;Like</a></span>
                        </div>
                        <div class="comment-box d-inline pl-2 pr-2">
                            <span><i class="far fa-comment-alt"></i>&nbsp;&nbsp;Comment</span>
                        </div>
                        <div class="share-box d-inline pl-2">
                            <span><i class="fas fa-share-alt"></i>&nbsp;&nbsp;Share</span>
                        </div>
                    </div>
                    <div class="share-btn pt-3">
                        <label>Cela umntu akujongele le CV</label>
                        <div class="share">
                            <small data-network="whatsapp" class="pl-0 st-custom-button"><i class="text-success fab fa-whatsapp"></i> WhatsApp</small>
                            <small data-network="facebook" class="st-custom-button"><i class="fab fa-facebook"></i> Facebook</small>
                            <small data-network="email" class="st-custom-button"><i class="text-danger far fa-envelope"></i> Email</small>
                        </div>
                    </div>
                    <?php require APPROOT .'/views/blogs/comments.php'; ?>      
                    <?php require APPROOT .'/views/blogs/phendula.php'; ?>
                </div>
            </div>
            
            <?php
                if (isset($_SESSION["id_yomntu"])) {
                    require APPROOT .'/views/abantu/inc/aside.php';
                } else { ?>
                <div class="left-side col-md-2" style="visibility:visible"></div>
             <?php } ?>

        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>