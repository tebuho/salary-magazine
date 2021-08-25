<?php
$province = new Provinces;

$test = '';
if (isset($_GET['url'])) {
    $test = $_GET['url'];
}

if(isset($test)) {
    if ($test == "easternCapeJobs/" || $test == "easternCapeJobs" || strpos($test, "easternCapeJobs") !== false) {
        
        $province_slug = "easternCapeJobs";
        $provinces_name = "Eastern Cape";


    } elseif ($test == "freeStateJobs/" || $test == "freeStateJobs" || strpos($test, "freeStateJobs") !== false) {
        
        $province_slug = "freeStateJobs";
        $provinces_name = "Free State";

    } elseif ($test == "gautengJobs/" || $test == "gautengJobs" || strpos($test, "gautengJobs") !== false) {
            
        $province_slug = "gautengJobs";
        $provinces_name = "Gauteng";

    } elseif ($test == "kwaZuluNatalJobs/" || $test == "kwaZuluNatalJobs" || strpos($test, "kwaZuluNatalJobs") !== false) {
        
        $province_slug = "kwaZuluNatalJobs";
        $provinces_name = "KwaZulu-Natal";

    } elseif ($test == "limpopoJobs/" || $test == "limpopoJobs" || strpos($test, "limpopoJobs") !== false) {
        
        $province_slug = "limpopoJobs";
        $provinces_name = "Limpopo";

    } elseif ($test == "mpumalangaJobs/" || $test == "mpumalangaJobs" || strpos($test, "mpumalangaJobs") !== false) {
        
        
        $province_slug = "mpumalangaJobs";
        $provinces_name = "Mpumalanga";

    } elseif ($test == "northWestJobs/" || $test == "northWestJobs" || strpos($test, "northWestJobs") !== false) {
        
        $province_slug = "northWestJobs";
        $provinces_name = "North West";

    } elseif ($test == "northernCapeJobs/" || $test == "northernCapeJobs" || strpos($test, "northernCapeJobs") !== false) {
        
        $province_slug = "northernCapeJobs";
        $provinces_name = "Northern Cape";

    } elseif ($test == "westernCapeJobs/" || $test == "westernCapeJobs" || strpos($test, "westernCapeJobs") !== false) {
        
        $province_slug = "westernCapeJobs";
        $provinces_name = "Western Cape";
        
    } else {
        
        $slug_parameter = explode("/", $test); 
        $province_slug =  $slug_parameter[0];
    }
}
?>
