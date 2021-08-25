<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="main-content__home">
    <div class="page container">
        <div class="page-container register-login">
            <h1>Kubhaliswa Apha</h1>
        </div>
    </div>
    <div class="page container col-md-12">
        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="card card-body shadow-sm md-6 p-3">
                    <form action="<?php echo URLROOT; ?>/abantu/register/" method="post">
                        <div class="form-group">
                            <label for="first_name">First Name: <sup>*</sup></label>
                            <input type="text" name="first_name" class="form-control form-control-lg <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['first_name']; ?>" autofocus>
                            <span class="invalid-feedback"><?php echo $data['first_name_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name: <sup>*</sup></label>
                            <input type="text" name="last_name" class="form-control form-control-lg <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['last_name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['last_name_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Yakho: <sup>*</sup></label>
                            <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="pasword">Password: <sup>*</sup></label>
                            <input id="password" type="password" name="password" class="mb-1 form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                            <input type="checkbox" id="show"> <small>Show password</small>
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                            <input id="confirm" type="password" name="confirm_password" class="mb-1 form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                            <input type="checkbox" id="showConfirm"> <small>Show password</small>
                            <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" value="Cofa xa Ugqibile" class="form-btn__primary btn-block">
                            </div>
                        </div>
                        <div class="input-label__container">
                        <div class="input-container mt-3">
                            <label class="font-weight-normal">Ukuba wakhe wabhalisa <a href="<?php echo URLROOT; ?>/abantu/login/">cofa apha</a></label>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>