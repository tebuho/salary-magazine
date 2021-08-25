<?php require APPROOT .'/views/inc/header.php'; ?>
<?php $date = new Convert; ?>
    <div class="main-content add-job">
        <div class="page container search-province">
            <div class="page-container">
                <h1>Izaziso</h1>
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
            <div class="center-side profile-content">
                <?php if (!empty($data['izaziso'])) { ?>
                <div class="card-lo-msebenzi heading-container card-lokubuza">
                    <div class="user-feed__meta">
                        <div class="add-comment">
                            Zizaziso zodwa ezibhalwa apha. Cofa apha if ufuna ukubhala isaziso sakho.&nbsp;<a href="<?php echo URLROOT .'/izaziso/sasaza'; ?>">Cofa apha</a>
                        </div>
                    </div>
                </div>
                    <?php echo flash('message_yesaziso'); ?>
                <?php foreach ($data['izaziso'] as $isaziso): ?>
                    <div class="card-lo-msebenzi heading-container timeline-card">
                        <div class="user-feed__meta">
                            <div class="avatar-container">
                                <h5><?php echo $isaziso->igama; ?> <?php echo $isaziso->fani; ?></h5>
                            </div>
                            <div class="avatar-container">
                                <a href='<?php echo URLROOT ."/izaziso/phendula/$isaziso->isazisoId"; ?>'>&nbsp;<span class="timeline-date"><?php echo $date->convertDayDate($isaziso->saziswe_nini); ?> ka <?php echo $date->convertMonthYear($isaziso->saziswe_nini); ?></span></a>
                            </div>
                            <?php if (isset($_SESSION['id_yomntu']) && $isaziso->id_yomntu == $_SESSION['id_yomntu']) : ?>
                                <div class="follow">
                                    <a href="<?php echo URLROOT; ?>/izaziso/edit/<?php echo $isaziso->isazisoId; ?>" class="edit-link follow-btn">Edit</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="content-container">
                            <div class="content description-yo__msebenzi">
                                <a href="<?php echo URLROOT; ?>/izaziso/phendula/<?php echo $isaziso->isazisoId; ?>">
                                    <h6><?php echo $isaziso->singantoni; ?></h6>
                                </a>
                                <p>
                                    <?php echo strip_tags(substr($isaziso->isaziso, 0, 139)); ?><?php echo strlen($isaziso->isaziso) > 140 ? "... <a href='" . URLROOT ."/izaziso/phendula/" . $isaziso->isazisoId . "'>cofa apha</a>" : ''; ?>
                                </p>
                            </div>
                            <div class="social-commentary">
                                <div class="user-to__do">
                                    <a href='<?php echo URLROOT ."/izaziso/phendula/$isaziso->isazisoId"; ?>'>
                                        <i class="far fa-comment-alt"></i> Phendula
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php } else {
                    echo "<div class='card-lo-msebenzi'><p>Ingathi akukabikho zaziso ezikhoyo. Ukuba unaso onaso ungasazisaa&nbsp;<a href='" . URLROOT . "/izaziso/sasaza'>ngokucofa apha</a>.</p></div>.</p>";
                 } ?>
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