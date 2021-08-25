<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="main-content">
    <div class="body-container container home">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="page container">
                        <div class="page-container register-login">
                            <h1>Tshintsh' password yakho</h1>
                        </div>
                    </div>
                    <div class="card card-body bg-light md-4">
                        <form action="<?php echo URLROOT; ?>/abantu/password" method="POST">
                            <div class="form-container">
                                <p>Faka i-email address yakho ukuze sizokuthumelela indlela ozokuyitshintsha ngayo i-password yakho.</p>
                                <div class="input-label__container">
                                    <div class="label-container">
                                        <label for="Email">Email yakho</label>
                                    </div>
                                    <div class="input-container flex">
                                        <input type="email" name="" id="input" class="form-control" value="" required="required"placeholder="Bhala apha then ucofe ezantsi xa ugqibile">
                                    </div>
                                </div>
                                <div class="input-label__container">
                                    <div class="input-container flex">
                                        <button class="form-btn__primary">Cofa xa Ugqibile</button>
                                    </div>
                                </div>
                                <div class="input-label__container">
                                    <div class="input-container mt-3">
                                        <p>Ufuna ukungena? <a href="<?php echo URLROOT; ?>/abantu/login/">Cofa apha</a></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="page container">
                    <div class="page-container register-login">
                    <p>Ufuna ukubhalisa? <a href="<?php echo URLROOT; ?>/abantu/register/">Cofa apha</a></p>
            </div>
                </div>
            </div>
        </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>