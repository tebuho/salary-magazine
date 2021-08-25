<?php

class Imithandazo extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Umthandazo');
        $this->userModel = $this->model('Umntu');
    }

    public function index()
    {
        //Get imisebenzi
        $imithandazo = $this->postModel->getImithandazo();
        $data = [
            'h1' => 'Wubhale apha umthandazo wakho',
            'heading_yomthandazo' => 'Umthandazo wakho ngowantoni?',
            'imithandazo' => $imithandazo
        ];
        $this->view('imithandazo/index', $data);
    }

    public function thandaza()
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ngowantoni' => trim($_POST['ngowantoni']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'umthandazo' => trim($_POST['umthandazo']),
                'ngowantoni_err' => '',
                'umthandazo_err' => '',
            ];

            //Validate data
            if (empty($data['ngowantoni'])) {
                $data['ngowantoni_err'] = 'Umthandazo wakho ngowantoni?';
            }
            if (empty($data['umthandazo'])) {
                $data['umthandazo_err'] = 'Uthini umthandazo wakho?';
            }

            //Make sure there no errors
            if (empty($data['ngowantoni_err']) && empty($data['umthandazo_err'])) {
                //Validated
                if ($this->postModel->fakaUmthandazo($data)) {
                    flash('message_yomthandazo', 'Umthandazo wakho ungenile');
                    redirect('imithandazo');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('imithandazo/thandaza', $data);
                }
        } else {
            //Add umthandazo
            $data = [
                'ngowantoni' => '',
                'umthandazo' => ''
            ];
            $this->view('imithandazo/thandaza', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'ngowantoni' => trim($_POST['ngowantoni']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'umthandazo' => $_POST['umthandazo'],
                'updated_at' => date('Y-m-d'),
                'ngowantoni_err' => '',
                'umthandazo_err' => ''
            ];

            //Validate data
            if (empty($data['ngowantoni'])) {
                $data['ngowantoni_err'] = 'Kufuneka uchaze umthandazo wakho ngowantoni.';
            }
            if ($data['umthandazo'] == 'Khetha') {
                $data['umthandazo_err'] = 'Kufuneka uthandaze.';
            }

            //Make sure there no errors
            if (empty($data['ngowantoni_err']) && empty($data['umthandazo_err'])) {
                //Validated
                if ($this->postModel->updateUmthandazo($data)) {
                    flash('message_yomthandazo', 'Umthandazo wakho has been updated');
                    redirect('imithandazo/');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('imithandazo/edit', $data);
                }
        } else {
            $umthandazo = $this->postModel->getUmthandazoById($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($umthandazo->id_yomntu != $_SESSION['id_yomntu']) {
                redirect("imithandazo/");
            }

            //Update umthandazo
            $data = [
                'id' => $id,
                'ngowantoni' => $umthandazo->ngowantoni,
                'umthandazo' => $umthandazo->umthandazo,
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $this->view('imithandazo/edit', $data);
        }
    }
        
    public function umthandazo($id) {
        $umthandazo = $this->postModel->getUmthandazoById($id);
        $user = $this->userModel->getUserById($umthandazo->id_yomntu);
        $data = [
            'umthandazo' => $umthandazo,
            'umntu' => $user
        ];
        $this->view('imithandazo/umthandazo', $data);
    }

    /**
     * Delete job
     * 
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get existing job from model
            $umthandazo = $this->postModel->getUmthandazoById($id);

            //Check for owner
            if ($umthandazo->id_yomntu != $_SESSION['id_yomntu']) {
                redirect('imithandazo/');
            }
            if ($this->postModel->deleteUmthandazo($id)) {
                flash('message_yomthandazo', 'Umthandazo wakho has been deleted');
                redirect('imithandazo/');
            } else {
                die('Ikhono into erongo eyenzekileyo');
            }
        } else {
            redirect('imithandazo/');
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
                if ($this->postModel->phendulaUmthandazo($data)) {
                    flash('message_yempendulo', 'Impendulo yakho ingenile');
                    redirect('imithandazo/');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('imithandazo/', $data);
                }
        } else {
            $imithandazo = $this->postModel->getUmthandazoById($id);
            $comment = $this->postModel->getImpenduloById($id);

            if (!empty($comment)) {
                $data = [
                    'id' => $id,
                    'data' => $imithandazo,
                    'id_yomntu' => $imithandazo->userId,
                    'igama' => $imithandazo->igama,
                    'igama_lomphenduli' => $comment[0]->igama,
                    'comment_date' => $comment[0]->date,
                    'umthandazo' => $imithandazo->umthandazo,
                    'date' => $imithandazo->thandazwe_nini,
                    'impendulo' => $comment[0]->impendulo,
                    'comments' => $comment
                ];
            } else {
                $data = [
                    'id' => $id,
                    'data' => $imithandazo,
                    'id_yomntu' => $imithandazo->userId,
                    'igama' => $imithandazo->igama,
                    'umthandazo' => $imithandazo->umthandazo,
                    'date' => $imithandazo->thandazwe_nini,
                    'comments' => $comment
                ];
            }
            $this->view('imithandazo/phendula', $data);
        }
    }  
}