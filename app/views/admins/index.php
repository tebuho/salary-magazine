<?php require APPROOT .'/views/inc/header.php'; ?>
    <div class="main-content outer">
        <div class="container">
            <div class="col-md-12">
                <h1>Employers</h1>
                <ul>
                    <li><a href="http://localhost/new/employers/">Employers</a></li>
                </ul>
            </div>
        </div>
        <div class="body-container__employers container">
            <div class="profile-content m-0 col-md-9">
            <?php    if(!empty($data['imisebenzi'])) { ?>
                <section class="section-search__imisebenzi pt-1 pb-3 highlight-grey">
                    <div class="container p-0">
                        <div class="section-search__form pt-2 m-auto">
                            <form action="<?php echo URLROOT; ?>/admins/search/1" method="GET">
                                <div class="col search-imisebenzi mt-3 col-sm-12 search-home pl-0">
                                    <input type="text" name="search" class="mb-0 form-control form-control-lg" placeholder="Ukhangela ntoni? Bhala apha and search" autofocus>
                                    <button type="submit" class="btn btn btn-info">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <?php echo flash('message_yomsebenzi'); ?>
                <div class="pagination-bar">
                    <div class="page-breadcrumb">
                    <?php 
                    if ($data['page'] == 0){
                        $data['page'] = 1;
                    }
                    echo "<p class='text-muted m-0'><small>Page " . $data['page'] . " of " . number_format($data['total_pages'], 0, '', ' ') . "</small></p>";
                    ?>
                    </div>
                    <div class="top-pagination text-right">
                        <?php include  APPROOT .'/views/inc/pagination.php'; ?>
                    </div>
                </div>
                <div class="table-container">
                    <div class="text-right">
                        <p class="m-0 text-muted">
                            <small><?php echo number_format($data['total_jobs'], 0, '', ' '); ?> jobs found</small>
                        </p>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead class="highlight-grey">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Employer</th>
                            <th scope="col">Position</th>
                            <th scope="col">User</th>
                            <th scope="col">Province</th>
                            <th scope="col">Published</th>
                            <th scope="col">Closing</th>
                            <th scope="col">Edit</th>
                            <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                for ($x = 0; $x < count($data['imisebenzi']); $x++) {
                                    // if($x === 6 && count($data['imisebenzi']) >= 12 || $x === 11) {
                                    //     require APPROOT .'/views/inc/infeed-ad.php';
                                    // }
                                    ?>
                                    <tr>
                                    <?php if ($data['page'] == 0 || $data['page'] == 1) {
                                        echo "<td>" . ($x+1) . "</td>";
                                    } elseif ($data['page'] > 1) {
                                        $page_by_jobs = count($data['imisebenzi']) * $data['page'];
                                        $jb_nr = ($page_by_jobs - count($data['imisebenzi'])) +($x + 1);
                                        echo "<td>" . number_format($jb_nr, 0, '', ' ') . "</td>";
                                    }
                                    ?>
                                    
                                    <td><?php echo $data['imisebenzi'][$x]->job_employer; ?></td>
                                    <td><?php echo $data['imisebenzi'][$x]->job_title; ?></td>
                                    <td style="white-space:nowrap"><?php echo $data['imisebenzi'][$x]->igama == "G. Ats" ? "Graylink" : $data['imisebenzi'][$x]->igama; ?></td>
                                    <td style="white-space:nowrap"><?php echo $data['imisebenzi'][$x]->province; ?></td>
                                    <td><?php echo $data['imisebenzi'][$x]->date_created; ?></td>
                                    
                                    <td><?php echo $data['imisebenzi'][$x]->job_closing_date == "0/0/0" ? "0/0/0000" : $data['imisebenzi'][$x]->job_closing_date; ?></td>
                                    <!-- Edit Job -->
                                    <td class="text-center"><a href='<?php echo URLROOT . "/" . $data['imisebenzi'][$x]->province_slug . "/edit/" . $data['imisebenzi'][$x]->slug; ?>' target="_blank" data-toggle='tooltip' data-html='true' data-placement='top' title='<?php echo $data['imisebenzi'][$x]->slug ?>'><i class="far fa-edit"></i></a></td>
                                    <!-- View Job -->
                                    <td class="text-center"><a href='<?php echo URLROOT . "/" . $data['imisebenzi'][$x]->province_slug . "/umsebenzi/" . $data['imisebenzi'][$x]->slug; ?>' target="_blank" data-toggle='tooltip' data-html='true' data-placement='top' title='<?php echo $data['imisebenzi'][$x]->slug ?>'><i class="far fa-eye"></i></a></td>
                                    </tr>
                                <?php }?>
                        </tbody>
                    </table>
                </div>
                <?php include  APPROOT .'/views/inc/pagination.php'; ?>
                <?php } ?>
            </div>
        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>