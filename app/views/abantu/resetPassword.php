<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="main-content__home">
    <div class="body-container container home">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="page container">
                    <div class="page-container register-login">
                        <h1>Password Yakho Entsha Yifake Apha</h1>
                    </div>
                    <?php flash('reset_message'); ?>
                </div>
                <div class="card card-body shadow-sm md-4 p-3">
                    <form action="<?php echo URLROOT; ?>/abantu/resetPassword/<?php echo $data['selector']; ?>/<?php echo $data['validator']; ?>" method="post">
                       <div class="form-group">
                            <label for="pasword">Password: <sup>*</sup></label>
                            <input type="hidden" name="selector" value="<?php echo $data['selector']; ?>">
                            <input type="hidden" name="validator" value="<?php echo $data['validator']; ?>">
                            <input type="password" name="password" placeholder="Password yakho entsha" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                            <input type="password" name="confirm_password" placeholder="Password yakho entsha okwesibini" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" value="Cofa xa Ugqibile" class="form-btn__primary btn-block">
                            </div>
                        </div>
                        <div class="input-label__container">
                            <div class="input-container mt-3">
                                <p>Ukuba wakhe wabhalisa <a href="<?php echo URLROOT; ?>/abantu/login/">cofa apha</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>