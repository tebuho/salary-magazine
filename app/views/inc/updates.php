<?php
class Tests extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Umbuzo');
        $this->userModel = $this->model('Umntu');

        if (isset($_POST['user_id']) && isset($_POST['id_yombuzo']) && isset($_POST['impendulo'])) {
            $data = [
                'user_id' => $_POST['user_id'],
                'id_yombuzo' => $_POST['id_yombuzo'],
                'impendulo' => $_POST['impendulo']
            ];
            $this->postModel->phendulaUmbuzo($data);
        }
    }
}
$test = new Tests;
?>