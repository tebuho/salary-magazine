<?php
require('Imibuzo.php');
class Tests extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Umbuzo');
        $this->userModel = $this->model('Umntu');

        if (isset($_POST['id_yomntu']) && isset($_POST['id_yombuzo']) && isset($_POST['impendulo'])) {
            $data = [
                'id_yomntu' => $_POST['id_yomntu'],
                'id_yombuzo' => $_POST['id_yombuzo'],
                'impendulo' => $_POST['impendulo']
            ];
            $this->postModel->phendulaUmbuzo($data)
        }
    }
    function index()
    {
        // $classImibuzo = new Imibuzo();
        // $name = $classImibuzo->edit($id);
        
    }
}
// $classB = new Tests();
// $classB->index($id);

?>