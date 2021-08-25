<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="main-content__home ">
    <div class="body-container container home">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="page container">
                        <div class="page-container register-login">
                            <h1>Password yakho yitshintshe apha</h1>
                        </div>
                    </div>
                    <div class="card card-body shadow-sm md-4 p-3">
                        <form action="<?php echo URLROOT; ?>/abantu/forgotPassword" method="POST">
                            <div class="form-container">
                                <p>Faka i-email address yakho ukuze sizokuthumelela indlela ozokuyitshintsha ngayo i-password yakho.</p>
                                <div class="input-label__container">
                                    <div class="label-container">
                                        <label for="Email">Email yakho</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="input" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" autofocus>
                                         <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                                    </div>
                                </div>
                                <div class="input-label__container">
                                    <div class="input-container flex">
                                        <button class="form-btn__primary">Cofa xa Ugqibile</button>
                                    </div>
                                </div>
                                <div class="input-label__container mt-3">
                                    <div class="input-container">
                                        <label class="font-weight-normal">Ufuna ukungena? <a href="<?php echo URLROOT; ?>/abantu/login/">Cofa apha</a></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="page container">
                        <div class="page-container register-login">
                            <label class="font-weight-normal">Ufuna ukubhalisa? <a href="<?php echo URLROOT; ?>/abantu/register/">Cofa apha</a></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>