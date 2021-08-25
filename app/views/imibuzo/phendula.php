<?php require APPROOT .'/views/inc/header.php'; ?>
<?php $date = new Convert; ?>
<div class="main-content add-job">
    <div class="page container">
        <div class="page-container">
            <a href="<?php echo URLROOT; ?>/imibuzo"><span class="pl-0">Buyela emva</span></a>
        </div>
    </div>
    <div class="body-container container comments-body">
        <div class="right-side profile-sidebar col-md-3">
            <div class="sidebar-container">
                <h3>Please note</h3>
                <hr />
                <p>This website is written in isiXhosa. For the English version please click on English.</p>
            </div>
        </div>
        <div class="center-side profile-content col-md-7" style="margin: 0; 60px">
        <div id="<?php echo $data['id_yombuzo']; ?>"></div>
        <div class="page-container question-title">
            <h3><?php echo $data['full_name']; ?> | <?php echo $data['ungantoni']; ?></h3>
        </div>
            <div class="card-lo-msebenzi heading-container q-box index-title">
                <?php echo flash('message_yombuzo'); ?>
                <div class="responder-box pb-2">
                    <div class="comment-avatar"><?php echo $data['initials']; ?></div>
                    <div class="user-feed__meta card-header ml-3 pt-2">
                        <div class="avatar-container">
                            <h5><?php echo ucwords(strtolower($data['igama'])); ?> <?php echo ucfirst(strtolower($data['fani'])); ?></h5>
                        </div>
                        <div class="avatar-container">
                            <span class="timeline-date"><?php echo $date->convertDayDate($data['date']); ?> ka <?php echo $date->convertMonthYear($data['date']); ?></span>
                        </div>
                    </div>
                </div>
                        <div class="content-container">
                            <div class="umbuzo-content">
                                <p><?php echo $data['umbuzo']; ?></p>
                            </div>
                        </div>

                    <div class="label-container no-comments d-none">
                        <label for="imibuzo">Impendulo</label>
                    </div>
                <?php if (empty($data['comments'])) {?>
                    <div class="comments-box no-comments d-none">
                        <div class="comments-container">
                            <div class="commenting-user" data-post="<?php echo $data['id_yombuzo']; ?>" data-username="<?php echo $data['username']; ?>" id="<?php echo $_SESSION['id_yomntu']; ?>" style="visibility:hidden"></div>
                            <?php foreach ($data['comments'] as $comment) : ?>
                                <div class="card comment-card">
                                    <div class="responder-box">
                                        <div class="comment-avatar"><?php echo $comment->initials; ?></div>
                                        <div class="card-header pb-2 ml-3">
                                            <h5>
                                                <?php if ($comment->role === "Admin") {
                                                    echo ucwords(strtolower($comment->igama)) . " " . ucwords(strtolower($comment->fani)) . " <span class='timeline-date'>$comment->role</span>";
                                                } else {
                                                    echo ucwords(strtolower($comment->igama)) . " " . ucwords(strtolower($comment->fani));
                                                }
                                                ?>
                                            </h5>
                                                <span class="timeline-date">
                                                    <?php echo $date->convertDayDate($comment->date); ?> ka <?php echo $date->convertMonthYear($comment->date); ?>
                                                </span>
                                            <div class="card-body">
                                                <p><?php echo $comment->impendulo; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card comment-card" id="no-comment">
                        <div class="commenting-user" data-post="<?php echo $data['id_yombuzo']; ?>" data-username="<?php echo $data['username']; ?>" id="<?php echo $_SESSION['id_yomntu']; ?>" style="visibility:hidden"></div>
                        <ul><li class="pb-2"><em>Akho mpendulo</em></li></ul>
                    </div>
                <?php } else { ?>
                <div class="comments-box">
                    <div class="comments-container">
                        <div class="commenting-user" data-post="<?php echo $data['id_yombuzo']; ?>" data-username="<?php echo $data['username']; ?>" id="<?php echo $_SESSION['id_yomntu']; ?>" style="visibility:hidden"></div>
                        <?php foreach ($data['comments'] as $comment) : ?>
                            <div class="card comment-card">
                                <div class="responder-box">
                                    <div class="comment-avatar"><?php echo $comment->initials; ?></div>
                                    <div class="card-header pb-2 ml-3">
                                        <h5>
                                            <?php if ($comment->role === "Admin") {
                                                 echo ucfirst(strtolower($comment->igama)) . " " . ucfirst(strtolower($comment->fani)) . " <span class='timeline-date'>$comment->role</span>";
                                            } else {
                                                echo ucwords(strtolower($comment->igama)) . " " . ucwords(strtolower($comment->fani));
                                            }
                                            ?>
                                        </h5>
                                            <span class="timeline-date">
                                                <?php echo $date->convertDayDate($comment->date); ?> ka <?php echo $date->convertMonthYear($comment->date); ?>
                                            </span>
                                        <div class="card-body">
                                            <p><?php echo $comment->impendulo; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if (isset($_SESSION['id_yomntu'])) { ?>
                    <div class="label-container mt-3">
                        <label for="imibuzo">Phendula apha</label>
                    </div>
                    <form id="impendulo" action="<?php echo URLROOT; ?>/imibuzo/phendula/<?php echo $data['id'] ?>" method="post">
                        <div class="form-container pt-0">
                            <div class="input-label__container">
                                <div class="input-container">
                                    <textarea name="impendulo" id="phendula" class="form-control <?php echo (!empty($data['impendulo_err'])) ? 'is-invalid' : ''; ?>" placeholder="Phendula apha..." required="required"></textarea>
                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        CKEDITOR.replace( 'phendula' );
                                    </script>
                                    <span class="invalid-feedback"><?php echo $data['impendulo_err'] ?></span>
                                </div>
                            </div>
                            <div class="input-label__container mt-3">
                                <div class="input-container">
                                    <button id="phendula-btn" class="form-btn__primary">Cofa xa Ugqibile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class="social-commentary pt-3">
                        <div class="user-to__do">
                            <p>Kufuneka ungene kwi profile yakho ukuze ukwazi ukuphendula.
                                <a href='<?php echo URLROOT ."/abantu/login"; ?>' id="likeCV">
                                    Cofa apha.
                                </a>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="left-side">
            <div class="province-header">
                <h4>Profile</h4>
            </div>
            <div class="province-container filter-container">
                <ul class="province filter">
                    <li><a href="">About</a></li>
                    <li><a href="">CV</a></li>
                    <li><a href="">Imisebenzi</a></li>
                    <li><a href="">Izaziso</a></li>
                    <li><a href="">Izikhalazo</a></li>
                    <li><a href="">Abantu</a></li>
                    <li><a href="">Images</a></li>
                    <li><a href="">Magazine</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>