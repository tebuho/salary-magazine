
<div class="left-side col-md-3" style="visibility:visible">
<div class="empty"></div>
    <div class="province-container filter-container" style="display:block">
        <h1 class="page-container">Profile Yakho</h1>
        <div class="profile-nav__container bg-white p-3 border rounded">
            <ul class="province filter">
                <label for=""><?php echo $data["igama"] . " " . $data["fani"]; ?></label>
                <li><a href="<?php echo URLROOT; ?>/abantu/preference/<?php echo $_SESSION['id_yomntu'] ?>">Msebenzi Onjani</a></li>
                <li><a href="<?php echo URLROOT; ?>/abantu/profile/<?php echo $_SESSION['id_yomntu'] ?>">Personal details</a></li>
                <li class="font-weight-bolder">Education
                <ul class="ml-2 province filter font-weight-normal">
                    <li><a href="<?php echo URLROOT; ?>/abantu/primarySecondaryEducation/<?php echo $_SESSION['id_yomntu'] ?>">Primary/Secondary Education</a></li>
                    <li class="pb-0"><a href="<?php echo URLROOT; ?>/abantu/tertiaryEducation/<?php echo $_SESSION['id_yomntu'] ?>">Tertiary Education</a></li>
                </ul>
                </li>
                <li><a href="<?php echo URLROOT; ?>/abantu/experience/<?php echo $_SESSION['id_yomntu'] ?>">Work Experience</a></li>
                <li><a href="<?php echo URLROOT; ?>/abantu/skills/<?php echo $_SESSION['id_yomntu'] ?>">Skills &amp; Competencies</a></li>
                <li><a href="<?php echo URLROOT; ?>/abantu/cv/<?php echo $_SESSION['id_yomntu'] ?>">CV</a></li>
                <!-- <li><a href="<?php echo URLROOT; ?>/abantu/education/<?php echo $_SESSION['id_yomntu'] ?>">Imisebenzi</a></li>
                <li><a href="<?php echo URLROOT; ?>/abantu/imibuzo/<?php echo $_SESSION['id_yomntu'] ?>">imibuzo</a></li> -->
                <?php if ($data["role"] === "Admin") : ?>
                <li><a href="<?php echo URLROOT; ?>/addJobs/add">Faka Umsebenzi</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <?php require APPROOT .'/views/inc/adsense-sidebar.php'; ?>
    </div>
</div>