<?php

class Imibuzo extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Umbuzo');
        $this->userModel = $this->model('Umntu');
    }


    /********************************************************************
     *                                                                  *
     *                  Get all questions and paginate                       *
     *                                                                  *
     ********************************************************************/
    public function index($page = 0)
    {
       
        include_once "../app/views/imibuzo/get_imibuzo.php";
        
        $this->view("imibuzo/index", $data);
        
    }

    public function buza()
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ungantoni' => trim($_POST['ungantoni']),
                'slug' => trim($_POST['ungantoni'] . "-" . time()),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'umbuzo' => trim($_POST['umbuzo']),
                'ungantoni_err' => '',
                'umbuzo_err' => '',
            ];
            $data['slug'] = explode(' ', $data['slug']);
            $data['slug'] = strtolower(implode('-', $data['slug']));

            //Validate data
            if (empty($data['ungantoni'])) {
                $data['ungantoni_err'] = 'Umbuzo wakho ungantoni?';
            }
            if (empty($data['umbuzo'])) {
                $data['umbuzo_err'] = 'Uthini umbuzo wakho?';
            }

            //Make sure there no errors
            if (empty($data['ungantoni_err']) && empty($data['umbuzo_err'])) {
                //Validated
                if ($this->postModel->fakaUmbuzo($data)) {
                    flash('message_yombuzo', 'Umbuzo wakho ungenile');
                    redirect('imibuzo');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('imibuzo/buza', $data);
                }
        } else {
            //Add umbuzo
            $data = [
                'page_image' => URLROOT . '/public/img/western-cape-jobs/westernCapeJobs.png',
                'page_description' => 'Umbuzo wakho ungantoni?',
                'page_type' => 'website',
                'page_url' => URLROOT . "/" . $_GET['url'],
                'page_title' => 'Wubhale apha umbuzo wakho',
                'ungantoni' => '',
                'umbuzo' => ''
            ];
            $this->view('imibuzo/buza', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'ungantoni' => trim($_POST['ungantoni']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'umbuzo' => $_POST['umbuzo'],
                'updated_at' => date('Y-m-d'),
                'ungantoni_err' => '',
                'umbuzo_err' => ''
            ];

            //Validate data
            if (empty($data['ungantoni'])) {
                $data['ungantoni_err'] = 'Kufuneka uchaze umbuzo wakho ungantoni.';
            }
            if ($data['umbuzo'] == 'Khetha') {
                $data['umbuzo_err'] = 'Kufuneka ubuze.';
            }

            //Make sure there no errors
            if (empty($data['ungantoni_err']) && empty($data['umbuzo_err'])) {
                //Validated
                if ($this->postModel->updateUmbuzo($data)) {
                    flash('message_yombuzo', 'Umbuzo wakho has been updated');
                    redirect('imibuzo/');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('imibuzo/edit', $data);
                }
        } else {
            $umbuzo = $this->postModel->getUmbuzoById($id);

            //Check if ufakwe nguye lombuzo lomntu
            if ($umbuzo->id_yomntu != $_SESSION['id_yomntu']) {
                redirect("imibuzo/");
            }

            //Update umbuzo
            $data = [
                'page_image' => URLROOT . '/public/img/western-cape-jobs/westernCapeJobs.png',
                'page_description' => 'Umbuzo wakho wulungise apha.',
                'page_type' => 'website',
                'page_url' => URLROOT . "/" . $_GET['url'],
                'page_title' => 'Edit Umbuzo Wakho',
                'id' => $id,
                'ungantoni' => $umbuzo->ungantoni,
                'umbuzo' => $umbuzo->umbuzo,
                'buzwe_nini' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $this->view('imibuzo/edit', $data);
        }
    }

    //Route for updating with ajax
    public function update()
    {
        $this->view('imibuzo/update');
    }
        
    public function umbuzo($id) {
        $umbuzo = $this->postModel->getUmbuzoById($id);
        $user = $this->userModel->getUserById($umbuzo->id_yomntu);
        $data = [
                'page_image' => URLROOT . '/public/img/western-cape-jobs/westernCapeJobs.png',
                'page_description' => 'Umbuzo',
                'page_type' => 'website',
                'page_url' => URLROOT . "/" . $_GET['url'],
                'page_title' => 'Umbuzo',
            'umbuzo' => $umbuzo,
            'umntu' => $user
        ];
        $this->view('imibuzo/umbuzo', $data);
    }

    /**
     * Delete job
     * 
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get existing job from model
            $umbuzo = $this->postModel->getUmbuzoById($id);

            //Check for owner
            if ($umbuzo->id_yomntu != $_SESSION['id_yomntu']) {
                redirect('imibuzo/');
            }
            if ($this->postModel->deleteUmbuzo($id)) {
                flash('message_yombuzo', 'Umbuzo wakho has been deleted');
                redirect('imibuzo/');
            } else {
                die('Ikhono into erongo eyenzekileyo');
            }
        } else {
            $data = [
                'page_image' => URLROOT . '/public/img/western-cape-jobs/westernCapeJobs.png',
                'page_description' => 'Delete Umbuzo wakho',
                'page_type' => 'website',
                'page_url' => URLROOT . "/" . $_GET['url'],
                'page_title' => 'Delete Umbuzo wakho',
                ];
            redirect('imibuzo/');
        }
    } 

    /**
     * Insert Comments
     *
     * @param [type] $id
     * @return void
     */
    public function phendula($id)
    {
        $imibuzo = $this->postModel->getUmbuzoById($id);
        $comment = $this->postModel->getImpenduloById($id);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $id = explode("-", $id);
            $id = end($id);
            $data = [
                'id' => $id,
                'impendulo' => trim($_POST['impendulo']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'date' => date('Y-m-d H:i:s'),
                'impendulo_err' => ''
            ];

            //Validate data
            if (empty($data['impendulo'])) {
                $data['impendulo_err'] = 'Kufuneka ubhale impendulo yakho.';
            }
    
            //Make sure there no errors
            if (empty($data['impendulo_err'])) {
                //Validated
                if ($this->postModel->phendulaUmbuzo($data)) {
                    
                    // Send notification email to the person who asked the question
                    $to = $imibuzo->email;
                    $subject = "Umbuzo Wakho unempendulo entsha ";
                    $message = "Hi " . $imibuzo->igama . ", umbuzo wakho \"" . $imibuzo->ungantoni . "\" kwi <a href='https://salarymagazine.co.za'>salarymagazine.co.za</a> unempendulo entsha. Ungayijonga le mpendulo<a href='". URLROOT . "/imibuzo/phendula/" . $imibuzo->umbuzoId . "'> ngokucofa apha</a>";
                    $headers = "From: Salary Magazine <info@salarymagazine.co.za> \r\n";
                    $headers .= "MIME-VERSION: 1.0" . "\r\n";
                    $headers .= "Content-type: text/html; charset:utf-8" . "\r\n";
                    $headers .= "Bcc: info@salarymagazine.co.za" . "\r\n";
                    mail($to, $subject, $message, $headers);
                    
                    flash('message_yombuzo', 'Impendulo yakho ingenile');
                    
                    //redirect to imibuzo
                    redirect('imibuzo/');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('imibuzo/', $data);
                }
        } else {
            // $imibuzo = $this->postModel->getUmbuzoById($id);
            
            if (!empty($comment)) {
                $data = [
                    'page_image' => URLROOT . '/public/img/western-cape-jobs/westernCapeJobs.png',
                    'page_description' => $imibuzo->umbuzo,
                    'page_type' => 'article',
                    'page_url' => URLROOT . "/" . $_GET['url'],
                    'page_title' => $imibuzo->igama . " " . $imibuzo->fani . ' - ' . $imibuzo->ungantoni,
                    'id' => $id,
                    'id_yombuzo' => $imibuzo->umbuzoId,
                    'data' => $imibuzo,
                    'id_yomntu' => $imibuzo->id_yomntu,
                    'igama' => ucwords($imibuzo->igama),
                    'fani' => $imibuzo->fani,
                    'initials' => strtoupper($imibuzo->initials),
                    'full_name' => '',
                    'igama_lomphenduli' => $comment[0]->igama,
                    'comment_date' => $comment[0]->date,
                    'umbuzo' => $imibuzo->umbuzo,
                    'ungantoni' => ucwords(strtolower($imibuzo->ungantoni)),
                    'date' => $imibuzo->buzwe_nini,
                    'impendulo' => $comment[0]->impendulo,
                    'comments' => $comment,
                    'username' => '',
                    'umbuzoId' => '',
                    'impendulo_err' => ''
                ];
                
                $data['fani'] = str_split($data['fani']);
                $data['fani'] = ucwords($data['fani'][0]);
                $data['full_name'] = $data['igama'] . ' ' . $data['fani'];
                $user = $this->userModel->getUserById($_SESSION['id_yomntu']);

                // User session username
                $data['username'] = $user->igama . ' ' . $user->fani;
                $data['umbuzoId'] = $data['data']->umbuzoId;
                
                $myJSON = [
                    [
                        'initials' => $user->initials,
                        'username' => $user->igama . ' ' . $user->fani
                    ]
                ];
                $myNewJSON = json_encode($myJSON);
                $fp = fopen("user-commenter.json", "w");
                fwrite($fp, $myNewJSON);
                fclose($fp);
            } else {
                $data = [
                    'page_image' => URLROOT . '/public/img/western-cape-jobs/westernCapeJobs.png',
                    'page_description' => 'Comment yombuzo yibhale apha',
                    'page_type' => 'website',
                    'page_url' => URLROOT . "/" . $_GET['url'],
                    'page_title' => 'Comments Zemibuzo',
                    'id' => $id,
                    'id_yombuzo' => $imibuzo->umbuzoId,
                    'data' => $imibuzo,
                    'id_yomntu' => $imibuzo->id_yomntu,
                    'igama' => ucwords($imibuzo->igama),
                    'fani' => $imibuzo->fani,
                    'initials' => strtoupper($imibuzo->initials),
                    'umbuzo' => $imibuzo->umbuzo,
                    'ungantoni' => ucwords($imibuzo->ungantoni),
                    'date' => $imibuzo->buzwe_nini,
                    'comments' => $comment,
                    'username' => '',
                ];
                
                $data['fani'] = str_split($data['fani']);
                $data['fani'] = ucfirst($data['fani'][0]);
                $data['full_name'] = $data['igama'] . ' ' . $data['fani'];
                $user = $this->userModel->getUserById($_SESSION['id_yomntu']);

                // User session username
                $data['username'] = $user->igama . ' ' . $user->fani;
                $data['umbuzoId'] = $data['data']->umbuzoId;
            }
            $this->view('imibuzo/phendula', $data);
        }
    }    
}