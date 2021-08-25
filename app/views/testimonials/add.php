<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="main-content addTestimonial">
<!-- Start Breadcrumb -->
    <?php if (isset($_SERVER['HTTP_REFERER'])) : ?>
        <div class="page container">
            <div class="page-container">
                <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><span>Buyela emva</span></a>
            </div>
        </div>
    <?php endif; ?>
<!-- End Start Breadcrumb -->
    <div class="col-md-6">
        <div class="page container">
            <div class="page-container register-login">
                <h3>Bhala apha</h3>
            </div>
            <?php flash('register_success'); ?>
            <?php flash('confirmation_success'); ?>
            <?php flash('password_reset_message'); ?>
        </div>
        <div class="card card-body shadow-sm md-4 p-3">
            <?php echo flash('message_yomsebenzi'); ?>
            <form action="<?php echo URLROOT; ?>/testimonials/add" method="post">
                <div class="form-group pt-3">
                    <textarea name="add-testimonial" id="addTestimonial" class="form-control add-testimonial" rows="3" placeholder="Testimonial yakho yibhale apha" autofocus></textarea>
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="row testimonial-btn">
                    <div class="col">
                        <input type="submit" value="Cofa xa ugqibile" class="form-btn__primary btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>