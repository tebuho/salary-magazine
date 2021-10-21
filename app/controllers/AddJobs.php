<?php
/**
 * Receives data from the view
 * Processes it and sends it to the model
 */
/**
 * Receives data from the view
 * Processes it and sends it to the model
 * 
 * @property array $data 
 */
class addJobs extends Controller
{
    public $data = [];
    /**
     * Checks if user is admin
     * If user is not admin, redirects user
     * Also connects to the add jobs and users model
     */
    public function __construct()
    {
        if (!isset($_SESSION["user_id"])) {
            redirect("abantu/login");
        }
        if (isset($_SESSION["role"])
            && $_SESSION["role"] !== "Admin"
        ) {
            redirect("");
        }
        $this->postModel = $this->model("addJob");
        $this->userModel = $this->model("Umntu");
    }

    /**
     * For Admins to add a new job
     *
     * @return void
     */
    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->data = Sanitize_data($this->data);
            $this->data = Validate_Form_input($this->data);
            $this->data = Create_slugs($this->data);
            $this->data = Show_Job_exists($this->data);
            $this->data = Error_exists($this->data);
            Insert_New_job($this->data);
        } else {
            $this->data = Init_Form_data($this->data);
            $this->view("addJobs/add", $this->data);
        }
    }
}
?>
