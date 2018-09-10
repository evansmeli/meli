
<link rel="stylesheet" href="resources/css/bootstrap.min.css">
<script src="resources/js/bootstrap.min.js"></script>
 <script src="/resources/js/jquery.min.js"></script>
<?php

// Checking for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From getRegCandidates.php
    $id = $_GET['id'];
    
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
    $id = $_POST['id'];
    
} else { // No valid ID, kill the script.
    echo '<p class="error">This page has been accessed in error.</p>';
    exit();
}

//include('resources.html');

require_once('dbconn.php');

if (isset($_POST['delete'])) {

    if ($_POST['sure'] == 'yes') {//Delete candidate

        //Query to delete the candidate
        $query = "DELETE FROM  realestate WHERE id=$id LIMIT 1";
        $result = @mysqli_query($conn, $query);

        if (mysqli_affected_rows($conn) == 1) {
            echo "The data  has  been deleted!";
        }
        else {
            echo "ERROR: The data  has not been deleted!:";
            echo '<p>' . mysqli_error($conn) . '<br />Query: ' . $query . '</p>';
        }

    }
    else {
        echo "The data  has not been deleted!";
    }


}
else {

    //Get Candidates Details
    $q = "SELECT * FROM realestate WHERE id=$id";
    $r = @mysqli_query($conn, $q);

    if (mysqli_num_rows($r) == 1) {
        $row = mysqli_fetch_array($r, MYSQLI_NUM);

        //Create Form to delete candidate
        echo '
        <form action="delete.php" method="POST">
            <div class="form-group">
                <label class="control-label">Do you  really want to delete this record ?</label>
                <div>
                    <input type="radio" name="sure" value="yes" class="form-control">Yes
                    <input type="radio" name="sure" value="no" class="form-control">No
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" name="delete  data" class="btn btn-primary">Submit</button>
                    <input type="hidden" name="id" value="' . $id . '" />
                </div>
            </div>
        </form>
        
        
        ';
    }
    else {
        echo "Page Accessed In error";
    }

}



?>