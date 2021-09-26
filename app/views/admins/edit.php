<?php require APPROOT .'/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/chatroom-navbar.php'; ?>
    <div class="main-content outer">
        <div class="body-container container">
            <div class="col-md-9 mx-auto">
                <div class="container">
                    <div class="row">
                        <div class="bhalisa-ngena__form edit-employer white-background-border col-md-6">
                            <div class="d-flex">
                                <div class="heading" style="flex:1"><h1>Edit <?php echo $data['employer']; ?></h1></div>
                                <div class="delete" id="deleteEmployer" data-toggle="modal" data-target="#delete-prompt"><a href="<?php echo URLROOT . '/employers/delete/' . $data['employer_slug'] ?>"><small><i class="far fa-trash-alt"></i>&nbsp;Delete</small></a></div>
                            </div>
                            <form action="<?php echo URLROOT; ?>/<?php echo $_GET['url']; ?>" method="post" enctype="multipart/form-data">
                                <div class="form-container">
                                    <!-- Employer -->
                                    <div class="input-label__container">
                                        <div class="label-container">
                                            <label for="job_employer">Employer</label>
                                        </div>
                                        <div class="input-container">
                                            <input type="text" name="job_employer" class="form-control form-control-lg <?php echo (!empty($data['employer_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['employer']; ?>" autofocus>
                                            <span class="invalid-feedback"><?php echo $data['employer_err']; ?></span>
                                        </div>
                                    </div>
                                    <!-- Vacancies -->
                                    <div class="input-label__container">
                                        <div class="label-container">
                                            <label for="vacancies">Vacancies</label>
                                        </div>
                                        <div class="input-container">
                                            <input type="url" name="vacancies" id="igama-le-company" class="form-control form-control-lg <?php echo (!empty($data['vacancies_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['vacancies']; ?>">
                                            <span class="invalid-feedback"><?php echo $data['vacancies_err']; ?></span>
                                        </div>
                                    </div>
                                    <!-- Website -->
                                    <div class="input-label__container">
                                        <div class="label-container">
                                            <label for="website">Website</label>
                                        </div>
                                        <div class="input-container">
                                            <input type="url" name="website" id="igama-le-company" class="form-control form-control-lg <?php echo (!empty($data['website_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['website']; ?>">
                                            <span class="invalid-feedback"><?php echo $data['website_err']; ?></span>
                                        </div>
                                    </div>
                                    <!-- Head Office -->
                                    <div class="input-label__container">
                                        <div class="label-container">
                                            <label for="head_office">Head Office</label>
                                        </div>
                                        <div class="input-container">
                                            <input type="text" name="head_office" class="form-control form-control-lg <?php echo (!empty($data['head_office_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['head_office']; ?>" autofocus>
                                            <span class="invalid-feedback"><?php echo $data['head_office_err']; ?></span>
                                        </div>
                                    </div>
                                    <!-- Facebook -->
                                    <div class="input-label__container">
                                        <div class="label-container">
                                            <label for="facebook">Facebook</label>
                                        </div>
                                        <div class="input-container">
                                            <input type="url" name="facebook" id="igama-le-company" class="form-control form-control-lg <?php echo (!empty($data['facebook_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['facebook']; ?>">
                                            <span class="invalid-feedback"><?php echo $data['facebook_err']; ?></span>
                                        </div>
                                    </div>
                                    <!-- LinkedIn -->
                                    <div class="input-label__container">
                                        <div class="label-container">
                                            <label for="linkedin">LinkedIn</label>
                                        </div>
                                        <div class="input-container">
                                            <input type="url" name="linkedin" id="igama-le-company" class="form-control form-control-lg <?php echo (!empty($data['linkedin_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['linkedin']; ?>">
                                            <span class="invalid-feedback"><?php echo $data['linkedin_err']; ?></span>
                                        </div>
                                    </div>
                                    <!-- Twitter -->
                                    <div class="input-label__container">
                                        <div class="label-container">
                                            <label for="twitter">Twitter</label>
                                        </div>
                                        <div class="input-container">
                                            <input type="url" name="twitter" id="igama-le-company" class="form-control form-control-lg <?php echo (!empty($data['twitter_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['twitter']; ?>">
                                            <span class="invalid-feedback"><?php echo $data['twitter_err']; ?></span>
                                        </div>
                                    </div>
                                    <!-- Type -->
                                    <div class="input-label__container">
                                        <div class="label-container">
                                            <label for="head_office">Type</label>
                                        </div>
                                        <div class="input-container">
                                            <input type="text" name="type" class="form-control form-control-lg <?php echo (!empty($data['head_office_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['type']; ?>">
                                        </div>
                                    </div>
                                    <div class="input-label__container">
                                        <div class="accordion" id="accordionExample">
                                            <!-- Provinces -->
                                            <div class="white-background-border mb-3">
                                                <div class="card-header" id="headingOne">
                                                    <h3 class="mb-0">
                                                        <button class="btn btn-block text-left d-flex rounded-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <span  class="m-0" style="flex:1;font-weight:600"><small>Provinces</small></span>
                                                        <span><small><i class="fas fa-plus toggle"></i></small></span>
                                                        </button>
                                                    </h3>
                                                </div>
                                                <div id="collapseOne" class="collapse col-md-12 pb-2 show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <?php 
                                                            $provinces = new Provinces();
                                                            foreach ($provinces->provinces as $province => $slug) { ?>
                                                            <div class="form-check">
                                                                <input id="<?php echo $province; ?>" type="checkbox" name="provinces[]" class="form-check-input <?php echo (!empty($data['provinces_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $province; ?>" <?php echo in_array($province, $data['provinces'], true) ? 'checked' : ''; ?>>
                                                                <label class="form-check-label" for="<?php echo $province; ?>"><?php echo $province; ?></label>
                                                            </div>
                                                        <?php  } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Category -->
                                            <div class="white-background-border mb-3">
                                                <div class="card-header" id="headingTwo">
                                                    <h3 class="mb-0">
                                                        <button class="btn btn-block text-left d-flex rounded-0" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                        <span  class="m-0" style="flex:1;font-weight:600"><small>Category</small></span>
                                                        <span><small><i class="fas fa-plus toggle"></i></small></span>
                                                        </button>
                                                    </h3>
                                                </div>
                                                <div id="collapseTwo" class="collapse col-md-12 pb-2" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <ul class="pl-3">
                                                            <div class="cat-column">
                                                                <?php 
                                                                    foreach ($data['categories'] as $category) { ?>
                                                                        <li>
                                                                            <input id="<?php echo $category->category; ?>" type="checkbox" name="categories[]" class="form-check-input <?php echo (!empty($data['categories_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $category->category; ?>" <?php echo in_array($category->category, $data['cat_from_employers'], true) ? 'checked' : ''; ?>>
                                                                            <label for="<?php echo $category->category; ?>"><?php echo $category->category; ?></label>
                                                                            </li>
                                                                <?php  } ?>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                    <div class="input-container">
                                                        <input type="text" name="category" class="form-control form-control-lg <?php echo (!empty($data['head_office_err'])) ? 'is-invalid' : ''; ?>">
                                                        <span class="invalid-feedback"><?php echo $data['head_office_err']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-label__container mt-3">
                                        <div class="input-container ">
                                            <button class="form-btn__primary btn-block">Cofa xa Ugqibile</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- <div class="modal fade" tabindex="-1" role="dialog" id="delete-prompt"aria-labelledby="modal-title">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-title">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete <?php echo $data['employer']; ?> from the employers' list?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary">Ewe</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayi</button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>