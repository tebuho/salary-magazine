<?php require APPROOT .'/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/chatroom-navbar.php'; ?>
<div class="main-content__home add-job">
    <div class="page container">
        <div class="page-container register-login">
            <h1><?php echo $data['page_title']; ?></h1>
        </div>
    </div>
    <div class="body-container container home">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-body bg-light md-5">
                    <form action="<?php echo URLROOT; ?>/blogs/bhala" method="post" enctype="multipart/form-data">
                        <div class="form-container">
                            <div class="input-label__container">
                                <div class="label-container">
                                    <label for="image">Title ye blog yakho</label>
                                </div>
                                <div class="input-container">
                                    <input type="text" name="title" id="title" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title'] ?>">
                                    <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                                </div>
                            </div>
                            <div class="input-label__container mt-3">
                                <div class="label-container">
                                    <label for="isaziso">Body ye blog yibhale apha</label>
                                </div>
                                <div class="input-container">
                                    <textarea rows="20" name="body" id="body" class="form-control <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" required="required"><?php echo $data['body']; ?></textarea>
                                    <span class="invalid-feedback"><?php echo $data['body_err'] ?></span>
                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        CKEDITOR.replace( 'body' );
                                    </script>
                                </div>
                            </div>
                            <div class="custom-file mt-3">
                                <input type="file" name="image" class="custom-file-input <?php echo (!empty($data['image_name_err'])) ? 'is-invalid' : ''; ?>" id="image" value="<?php echo $data['image_name'] ?>">
                                <label class="custom-file-label" for="validatedCustomFile">Choose image...</label>
                                <span class="invalid-feedback"><?php echo $data['image_name_err']; ?></span>
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