<?php require APPROOT .'/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/chatroom-navbar.php'; ?>
<?php $date = new Convert; ?>
    <div class="main-content add-job">
        <div class="page container search-province">
            <div class="page-container">
                <h1>Imithandazo</h1>
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
                <?php if (!empty($data['imithandazo'])) { ?>
                <div class="card-lo-msebenzi heading-container card-lokubuza">
                    <div class="user-feed__meta">
                        <div class="add-content">
                            Cofa apha if ufuna ukufaka umthandazo wakho.&nbsp;<a href="<?php echo URLROOT .'/imithandazo/thandaza'; ?>">Cofa apha</a>
                        </div>
                    </div>
                </div>
                <?php echo flash('message_yomthandazo'); ?>
                <?php foreach ($data['imithandazo'] as $umthandazo): ?>
                    <div class="card-lo-msebenzi heading-container timeline-card">
                        <div class="user-feed__meta">
                            <div class="avatar-container">
                                <h5><?php echo $umthandazo->igama; ?></h5>
                            </div>
                            <div class="avatar-container">
                                <a href='<?php echo URLROOT ."/imithandazo/phendula/$umthandazo->umthandazoId"; ?>'>&nbsp;<span class="timeline-date"><?php echo $date->convertDayDate($umthandazo->thandazwe_nini); ?> ka <?php echo $date->convertMonthYear($umthandazo->thandazwe_nini); ?></span></span></a>
                            </div>
                            <?php if (isset($_SESSION['id_yomntu']) && $umthandazo->id_yomntu == $_SESSION['id_yomntu']) : ?>
                                <div class="follow">
                                    <a href="<?php echo URLROOT; ?>/imithandazo/edit/<?php echo $umthandazo->umthandazoId; ?>" class="edit-link follow-btn">Edit</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="content-container">
                            <div class="content">
                                <p><?php echo $umthandazo->umthandazo; ?></p>
                            </div>
                            <div class="social-commentary">
                                <div class="user-to__do">
                                    <a href='<?php echo URLROOT ."/imithandazo/phendula/$umthandazo->umthandazoId"; ?>'>
                                        <i class="far fa-comment-alt"></i> Phendula
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php } else {
                    echo "<div class='card-lo-msebenzi'><p>Ingathi akukabikho mithandazo ekhoyo. Ukuba unawo onawo ungasiqalela&nbsp;<a href='" . URLROOT . "/imithandazo/thandaza'>ngokucofa apha</a>.</p></div>";
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