<?php
if ($data['total_pages'] > 1) : ?>

    <div class="pagination text-center">

        <ul class="pagination-links">

            <?php

                // $test = $_GET['url'];

                // if ($_GET['url'] != "$province_slug/" && $_GET['url'] != "$province_slug" && $_GET['url'] != "$province_slug/1" && $data['page'] > 2) {

                //     echo "<li><a href='" . URLROOT . "/$province_slug/" .($data['page']-1)."'>Emva</a></li>";

                // }
                $get_url = "1";
                if (isset($_GET['url'])) {
                    $get_url = $_GET['url'];
                }
                    $url_path = preg_replace("/[0-9]+/", "", $get_url);
                    if ($url_path === "imibuzo") {
                        $url_path = "imibuzo/";
                    }
                    
                    if ($get_url == "$province_slug/" || $data['page'] == 0) {

                        $data['page'] = '1';
        
                        }
                        if ($data['page'] > 3 && $url_path == "" || $data['page'] > 3 && !str_contains($url_path, "search")) {
                            
                            echo "<li><a href='" . URLROOT . "/" . $url_path . 1 . "'>1</a></li>";
                        }
                        if ($data['page'] > 3 && isset($_GET['search'])) {
                            echo "<li><a href='" . URLROOT . "/" . $url_path . 1 . "?search=". $_GET['search']. "'>1</a></li>";
                        }
                        if ($data['page'] > 4) {
                            echo "<li><span>...</span></li>";
                        }

                for ($i = $data['initial_num']; $i < $data['condition_limit_num']; $i++) {
                    if (($i > 0) && ($i <= $data['total_pages'])) {
                        if ($get_url == "$province_slug/" || $get_url == $url_path || $data['page']
                        < 1) {

                            echo "<li class='active'>$i</li>";
                            
                        } elseif ($get_url == "$province_slug/$i" || $get_url == $url_path.$i || $get_url . $i == $url_path . $i) {

                            echo "<li class='active'>$i</li>";

                        } elseif (!isset($_GET['search'])) {
                            echo "<li><a href='" . URLROOT . "/" . $url_path . $i . "'>" . $i . "</a></li>";
                        }
                        else {
                            echo "<li><a href='" . URLROOT . "/" . $url_path . $i . "?search=". $_GET['search']. "'>" . $i . "</a></li>";

                        }

                    }

                }
                
                if ($data['page'] < $data['total_pages'] && $data['total_pages'] >= $i || $data['page'] < 0 && $data['total_pages'] >= $i) {
                    if (isset($_GET['search'])) {
                        $search = "?search=" . $_GET['search'];
                    } else {
                        $search = "";
                    }
                    echo "<li><a href='" . URLROOT . "/" . $url_path . $i . $search."'>" . $i . "</a></li>";
                    if (($data['total_pages'] - $data['page']) > 2) {
                        echo "<li><span>...</span></li>";
                        echo "<li><a href='" . URLROOT . "/" . $url_path . $data['total_pages'] . $search."'>" . $data['total_pages'] . "</a></li>";
                    }
                    

                }
            ?>
        </ul>
    </div>
<?php endif; ?>