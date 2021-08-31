<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="main-content__home ">
    <!-- Start AdSense -->
    <div class="top-ad mb-3">
        <?php require APPROOT .'/views/inc/top_ad.php'; ?>
    </div>
    <!-- End AdSense -->
    <div class="body-container container home">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="page container">
                    <div class="page-container register-login">
                        <h1>Kungenwa Apha</h1>
                    </div>
                    <?php flash('register_success'); ?>
                    <?php flash('confirmation_success'); ?>
                    <?php flash('password_reset_message'); ?>
                </div>
                <div class="card card-body shadow-sm md-4 p-3">
                    <p class="for-admins">
                        <span><i class="fas fa-exclamation-triangle"></i></span>
                        Only admins of the website can log in for now
                    </p>
                    <form action="<?php echo URLROOT; ?>/abantu/login/" method="post">
                        <div class="form-group">
                            <label for="email">Email Yakho: <sup>*</sup></label>
                            <input id="email" type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" autofocus>
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="pasword">Password Yakho: <sup>*</sup></label>
                            <input id="password" type="password" name="password" class="mb-1 form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                            <input type="checkbox" id="show"> <small>Show password</small>
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" value="Cofa xa ugqibile" class="form-btn__primary btn-block">
                            </div>
                        </div>
                    </form>
                    <!--
                        <div class="input-label__container">
                            <div class="input-container mt-3">
                                <label class="font-weight-normal">Password yakho uyilibele? <a href="<?php echo URLROOT; ?>/abantu/forgotPassword/">Cofa apha</a></label>
                            </div>
                        </div>
                    -->
                </div>
            </div>
            <!--
            <div class="page container">
                <div class="page-container register-login">
                    <label class="font-weight-normal">Ufuna ukubhalisa? <a href="<?php echo URLROOT; ?>/abantu/register/">Cofa apha</a></label>
                </div>
            </div>
            -->
        </div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>