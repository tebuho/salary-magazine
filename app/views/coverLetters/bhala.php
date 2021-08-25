<?php require APPROOT .'/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/chatroom-navbar.php'; ?>
<div class="main-content__home add-job">
    <div class="page container">
        <div class="page-container register-login">
            <h1>Cover Letter Yakho Yibhale Apha</h1>
        </div>
    </div>
    <div class="body-container container home">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-body bg-light md-5">
                    <form action="<?php echo URLROOT; ?>/cover_letters/bhala" method="post">
                        <div class="form-container">
                            <div class="input-label__container">
                                <div class="label-container">
                                    <label for="ngeyantoni">Cover letter yakho ngeyantoni?</label>
                                </div>
                                <div class="input-container">
                                    <input type="text" name="ngeyantoni" id="ngeyantoni" class="form-control <?php echo (!empty($data['ngeyantoni_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ngeyantoni'] ?>">
                                    <span class="invalid-feedback"><?php echo $data['ngeyantoni_err']; ?></span>
                                </div>
                            </div>
                            <div class="input-label__container mt-3">
                                <div class="label-container">
                                    <label for="cover_letter">Bhala</label>
                                </div>
                                <div class="input-container">
                                    <textarea rows="20" name="cover_letter" id="cover_letter" class="form-control <?php echo (!empty($data['cover_letter_err'])) ? 'is-invalid' : ''; ?>" required="required"><?php echo $data['cover_letter']; ?></textarea>
                                    <span class="invalid-feedback"><?php echo $data['cover_letter_err'] ?></span>
                                </div>
                            </div>
                            <div class="input-label__container mt-3">
                                <div class="input-container flex">
                                    <button class="form-btn__primary">Cofa xa Ugqibile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>