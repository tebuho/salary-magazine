<?php
//Insert comment
include_once 'updates.php';

echo "Test";
// Update umbuzo
if (isset($_POST['testimonial']) && isset($_POST['testimonial_id'])) {
    $testimonial = mysqli_real_escape_string($conn, $_POST['testimonial']);
    $testimonial_id = mysqli_real_escape_string($conn, $_POST['testimonial_id']);
    $sql = "UPDATE testimonials SET testimonial = '$testimonial' WHERE id = '$testimonial_id'";
    $result = mysqli_query($conn, $sql);
}
?>