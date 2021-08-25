<?php require APPROOT .'/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/chatroom-navbar.php'; ?>
    <div class="main-content profile-card__body">
        <div class="container">
            <h1>Achievements</h1>
        </div>
        <div class="body-container container">
            <div class="right-side profile-sidebar col-md-3">
                <div class="sidebar-container">
                    <h2>Please note</h2>
                    <hr />
                    <p>This website is written in isiXhosa. For the English version please click on English.</p>
                </div>
            </div>
            <div class="center-side profile-content col-md-7">
                <div class="card card-body bg-light pt-0 pb-0">
                    <div class="description-yo__msebenzi p-0">
                        <p class="requirements mb-1">Achievements</p>
                        <ul>
                            <?php foreach ($data['achievements'] as $achievements) : ?>
                                <li><strong><?php echo $achievements->achievement_name; ?></strong><br>
                                <em><?php echo $achievements->company; ?>, <?php echo $achievements->year; ?></em></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="card card-body bg-light">
                    <?php echo flash('message_ye_achievements'); ?>
                    <form action="<?php echo URLROOT; ?>/abantu/achievements/<?php echo $data['id_yomntu'] ?>" method="post">
                        <div class="form-group">
                            <label for="Achievement name">Achievement name</label>
                            <input type="text" name="achievement_name" class="form-control form-control-lg <?php echo (!empty($data['achievement_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['achievement_name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['achievement_name_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="From which company">From which company</label>
                            <input type="text" name="company" class="form-control form-control-lg <?php echo (!empty($data['company_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['company']; ?>">
                            <span class="invalid-feedback"><?php echo $data['company_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Which year">Which year</label>
                            <input type="number" name="year" class="form-control form-control-lg <?php echo (!empty($data['year_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['year']; ?>">
                            <span class="invalid-feedback"><?php echo $data['year_err']; ?></span>
                        </div>
                        <div class="row">
                            <div class="col flex">
                                <button class="form-btn__primary">Cofa xa Ugqibile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php require APPROOT .'/views/abantu/inc/aside.php'; ?>

        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>