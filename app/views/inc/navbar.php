<div class="nav-container highlight-grey pt-1 pb-0 border-top-0 border-left-0 border-right-0">
    <nav class="navbar navbar-expand-lg pb-0">
        <div class="container">
          <div class="logo-container col-md-2 pl-0">
            <a class="navbar-brand col-md-2" href="<?php echo URLROOT; ?>" title="<?php echo SITENAME; ?>">
              <img src="<?php echo URLROOT; ?>/public/img/sm-logo.png" alt="<?php echo SITENAME; ?>" />
            </a>
        </div>
        <div class="section-search__form mt-1 col-md-6 pl-0">
            <form action="<?php echo URLROOT; ?>/search" method="GET">
                <div class="col search-imisebenzi col-sm-12 search-home pl-0">
                    <input type="text" name="search" class="mb-0 form-control form-control-lg" placeholder="Ukhangela ntoni? Bhala apha and search" autofocus="">
                    <button type="submit" class="btn btn btn-info"><small><i class="fas fa-search"></i></small>&nbsp;Search</button>
                </div>
            </form>
        </div>
          <button class="navbar-toggler float-right pr-0" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">Menu</span>
          </button>

          <div class="collapse navbar-collapse col-md-3" id="navbarsExample07">
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_GET['url']) ) : ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>">Imisebenzi <span class="sr-only">(current)</span></a>
                  </li>
                <?php endif; ?>
                <?php if (!empty($_SESSION) && $_SESSION["role"] === "Admin" ) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/admins/">
                        <small><i class="fas fa-cogs"></i></small>&nbsp;Admin Area
                    </a>
                    <a class="nav-link d-none" href="<?php echo URLROOT; ?>/employers/">Employers</a>
                </li>
                <?php endif; ?>
              <?php if (isset($_SESSION['user_id']) ): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/abantu/logout">
                <small><i class="fas fa-toggle-on"></i></small>&nbsp;Logout</a>
              </li>
              <?php elseif($_SERVER['QUERY_STRING'] !== 'url=abantu/login' ) : ?>
              <li class="nav-item">
                <a class="nav-link ngena" href="<?php echo URLROOT; ?>/abantu/login">
                  <small><i class="fas fa-toggle-off"></i></small>&nbsp;Ngena
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </div>
      </div>
    </nav>
</div>