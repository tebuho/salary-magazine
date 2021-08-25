<?php require APPROOT .'/views/inc/header.php'; ?>
    <div class="main-content outer">
        <div class="container">
            <div class="col-md-12">
                <h1>Employers</h1>
            </div>
        </div>
        <div class="body-container__employers container">
            <div class="profile-content m-0 col-md-12">
                <section class="section-search__imisebenzi pt-1 pb-3 highlight-grey">
                    <div class="container p-0">
                        <div class="section-search__form pt-2 m-auto">
                            <form action="<?php echo URLROOT; ?>/admins/search/1" method="GET">
                                <div class="col search-imisebenzi mt-3 col-sm-12 search-home pl-0">
                                    <input type="text" name="search" class="mb-0 form-control form-control-lg" placeholder="Ukhangela ntoni? Bhala apha and search" autofocus>
                                    <button type="submit" class="btn btn-primary-sm">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <?php echo flash('message_yomsebenzi'); ?>
                <div class="pagination-bar">
                    <div class="page-breadcrumb">
                    </div>
                </div>
                <span><small>Search results for <?php echo $data["search"]; ?></small></span>
                <div class="table-container">
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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            
                            <td></td>
                            <!-- Edit Job -->
                            <td></td>
                            <!-- View Job -->
                            <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <span><small>No results found</small></span>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>