<?php

class CoverLetters extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('CoverLetter');
        $this->userModel = $this->model('Umntu');
    }

    public function index()
    {
        //Get cover_letters
        $cover_letters = $this->postModel->getCoverLetters();
        $data = [
            'page_image' => URLROOT . '/img/cover_letters/' . $cover_letters[0]->image,
            'page_description' => 'Cover letters zifumaneka apha',
            'page_type' => 'article',
            'page_url' => URLROOT . "/" . $_GET['url'],
            'page_title' => 'Cover Letters Zabantu',
            'cover_letter' => $cover_letters
        ];
        $this->view('coverLetters/index', $data);
    }

    public function bhala()
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ngeyantoni' => trim($_POST['ngeyantoni']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'cover_letter' => nl2br($_POST['cover_letter']),
                'ngeyantoni_err' => '',
                'cover_letter_err' => '',
            ];

            //Validate data
            if (empty($data['ngeyantoni'])) {
                $data['ngeyantoni_err'] = 'Cover letter yakho ngeyantoni?';
            }
            if (empty($data['cover_letter'])) {
                $data['cover_letter_err'] = 'Bhala i-cover letter kaloku.';
            }

            //Make sure there no errors
            if (empty($data['ngeyantoni_err']) && empty($data['cover_letter_err'])) {
                //Validated
                if ($this->postModel->addCoverLetter($data)) {
                    flash('message_ye_cover_letter', 'Cover letter yakho ingenile');
                    redirect('cover_letters');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('cover_letters/bhala', $data);
                }
        } else {
            //Add cover letter
            $data = [
                'page_image' => '',
                'page_description' => 'Cover letter yakho ngeyantoni?',
                'page_type' => 'website',
                'page_url' => URLROOT . "/" . $_GET['url'],
                'page_title' => 'Cover letter yakho yibhale apha',
                'ngeyantoni' => '',
                'cover_letter' => ''
            ];
            $this->view('coverLetters/bhala', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'ngeyantoni' => trim($_POST['ngeyantoni']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'cover_letter' => nl2br($_POST['cover_letter']),
                'ilungiswe_nini' => date('Y-m-d'),
                'ngeyantoni_err' => '',
                'cover_letter_err' => ''
            ];

            //Validate data
            if (empty($data['ngeyantoni'])) {
                $data['ngeyantoni_err'] = 'Kufuneka uchaze cover letter yakho ngeyantoni.';
            }
            if ($data['cover_letter'] == 'Khetha') {
                $data['cover_letter_err'] = 'Bhala i-cover letter yakho kaloku.';
            }

            //Make sure there no errors
            if (empty($data['ngeyantoni_err']) && empty($data['cover_letter_err'])) {
                //Validated
                if ($this->postModel->updateCoverLetter($data)) {
                    flash('message_ye_cover_letter', 'Cover letter yakho has been updated');
                    redirect('cover_letters/');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('cover_letters/edit', $data);
                }
        } else {
            $cover_letter = $this->postModel->getCoverLetterById($id);

            //Check if ufakwe nguye lombuzo lomntu
            if ($cover_letter->id_yomntu != $_SESSION['id_yomntu']) {
                redirect("cover_letters/");
            }

            //Update cover letter
            $data = [
                'id' => $id,
                'ngeyantoni' => $cover_letter->ngeyantoni,
                'cover_letter' => $cover_letter->cover_letter,
                'ilungiswe_nini' => date("Y-m-d H:i:s")
            ];
            $this->view('cover_letters/edit', $data);
        }
    }
        
    public function coverLetter($id) {
        $cover_letter = $this->postModel->getCoverLetterById($id);
        $user = $this->userModel->getUserById($cover_letter->id_yomntu);
        
        $data = [
            'page_image' => '',
            'page_description' => strip_tags(substr($cover_letter->cover_letter, 0, 160)),
            'page_type' => 'article',
            'page_url' => URLROOT . "/" . $_GET['url'],
            'page_title' => $cover_letter->ngeyantoni,
            'cover_letter' => $cover_letter,
            'umntu' => $user
        ];
        $this->view('coverLetters/cover_letter', $data);
    }

    /**
     * Delete job
     * 
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get existing cover letter from model
            $cover_letter = $this->postModel->getCoverLetterById($id);

            //Check for owner
            if ($cover_letter->id_yomntu != $_SESSION['id_yomntu']) {
                redirect('cover_letters/');
            }
            if ($this->postModel->deleteCoverLetter($id)) {
                flash('message_ye_cover_letter', 'Cover letter yakho has been deleted');
                redirect('cover_letters/');
            } else {
                die('Ikhono into erongo eyenzekileyo');
            }
        } else {
            redirect('cover_letters/');
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

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
                if ($this->postModel->phendulaCoverLetter($data)) {
                    flash('message_yempendulo', 'Impendulo yakho ingenile');
                    redirect("coverLetters/phendula/$id");
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('coverLetters/', $data);
                }
        } else {
            $cover_letter = $this->postModel->getCoverLetterById($id);
            $comment = $this->postModel->getImpenduloById($id);

            //Update cover_letter
            if (!empty($comment)) {
                $data = [
                    'id' => $id,
                    'data' => $cover_letter,
                    'id_yomntu' => $cover_letter->userId,
                    'igama' => $cover_letter->igama,
                    'igama_lomphenduli' => $comment[0]->igama,
                    'comment_date' => $comment[0]->date,
                    'cover_letter' => $cover_letter->cover_letter,
                    'date' => $cover_letter->ibhalwe_nini,
                    'impendulo' => $comment[0]->impendulo,
                    'comments' => $comment
                ];
            }
            $data = [
                'page_image' => URLROOT . '/img/cover_letters/' . $cover_letters->image,
                'page_description' => $cover_letter->cover_letter,
                'page_type' => 'article',
                'page_url' => URLROOT . "/" . $_GET['url'],
                'page_title' => $cover_letter->title,
                'id' => $id,
                'data' => $cover_letter,
                'id_yomntu' => $cover_letter->userId,
                'igama' => $cover_letter->igama,
                'cover_letter' => $cover_letter->cover_letter,
                'date' => $cover_letter->ibhalwe_nini,
                'comments' => $comment
            ];
            $this->view('coverLetters/phendula', $data);
        }
    }  
}