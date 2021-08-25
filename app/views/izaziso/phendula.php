<?php require APPROOT .'/views/inc/header.php'; ?>
<?php $date = new Convert; ?>
<div class="main-content add-job">
    <div class="page container">
        <div class="page-container">
            <a href="<?php echo URLROOT; ?>/izaziso"><i class="fas fa-angle-double-left"></i> <span>Buyela emva</span></a>
        </div>
        <div class="page-container">
            <h1>Phendula Apha</h1>
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
            <div class="card-lo-msebenzi heading-container timeline-card">
                <?php echo flash('message_yombuzo'); ?>
                <div class="user-feed__meta card-header">
                    <div class="avatar-container">
                        <h5><?php echo $data['igama']; ?> <?php echo $data['ifani']; ?></h5>
                    </div>
                    <div class="avatar-container">
                        <span class="timeline-date">&nbsp;<?php echo $date->convertDayDate($data['date']); ?> ka <?php echo $date->convertMonthYear($data['date']); ?></span>
                    </div>
                </div>
                <div class="content-container">
                    <div class="description-yo__msebenzi">
                        <?php echo $data['isaziso']; ?>
                    </div>
                </div>
                <div class="label-container">
                    <label for="imibuzo">Comments</label>
                </div>
                <?php if (empty($data['comments'])) {?>
                    <div class="card comment-card">
                        <p class="pb-2"><em>Akho mpendulo</em></p>
                    </div>
                <?php } ?>
                <?php foreach ($data['comments'] as $comment) : ?>
                <div class="card comment-card">
                    <div class="card-header">
                        <h5>
                            <?php echo $comment->igama; ?> <?php echo $comment->fani; ?>
                            <span class="timeline-date">
                                <?php echo $date->convertDayDate($comment->date); ?> ka <?php echo $date->convertMonthYear($comment->date); ?>
                            </span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <p><?php echo $comment->impendulo; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if (isset($_SESSION['id_yomntu'])) { ?>
                    <div class="label-container mt-3">
                        <label for="imibuzo"><a data-toggle="collapse" href="#impendulo" role="button" aria-expanded="false" aria-controls="impendulo">Phendula apha</a></label>
                    </div>
                    <form class="collapse" id="impendulo" action="<?php echo URLROOT; ?>/imibuzo/phendula/<?php echo $data['id'] ?>" method="post">
                        <div class="form-container pt-0">
                            <div class="input-label__container">
                                <div class="input-container">
                                    <textarea rows="6" name="impendulo" class="form-control <?php echo (!empty($data['impendulo_err'])) ? 'is-invalid' : ''; ?>" required="required"></textarea>
                                    <span class="invalid-feedback"><?php echo $data['impendulo_err'] ?></span>
                                </div>
                            </div>
                            <div class="input-label__container mt-3">
                                <div class="input-container flex">
                                    <button class="form-btn__primary">Cofa xa Ugqibile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class="social-commentary">
                        <div class="user-to__do">
                            <p>Kufuneka ungene kwi profile yakho ukuze ukwazi ukuphendula.
                                <a href='<?php echo URLROOT ."/abantu/login"; ?>'>
                                    Cofa apha.
                                </a>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
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
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>