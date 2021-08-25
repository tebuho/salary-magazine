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
            <div class="center-side profile-content col-md-7">
                
                <div class="heading-container card-lokubuza mt-3 mb-3">
                    <div class="user-feed__meta">
                        <div class="add-content text-dark font-weight-bold">
                            <p>Sixelele ufuna umsebenzi onjani. Sizokwazisa nge email xa siwufumene.</p>
                        </div>
                    </div>
                </div>
                
                
                <?php if ($_GET['url'] != "abantu/education/tertiary-education/" . $data['id']) {

                    require APPROOT .'/views/abantu/education/primary_secondary_education.php';

                } else {
                   
                    require APPROOT .'/views/abantu/education/tertiary.php';

                }
                ?>

            </div>

            <?php require APPROOT .'/views/abantu/inc/aside.php'; ?>

        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>