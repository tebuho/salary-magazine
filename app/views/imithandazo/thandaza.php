<?php require APPROOT .'/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/chatroom-navbar.php'; ?>
<div class="main-content__home add-job">
    <div class="page container">
        <div class="page-container register-login">
            <h1>Wubhale Apha Umbuzo Wakho</h1>
        </div>
    </div>
    <div class="body-container container home">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-body bg-light md-5">
                    <form action="<?php echo URLROOT; ?>/imithandazo/thandaza" method="post">
                        <div class="form-container">
                            <div class="input-label__container">
                                <div class="label-container">
                                    <label for="ngowantoni">Umthandazo wakho ngowantoni?</label>
                                </div>
                                <div class="input-container">
                                    <input type="text" name="ngowantoni" id="ngowantoni" class="form-control <?php echo (!empty($data['ngowantoni_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ngowantoni'] ?>">
                                    <span class="invalid-feedback"><?php echo $data['ngowantoni_err']; ?></span>
                                </div>
                            </div>
                            <div class="input-label__container mt-3">
                                <div class="label-container">
                                    <label for="umthandazo">Thandaza</label>
                                </div>
                                <div class="input-container">
                                    <textarea rows="20" name="umthandazo" id="umthandazo" class="form-control <?php echo (!empty($data['umthandazo_err'])) ? 'is-invalid' : ''; ?>" required="required"><?php echo $data['umthandazo']; ?></textarea>
                                    <span class="invalid-feedback"><?php echo $data['umthandazo_err'] ?></span>
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