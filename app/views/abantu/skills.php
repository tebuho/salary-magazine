<?php require APPROOT .'/views/inc/header.php'; ?>
    <div class="main-content">
        <div class="body-container container">
            <div class="right-side profile-sidebar col-md-3">
                <div class="sidebar-container">
                    <h2>Please note</h2>
                    <hr />
                    <p>This website is written in isiXhosa. For the English version please click on English.</p>
                </div>
            </div>
            <div class="ml-3 mr-3 center-side profile-content col-md-6">
                <div class="experience-title pt-2">
                    <h3 class="page-container" id="experience">Skills & Competencies</h3>
                    <small class="float-right"><a href="#" id="add"><i class="fas fa-plus"></i> Add</a></small>
                </div>
                <?php echo error('error_message'); ?>
                <div class="profile-card skills-card">
                    <form action="<?php echo URLROOT; ?>/abantu/skills/<?php echo $data['id_yomntu'] ?>" method="post">
                        <div class="form-group" id="form-group">
                            <div id="input-group">
                                <?php if (!empty($data["skills"]) ): ?>
                                <?php foreach($data["skills"] as $skill): ?>
                                    <input type="text" name="skill[]" id="skill" class="bg-light form-control form-control-lg <?php echo (!empty($data['skill_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $skill; ?>">
                                <?php endforeach; ?>
                                <?php else : ?>
                                    <input type="text" name="skill[]" id="skill" class="bg-light form-control form-control-lg <?php echo (!empty($data['skill_err'])) ? 'is-invalid' : ''; ?>" value="">
                                <?php endif; ?>
                            <span class="invalid-feedback"><?php echo $data['skill_err']; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col flex">
                                <button class="form-btn__primary">Cofa xa Ugqibile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php require APPROOT .'/views/abantu/inc/aside.php'; ?>

        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>