<?php

class Blogs extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Blog');
        $this->userModel = $this->model('Umntu');
    }

    public function index()
    {
        
        //Get blogs
        $blogs = $this->postModel->getBlogs();
        $data = [
            'page_image' => URLROOT . '/img/imisebenzi/' . $blogs[0]->image,
            'page_modified' => $blogs[0]->updated_at,
            'page_description' => '',
            'page_type' => 'website',
            'page_url' => URLROOT . "/" . $_GET['url'],
            'page_title' => 'Blogs Zabantu',
            'blogs' => $blogs
        ];
        
        $this->view('blogs/index', $data);
    }

    public function bhala()
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'page_title' => 'Bhala Apha',
                'title' => filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'body' => nl2br($_POST['body']),
                'image_name' => strip_tags(trim($_FILES['image']['name'])),
                'image_size' => trim($_FILES['image']['size']),
                'image_type' => trim($_FILES['image']['type']),
                'tmp_name' => trim($_FILES['image']['tmp_name']),
                'title_err' => '',
                'body_err' => '',
                'image_type_err' => '',
                'image_size_err' => '',
            ];

            //Set image directory
             $dir = '/home/salarfng/public_html/public/img/blogs';
             $data['image_name'] = md5($data['image_name']);
             
            //Validate image type
            if ($data['image_type'] != "image/jpg" || $data['image_type'] != "image/png") {
                $data['image_type_err'] = "Type ye image yakho kufuneka ibe yi jpg or png";
            }
            //Validate image size
            if ($data['image_size'] > 2000000) {
                $data['image_size_err'] = "Image yakho akufunekanga ibengaphezulu ko 2 MB";
            }
            //Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Title ye blog yakho';
            }
            if (empty($data['body'])) {
                $data['body_err'] = 'Body ye blog yakho?';
            }

            //Make sure there no errors
            if (empty($data['title_err']) && empty($data['body_err'])) {
                
                //Move uploaded image
                move_uploaded_file($data['tmp_name'], $dir . '/' . $data['image_name']);
                
                //Validated
                if ($this->postModel->addBlog($data)) {
                    flash('message_ye_blog', 'Blog yakho ingenile');
                    redirect('blogs');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('blogs/bhala', $data);
                }
        } else {
            //Add body
            $data = [
                'page_title' => 'Blog Yakho Yibhale Apha',
                'page_image' => "/home/salarfng/public_html/public/img/blogs/Blog-Yakho-Yibhale-Apha.png",
                'page_url' => URLROOT . $_SERVER['REQUEST_URI'],
                'title' => '',
                'body' => '',
                'image_name' => ''
            ];
            $this->view('blogs/bhala', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'body' => nl2br($_POST['body']),
                'updated_at' => date('Y-m-d'),
                'title_err' => '',
                'body_err' => ''
            ];

            //Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Kufuneka uchaze Blog title yakho.';
            }
            if ($data['body'] == 'Khetha') {
                $data['body_err'] = 'Kufuneka uthandaze.';
            }

            //Make sure there no errors
            if (empty($data['title_err']) && empty($data['body_err'])) {
                //Validated
                if ($this->postModel->updateBlog($data)) {
                    flash('message_ye_blog', 'Blog yakho has been updated');
                    redirect('blogs/');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('blogs/edit', $data);
                }
        } else {
            $body = $this->postModel->getBlogById($id);

            //Check if ifakwe nguye le blog lomntu
            if ($body->id_yomntu != $_SESSION['id_yomntu']) {
                redirect("blogs/");
            }

            //Update body
            $data = [
                'id' => $id,
                'title' => $body->title,
                'body' => $body->body,
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $this->view('blogs/edit', $data);
        }
    }
        
    public function blog($slug)
    {
            
        $blog = $this->postModel->getBlogById($slug);
        $user = $this->userModel->getUserById($blog->id_yomntu);
        $comment = $this->postModel->getImpenduloById($blog->id);
        $blog_description = implode(' ', array_slice(explode(' ', $blog->body), 0, 25)) . "...";
        $blog_description = explode('<p>', $blog->body);
        $blog_description = implode(' ', array_slice(explode(' ', $blog_description[1]), 0, 25)) . "...";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $blog->id,
                'impendulo' => trim($_POST['impendulo']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'date' => date('Y-m-d H:i:s'),
                'impendulo_err' => ''
            ];

            //Validate data
            if (empty($data['impendulo'])) {

                $data['impendulo_err'] = 'Comment kaloku.';

            }
            
            //Make sure there no errors
            if (empty($data['impendulo_err'])) {

                //If all is good insert into database
                if ($this->postModel->blogComment($data)) {

                    flash('message_ye_blog', 'Impendulo yakho ingenile');

                    redirect("blogs/blog/$slug");

                } else {

                    die('Ikhona into erongo');

                }

            } else {

                //Load the view with errors
                $data = [
                    'body' => $blog,
                    'umntu' => $user,
                    'page_image' => URLROOT . '/img/blogs/' . $blog->image,
                    'page_description' => $blog_description,
                    'page_type' => 'website',
                    'page_url' => URLROOT . "/" . $_GET['url'],
                    'page_title' => $blog->title,
                    'igama_lomphenduli' => "",
                    'comment_date' => "",
                    'title' => $blog->title,
                    'date' => $blog->pub_date,
                    'image' => $blog->image,
                    'impendulo' => "",
                    'comments' => $comment,
                    'impendulo_err' => "Comment kaloku"
                ];

                if (!empty($comment)) {

                    $data['igama_lomphenduli'] = $comment[0]->igama;
                    $data['comment_date'] = $comment[0]->date;
                    $data['impendulo'] = $comment[0]->impendulo;

                }

                error('comment_error', 'Comment yakho ayikwazi ukuba empty.');

                $this->view("blogs/blog", $data);
            }
        } else {

            if (!empty($comment)) {

                $data = [
                    'id' => $blog->id,
                    'body' => $blog,
                    'id_yomntu' => $blog->userId,
                    'igama' => $blog->igama,
                    'igama_lomphenduli' => $comment[0]->igama,
                    'comment_date' => $comment[0]->date,
                    'title' => $blog->title,
                    'date' => $blog->pub_date,
                    'image' => $blog->image,
                    'impendulo' => $comment[0]->impendulo,
                    'comments' => $comment,
                    'page_image' => URLROOT . '/img/blogs/' . $blog->image,
                    'page_description' => $blog_description,
                    'page_type' => 'website',
                    'page_url' => URLROOT . "/" . $_GET['url'],
                    'page_title' => $blog->title,
                ];

            } else {

                $data = [
                    'body' => $blog,
                    'umntu' => $user,
                    'page_image' => URLROOT . '/img/blogs/' . $blog->image,
                    'page_description' => $blog_description,
                    'page_type' => 'website',
                    'page_url' => URLROOT . "/" . $_GET['url'],
                    'page_title' => $blog->title,
                    'impendulo_err' => ''
                ];
            }
        }
        $this->view('blogs/blog', $data);
    }

    /**
     * Delete job
     * 
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get existing job from model
            $blog = $this->postModel->getBlogById($id);

            //Check for owner
            if ($blog->id_yomntu != $_SESSION['id_yomntu']) {
                redirect('blogs/');
            }
            if ($this->postModel->deleteBlog($id)) {
                flash('message_ye_blog', 'Blog yakho has been deleted');
                redirect('blogs/');
            } else {
                die('Ikhono into erongo eyenzekileyo');
            }
        } else {
            redirect('blogs/');
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
                if ($this->postModel->blogComment($data)) {
                    flash('message_yempendulo', 'Impendulo yakho ingenile');
                    redirect("blogs/phendula/$id");
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('blogs/', $data);
                }
        } else {
            $blogs = $this->postModel->getBlogById($id);
            $comment = $this->postModel->getImpenduloById($id);

            if (!empty($comment)) {
                $data = [
                    'id' => $id,
                    'data' => $blogs,
                    'id_yomntu' => $blogs->userId,
                    'igama' => $blogs->igama,
                    'igama_lomphenduli' => $comment[0]->igama,
                    'comment_date' => $comment[0]->date,
                    'title' => $blogs->title,
                    'body' => $blogs->body,
                    'date' => $blogs->pub_date,
                    'image' => $blogs->image,
                    'impendulo' => $comment[0]->impendulo,
                    'comments' => $comment
                ];
            } else {
                $data = [
                    'page_image' => URLROOT . '/img/blogs/' . $blogs->image,
                    'page_description' => strip_tags(substr($blogs->body, 0, 160)),
                    'page_type' => 'article',
                    'page_url' => URLROOT . "/" . $_GET['url'],
                    'page_title' => $blogs->title,
                    'id' => $id,
                    'data' => $blogs,
                    'id_yomntu' => $blogs->userId,
                    'igama' => $blogs->igama,
                    'title' => $blogs->title,
                    'body' => $blogs->body,
                    'date' => $blogs->pub_date,
                    'image' => $blogs->image,
                    'comments' => $comment
                ];
            }
            $this->view('blogs/phendula', $data);
        }
    }

    /**
     * Search query
     */

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Get imisebenzi
            $search = $_GET['search'];
            $search = "%$search%";
            $data = [
                'search' =>  $search
            ];

            $blogs = $this->postModel->searchBlogs($data);
            $data = [
                'blogs' => $blogs
            ];
            $this->view('blogs/search', $data);
        }
    }  
}