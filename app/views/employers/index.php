<?php require APPROOT .'/views/inc/header.php'; ?>
    <div class="main-content outer">
        <div class="container">
            <div class="col-md-12">
                <h1>Employers</h1>
            </div>
        </div>
        <div class="body-container__employers container">
            <div class="profile-content m-0">
                <section class="section-search__imisebenzi pt-1 pb-3 highlight-grey">
                    <div class="container p-0">
                        <div class="section-search__form pt-2 m-auto">
                            <form action="<?php echo URLROOT; ?>/employers/search" method="POST">
                                <div class="col search-imisebenzi mt-3 col-sm-12 search-home pl-0">
                                    <input type="text" name="search" class="mb-0 form-control form-control-lg" placeholder="Ukhangela ntoni? Bhala apha and search" autofocus>
                                    <button type="submit" class="btn btn-primary-sm">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <?php include  APPROOT .'/views/inc/pagination.php'; ?>
                <?php echo flash('message_yomsebenzi'); ?>
                <table class="table table-bordered table-hover">
                    <thead class="highlight-grey">
                        <tr>
                        <th scope="col">Employer</th>
                        <th scope="col">Vacancies</th>
                        <th scope="col">Website</th>
                        <th scope="col">Head Office</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        if(!empty($data['employers'])) {
                            for ($x = 0; $x < count($data['employers']); $x++) {
                                // if($x === 6 && count($data['employers']) >= 12 || $x === 11) {
                                //     require APPROOT .'/views/inc/infeed-ad.php';
                                // }
                                ?>
                                <tr>
                                <td><?php echo $data['employers'][$x]->employer; ?></td>
                                <td><a href='<?php echo $data['employers'][$x]->vacancies; ?>' target="_blank" data-toggle='tooltip' data-html='true' data-placement='top' title='<?php echo $data['employers'][$x]->employer; ?>'>Cofa apha</a></td>
                                <td><a href='<?php echo $data['employers'][$x]->website; ?>' target="_blank" data-toggle='tooltip' data-html='true' data-placement='top' title='<?php echo $data['employers'][$x]->employer; ?>'>Cofa apha</a></td>
                                <td><?php echo $data['employers'][$x]->head_office; ?></td>
                                <!-- Edit employer -->
                                <td><a href='<?php echo URLROOT . "/employers/edit/" . $data['employers'][$x]->employer_slug; ?>' target="_blank" data-toggle='tooltip' data-html='true' data-placement='top' title='<?php echo $data['employers'][$x]->employer; ?>'>Edit</a></td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
                <?php include  APPROOT .'/views/inc/pagination.php'; ?>
            </div>
        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>