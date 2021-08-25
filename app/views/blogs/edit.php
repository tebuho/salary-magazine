<?php require APPROOT .'/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/chatroom-navbar.php'; ?>
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
                    <form action="<?php echo URLROOT; ?>/blogs/edit/<?php echo $data['id']; ?>" method="post">
                        <div class="form-container">
                            <div class="input-label__container">
                                <div class="label-container">
                                    <label for="singantoni">Edit</label>
                                </div>
                                <div class="input-container">
                                    <input type="text" name="title" id="title" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title'] ?>">
                                    <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                                </div>
                            </div>
                            <div class="input-label__container mt-3">
                                <div class="label-container">
                                    <label for="isaziso">Sibhale apha</label>
                                </div>
                                <div class="input-container">
                                    <textarea rows="10" name="body" id="body" class="form-control <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" required="required"><?php echo $data['body']; ?></textarea>
                                    <span class="invalid-feedback"><?php echo $data['body_err'] ?></span>
                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        CKEDITOR.replace( 'body' );
                                    </script>
                                </div>
                            </div>
                            <div class="input-label__container mt-3">
                                <div class="input-container flex">
                                    <button class="form-btn__primary">Cofa xa Ugqibile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="<?php echo URLROOT; ?>/blogs/delete/<?php echo $data['id']; ?>" method="post">
                        <div class="input-container flex">
                            <button class="btn-delete"><i class="far fa-trash-alt"></i>&nbsp;Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>