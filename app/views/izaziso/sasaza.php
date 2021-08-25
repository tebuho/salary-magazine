<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="main-content__home add-job">
    <div class="page container">
        <div class="page-container register-login">
            <h1>Sibhale apha isaziso sakho</h1>
        </div>
    </div>
    <div class="body-container container home">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-body bg-light md-5">
                    <form action="<?php echo URLROOT; ?>/izaziso/sasaza" method="post">
                        <div class="form-container">
                            <div class="input-label__container">
                                <div class="label-container">
                                    <label for="singantoni">Isaziso sakho singantoni?</label>
                                </div>
                                <div class="input-container">
                                    <input type="text" name="singantoni" id="singantoni" class="form-control <?php echo (!empty($data['singantoni_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['singantoni'] ?>">
                                    <span class="invalid-feedback"><?php echo $data['singantoni_err']; ?></span>
                                </div>
                            </div>
                            <div class="input-label__container mt-3">
                                <div class="label-container">
                                    <label for="isaziso">Sibhale apha</label>
                                </div>
                                <div class="input-container">
                                    <textarea rows="20" name="isaziso" id="isaziso" class="form-control <?php echo (!empty($data['isaziso_err'])) ? 'is-invalid' : ''; ?>" required="required"><?php echo $data['isaziso']; ?></textarea>
                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        CKEDITOR.replace( 'isaziso' );
                                    </script>
                                    <span class="invalid-feedback"><?php echo $data['isaziso_err'] ?></span>
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