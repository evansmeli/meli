<?php



// Checking for a valid user ID, through GET or POST:
    if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // adminview.php
        $id = $_GET['id'];
        
    } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
        $id = $_POST['id'];
        
    } else { // without valid id, kill the script.
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }
require_once('dbconn.php');
if (isset($_POST['edit'])) {
    $error = array();
    if (empty($error)) {
        //Test for unique id number
        $q = "SELECT * FROM realestate WHERE id = '12'";
        $r = @mysqli_query($conn, $q);
        if (mysqli_num_rows($r) == 1) {

            $query = "UPDATE realestate SET = WHERE id=$id LIMIT 1";
            $results = @mysqli_query($conn, $query);
            if (mysqli_affected_rows($conn) == 1) {
                echo "<p>Sucessful edited!</p>";
            }
            else {
                echo "<p>could not  edited !</p>";
                echo mysqli_error($conn);
            }
            

        }

    }
    else {
        echo "<P>The following errors were found!</P>";
        foreach($error as $er) {
            echo "- $er <br />\n";
        }
        echo "<P>Please try again!</P>";
    }

}

$post_query = "SELECT * FROM realestate";
$post_results = @mysqli_query($conn, $post_query);

$qry = "SELECT * FROM realestate WHERE id=$id";
$rlts = @mysqli_query($conn, $qry);

if(mysqli_num_rows($rlts) == 1) {

    //Get the candidates information
    $row = mysqli_fetch_array($rlts, MYSQLI_NUM);

    $post_id = $row[2];

    $qry1 = "SELECT category_name FROM vote_category WHERE category_id=$post_id";
    $rts = @mysqli_query($conn, $qry1);

    if(@mysqli_num_rows($rts) == 1) {
        $rot = mysqli_fetch_array($rts, MYSQLI_NUM);
        $current_post = $rot[0];
    }

    echo'
    <form action="update.php" method="POST" role="form">
        <div class="form-group">
            <label class="control-lable col-sm-2">Property name:</label>
            <div class="col-md-3">
                <input type="text" name="id" class="form-control" value="'. $row[1] .'">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="edit">Edit </button>
                <input type="hidden" name="id" value="' . $id . '" />
            </div>
        </div>
    </form>
    
    ';

}
mysqli_close($conn);


?>
