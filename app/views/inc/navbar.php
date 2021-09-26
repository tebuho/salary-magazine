<div class="nav-container highlight-grey pt-1 pb-1 border-top-0 border-left-0 border-right-0">
    <nav class="navbar navbar-expand-lg pb-0">
        <div class="container">
    <a class="navbar-brand" href="<?php echo URLROOT; ?>" title="<?php echo SITENAME; ?>">
      <img src="<?php echo URLROOT; ?>/public/img/sm-logo.png" alt="<?php echo SITENAME; ?>" />
    </a>
    <button class="navbar-toggler float-right pr-0" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">Menu</span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample07">
      <ul class="navbar-nav ml-auto">
          <?php if (isset($_GET['url']) ) : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>">Imisebenzi <span class="sr-only">(current)</span></a>
            </li>
          <?php endif; ?>
          <?php if (!empty($_SESSION) && $_SESSION["role"] === "Admin" ) : ?>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/admins/">Admin Area</a>
              <a class="nav-link d-none" href="<?php echo URLROOT; ?>/employers/">Employers</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/addJobs/add">Faka Umsebenzi</a>
          </li>
          <?php endif; ?>
        <?php if (isset($_SESSION['user_id']) ): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/abantu/logout">Logout</a>
        </li>
        <?php elseif($_SERVER['QUERY_STRING'] !== 'url=abantu/login' ) : ?>
        <li class="nav-item">
          <a class="nav-link ngena" href="<?php echo URLROOT; ?>/abantu/login">Ngena&nbsp;<i class="fas fa-arrow-right"></i></a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
    </nav>
</div>