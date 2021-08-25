<?php require APPROOT .'/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/chatroom-navbar.php'; ?>
<?php $date = new Convert; ?>
    <div class="main-content add-job">
        <div class="page container search-province">
            <div class="page-container">
                <h1>Cover Letters</h1>
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
                <?php if (!empty($data['cover_letter'])) { ?>
                <div class="card-lo-msebenzi heading-container">
                    <div class="user-feed__meta">
                        <div class="add-comment">
                            Cofa apha if ufuna ukubhala i-cover letter yakho.&nbsp;<a href="<?php echo URLROOT .'/coverLetters/bhala'; ?>">Cofa apha</a>
                        </div>
                    </div>
                </div>
                <?php echo flash('message_ye_cover_letter'); ?>
                <?php foreach ($data['cover_letter'] as $cover_letter): ?>
                    <div class="card-lo-msebenzi heading-container timeline-card">
                        <div class="user-feed__meta">
                                <div class="avatar-container">
                                    <h5><?php echo $cover_letter->igama; ?></h5>
                                </div>
                            <div class="avatar-container">
                                <a href='<?php echo URLROOT ."/coverLetters/phendula/$cover_letter->cover_letterId"; ?>'>&nbsp;<span class="timeline-date"><?php echo $date->convertDayDate($cover_letter->ibhalwe_nini); ?> ka <?php echo $date->convertMonthYear($cover_letter->ibhalwe_nini); ?></span></a>
                            </div>
                            <?php if (isset($_SESSION['id_yomntu']) && $cover_letter->id_yomntu == $_SESSION['id_yomntu']) : ?>
                                <div class="follow">
                                    <a href="<?php echo URLROOT; ?>/coverLetters/edit/<?php echo $cover_letter->cover_letterId; ?>" class="edit-link follow-btn">Edit</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="content-container">
                            <div class="content">
                                <p>
                                    <?php echo substr($cover_letter->cover_letter, 0, 140); ?><?php echo strlen($cover_letter->cover_letter) > 140 ? "... <a href='" . URLROOT ."/coverLetters/phendula/" . $cover_letter->cover_letterId . "'>cofa apha</a>" : ''; ?>
                                </p>
                            </div>
                            <div class="social-commentary">
                                <div class="user-to__do">
                                    <a href='<?php echo URLROOT ."/coverLetters/phendula/$cover_letter->cover_letterId"; ?>'>
                                        <i class="far fa-comment-alt"></i> Phendula
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php } else {
                    echo "<div class='card-lo-msebenzi'><p>Ingathi akukabikho cover letters ezibhaliweyo. Ukuba unayo onayo ungasibhalela&nbsp;<a href='" . URLROOT . "/coverLetters/bhala'>ngokucofa apha</a>.</p></div>";
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