<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="main-content m-0">
    <div class="page container">
        <div class="page-container">
            <a href="<?php echo URLROOT; ?>/imibuzo"><span class="pl-0">Buyela emva</span></a>
        </div>
    </div>
</div>
<div class="main-content__home add-job pt-0">
    <div class="page container">
        <div class="page-container register-login">
            <h1>Wubhale Apha Umbuzo Wakho</h1>
        </div>
    </div>
    <div class="body-container container home">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="text-left highlight-grey md-5">
                    <form action="<?php echo URLROOT; ?>/imibuzo/buza" method="post">
                        <div class="form-container">
                            <div class="input-label__container">
                                <div class="label-container">
                                    <label for="ungantoni">Umbuzo wakho ungantoni?</label>
                                </div>
                                <div class="input-container">
                                    <input type="text" name="ungantoni" id="ungantoni" class="form-control <?php echo (!empty($data['ungantoni_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ungantoni'] ?>">
                                    <span class="invalid-feedback"><?php echo $data['ungantoni_err']; ?></span>
                                </div>
                            </div>
                            <div class="input-label__container mt-3">
                                <div class="label-container">
                                    <label for="umbuzo">Buza</label>
                                </div>
                                <div class="input-container">
                                    <textarea rows="5" name="umbuzo" id="umbuzo" class="form-control <?php echo (!empty($data['umbuzo_err'])) ? 'is-invalid' : ''; ?>" required="required" placeholder="Bhala apha umbuzo wakho ngokupheleleyo na nge ndlela ecacileyo."><?php echo $data['umbuzo']; ?></textarea>
                                    <span class="invalid-feedback"><?php echo $data['umbuzo_err'] ?></span>
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