<?php require APPROOT .'/views/inc/header.php'; ?>
    <div class="main-content">
        <div class="body-container container">
            <div class="right-side profile-sidebar col-md-2">
                <div class="sidebar-container">
                    <h2>Please note</h2>
                    <hr />
                    <p>This website is written in isiXhosa. For the English version please click on English.</p>
                </div>
            </div>
            <div class="ml-3 mr-3 center-side profile-content col-md-6">
                <div class="experience-title pt-2">
                    <h3 class="page-container">Personal details</h3>
                </div>
                <?php echo flash('message_ye_profile'); ?>
                <div class="profile-card">
                    <form action="<?php echo URLROOT; ?>/abantu/profile/<?php echo $data['id']; ?>" method="post">
                        <div class="form-row">
                            <div class="col">
                                <label for="igama lakho">Igama Lakho: <sup class="text-danger">*</sup></label>
                                <input type="text" name="igama" class="bg-light form-control form-control-lg <?php echo (!empty($data['igama_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['igama']; ?>">
                                <span class="invalid-feedback"><?php echo $data['igama_err']; ?></span>
                            </div>
                            <div class="col">
                                <label for="fani yakho">Fani Yakho: <sup class="text-danger">*</sup></label>
                                <input type="text" name="fani" class="bg-light form-control form-control-lg <?php echo (!empty($data['fani_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['fani']; ?>">
                                <span class="invalid-feedback"><?php echo $data['fani_err']; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email: <sup class="text-danger">*</sup></label>
                            <input type="email" name="email" class="bg-light form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="phone number">Phone Number  <small>(Optional)</small></label>
                            <input type="tel" name="phone_number" class="bg-light form-control form-control-lg <?php echo (!empty($data['phone_number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone_number']; ?>">
                            <span class="invalid-feedback"><?php echo $data['phone_number_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="province_yakho">Province ohlala kuyo: <sup class="text-danger">*</sup></label>
                            <select name="province" class="bg-light form-control" id="">
                                <?php $choose = new Provinces; ?>
                                <option class="form-control" value="<?php echo empty($data['province']) ? 'Khetha' : $data['province']; ?>"><?php echo empty($data['province']) ? 'Khetha' : $data['province']; ?></option>
                                <?php  foreach ($choose->provinces as $province => $province_slug): ?>
                                        <option class="form-control" value=" <?php echo $province; ?>"> <?php echo $province; ?></option>
                                <?php endforeach ?>
                            </select>
                            <span class="invalid-feedback"><?php echo $data['province_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="ndawoni">Ndawoni: <sup class="text-danger">*</sup></label>
                            <input type="text" name="ndawoni" class="bg-light form-control form-control-lg <?php echo (!empty($data['ndawoni_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ndawoni']; ?>">
                            <span class="invalid-feedback"><?php echo $data['ndawoni_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="zazise">Describe yourself</label>
                            <textarea rows="6" name="zazise" class="form-control form-control-lg <?php echo (!empty($data['zazise_err'])) ? 'is-invalid' : ''; ?>"><?php echo ltrim($data['zazise']); ?></textarea>
                            <span class="invalid-feedback"><?php echo $data['zazise_err']; ?></span>
                        </div>
                        <div class="form-group mb-0">
                            <label for="Uyasebenza">Uyasebenza?</label>
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input name="uyasebenza" class="bg-light form-check-input" type="radio" id="ewe_ndiyasebenza" value="Ewe" <?php echo ($data['uyasebenza'] == 'Ewe') ? 'checked' : ''; ?>>
                                <label class="form-check-label font-weight-normal" for="inlineCheckbox1">Ewe</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="uyasebenza" class="bg-light form-check-input" type="radio" id="hayi_andisebenzi" value="Hayi" <?php echo ($data['uyasebenza'] == 'Hayi') ? 'checked' : ''; ?>>
                                <label class="form-check-label font-weight-normal" for="inlineCheckbox2">Hayi</label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label for="Gender">Gender</label>
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input name="gender" class="bg-light form-check-input" type="radio" id="female" value="Female" <?php echo ($data['gender'] == 'Female') ? 'checked' : ''; ?>>
                                <label class="form-check-label font-weight-normal" for="inlineCheckbox1">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="gender" class="bg-light form-check-input" type="radio" id="male" value="Male" <?php echo ($data['gender'] == 'Male') ? 'checked' : ''; ?>>
                                <label class="form-check-label font-weight-normal" for="inlineCheckbox2">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input dor="ayibalulekanga" name="gender" class="bg-light form-check-input" type="radio" id="ayibalulekanga" value="Ayibalulekanga" <?php echo ($data['gender'] == 'Ayibalulekanga') ? 'checked' : ''; ?>>
                                <label class="form-check-label font-weight-normal" for="inlineCheckbox2">Ayibalulekanga</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col flex">
                                <button class="form-btn__primary">Cofa xa Ugqibile</button>
                            </div>
                        </div>
                        <div class="input-label__container">
                    </div>
                    </form>
                </div>
            </div>

            <?php require APPROOT .'/views/abantu/inc/aside.php'; ?>

        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>