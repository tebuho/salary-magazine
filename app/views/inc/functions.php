<?php

require_once APPROOT .'\views\inc\cookies\logged-in.php';

/**
 * Province and its associated slug
 */
class Provinces 
{
    public $province_slug;
    public $provinces_name;
    public $provinces = [
            'Eastern Cape' => 'easternCapeJobs/',
            'Free State' => 'freeStateJobs/',
            'Gauteng' => 'gautengJobs/',
            'KwaZulu-Natal' => 'kwaZuluNatalJobs/',
            'Limpopo' => 'limpopoJobs/',
            'Mpumalanga' => 'mpumalangaJobs/',
            'North West' => 'northWestJobs/',
            'Northern Cape' => 'northernCapeJobs/',
            'Western Cape' => 'westernCapeJobs/'
    ];

    public $test;
    
    public function getProvinces() 
    {
        if (isset($_GET['url'])) {
            $this->test = $_GET['url'];
        }

        if(isset($this->test)) {
            if ($this->test == "easternCapeJobs/" || $this->test == "easternCapeJobs" || strpos($this->test, "easternCapeJobs") !== false) {
                
                $this->province_slug = "easternCapeJobs";
                $this->provinces_name = "Eastern Cape";
                return array ($this->province_slug, $this->provinces_name);

            } elseif ($this->test == "freeStateJobs/" || $this->test == "freeStateJobs" || strpos($this->test, "freeStateJobs") !== false) {
                
                $this->province_slug = "freeStateJobs";
                $this->provinces_name = "Free State";
                return array ($this->province_slug, $this->provinces_name);

            } elseif ($this->test == "gautengJobs/" || $this->test == "gautengJobs" || strpos($this->test, "gautengJobs") !== false) {
                    
                $this->province_slug = "gautengJobs";
                $this->provinces_name = "Gauteng";
                return array ($this->province_slug, $this->provinces_name);

            } elseif ($this->test == "kwaZuluNatalJobs/" || $this->test == "kwaZuluNatalJobs" || strpos($this->test, "kwaZuluNatalJobs") !== false) {
                
                $this->province_slug = "kwaZuluNatalJobs";
                $this->provinces_name = "KwaZulu-Natal";
                return array ($this->province_slug, $this->provinces_name);

            } elseif ($this->test == "limpopoJobs/" || $this->test == "limpopoJobs" || strpos($this->test, "limpopoJobs") !== false) {
                
                $this->province_slug = "limpopoJobs";
                $this->provinces_name = "Limpopo";
                return array ($this->province_slug, $this->provinces_name);

            } elseif ($this->test == "mpumalangaJobs/" || $this->test == "mpumalangaJobs" || strpos($this->test, "mpumalangaJobs") !== false) {
                
                
                $this->province_slug = "mpumalangaJobs";
                $this->provinces_name = "Mpumalanga";
                return array ($this->province_slug, $this->provinces_name);

            } elseif ($this->test == "northWestJobs/" || $this->test == "northWestJobs" || strpos($this->test, "northWestJobs") !== false) {
                
                $this->province_slug = "northWestJobs";
                $this->provinces_name = "North West";
                return array ($this->province_slug, $this->provinces_name);

            } elseif ($this->test == "northernCapeJobs/" || $this->test == "northernCapeJobs" || strpos($this->test, "northernCapeJobs") !== false) {
                
                $this->province_slug = "northernCapeJobs";
                $this->provinces_name = "Northern Cape";
                return array ($this->province_slug, $this->provinces_name);

            } elseif ($this->test == "westernCapeJobs/" || $this->test == "westernCapeJobs" || strpos($this->test, "westernCapeJobs") !== false) {
                
                $this->province_slug = "westernCapeJobs";
                $this->provinces_name = "Western Cape";
                return array ($this->province_slug, $this->provinces_name);
                
            } else {
                
                $slug_parameter = explode("/", $this->test); 
                $this->province_slug =  $slug_parameter[0];
            }
        }
    }
}

//Create url slug
function createSlug($slug)
{
    $lettersNumbersSpacesHyphens = '/[^\-\s\pN\pL]+/u';
    $duplicateHyphensAndSpaces = '/[\-\s]+/';
    $slug = preg_replace($lettersNumbersSpacesHyphens, '', mb_strtolower($slug, 'UTF-8'));
    $slug = preg_replace($duplicateHyphensAndSpaces, '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

//Word count
function limit_words($string, $word_limit)
{
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}

//Convert date
class Convert
{
    public $nge = '';
    public $ka = '';
    public function convertDayDate($day)
    {
        $this->nge = date('j', strtotime($day));
        return $this->nge;
    }
    public function convertMonthYear($year) 
    {
        $this->ka = date('F Y', strtotime($year));
        return $this->ka;
    }
}

//Implode array
function createString($x)
{
    $count = count($x);
    for($i = 0; $i < $count; $i++) {
        $test[] = "'" . $x[$i] . "'";
    }
    $test = implode(", ", $test);
    return $test;
}

?>