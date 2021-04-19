<?php
    include('../extra/connection_h.php');

	$query = "SELECT * FROM course WHERE c_id = '" . $_REQUEST['id'] . "'";
    $result = mysqli_query($con, $query);
    $fetch = mysqli_fetch_object($result);

    if(isset($_POST['update_course'])) {
        $query = "update course set c_name='" . $_POST['c_name'] . "'";
        mysqli_query($con, $query);
        header("location: get_courses.php");
    }
    
	include('../extra/meta.php');
    include('../extra/header_course.php');
?>

<div class="content">
    <div class="left-side"><h1>LEFT SIDE</h1></div>
    <div class="middle"> 
        <h2> Edit Course </h2>
        <br>
        <form method="post" action="">
            <table>
                <tr>
                    <td>Course Name</td>
                    <td><input type="text" name="c_name" value="<?php echo $fetch->c_name; ?>"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="update_course" value="UPDATE"></td>

                </tr>
            </table>
    </form>
    </div>
    <div class="right-side"><h1>RIGHT SIDE</h1></div>
</div>
        
<?php
    // include('../extra/footer.php');
?>