<?php
    include('../extra/connection_h.php');

	$query = "SELECT * FROM foodItems WHERE f_id = '" . $_REQUEST['id'] . "'";
    $result = mysqli_query($con, $query);
    $fetch = mysqli_fetch_object($result);

    $query1 = "select * from categories where status='active'";
    $result1 = mysqli_query($con, $query1);

    // if(isset($_POST['update'])) {
    //     $query = "update foodItems set f_name='" . $_POST['name'] . "', c_id='" . $_POST['categories'] . "' where f_id ='" . $_REQUEST['id'] . "'";
    //     mysqli_query($con, $query);
    //     header("location: get_users.php");
    // }

    // CHECK FOR ADD USER BUTTON CLICK
    if(isset($_POST['update'])) {
        
        // echo "<PRE>" . print_r ($_FILES, true) . "</PRE>";

        // FILE UPLOAD
        $fileName = $_FILES['upFile']['name'];
        $target_dir = "user_images/";
        
        //echo $fileName . " " . $target_dir;

        if($fileName != '') {
            
            $target_file = $target_dir.basename($_FILES['upFile']['name']);
            
            // Extension
            $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            // Valid file extensions
            $extensionsArr = array("jpg", "jpeg", "png", "gif");

            //echo $fileName;

            if(in_array($extension, $extensionsArr)) {
                
                // Convert to base64
                $image_base64 = base64_encode(file_get_contents($_FILES['upFile']['tmp_name']));

                $image = "data::image/" . $extension . ";base64," . $image_base64;

                //echo $image . " " . $image_base64;
                $val = explode('.', $_FILES['upFile']['name']);
                $upload_ext = end($val);
                $ran = md5(time().rand());
                $file = $ran . '.' . $upload_ext;

                // Store image to upload folder
                if(move_uploaded_file($_FILES['upFile']['tmp_name'], $target_file)) {

                    // echo "inserting record";
                    // echo $_POST['name'];
                    // echo $_POST['categories'];
                    // echo $image; 
                    // echo $fileName;
                    // Insert record
                    // $query = "update foodItems set f_name='" . $_POST['name'] . "', c_id='" . $_POST['categories'] . "' where f_id ='" . $_REQUEST['id'] . "'";
                    $query = "update foodItems set 
                                f_name='" . $_POST['name'] .
                             "', c_id='" . $_POST['categories'] . 
                             "', f_image='" . $image . 
                             "', f_image_name='" . $fileName . 
                             "' where f_id ='" . $_REQUEST['id'] . "'";
                    // echo $query;
                    mysqli_query($con, $query);

                    // echo "inserted";
                } else {

                }
            }
        } 
        else {

            // Insert record
            //echo "No file name";

            $query = "update foodItems set 
                        f_name='" . $_POST['name'] .
                         "', c_id='" . $_POST['categories'] .  
                         "' where f_id ='" . $_REQUEST['id'] . "'";
            mysqli_query($con, $query);
        }

        header("location: get_users.php");
    }
    
	include('../extra/meta.php');
    include('../extra/header_user.php');
?>

<div class="content">
    <div class="left-side"></div>
    <div class="middle"> 
        <h2> Edit Food Item Details</h2>
        <br>
        <form method="post" action="" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" value="<?php echo $fetch->f_name; ?>"></td>
                </tr>
                <tr>
                    <td>Select Category</td>
                    <td>
                        <select name="categories" id="categories">
                            <?php while($fetch1 = mysqli_fetch_object($result1)) { ?>
                                <option 
                                    value="<?php echo $fetch1->c_id; ?>" 
                                    <?php if($fetch1->c_id == $fetch->c_id) { ?>
                                    selected = "selected"
                                    <?php } ?>
                                >
                                    <?php echo $fetch1->c_name; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Picture</td>
                    <td><input type="file" name="upFile" id="upFile"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="update" value="UPDATE"></td>
                </tr>
            </table>
    </form>
    </div>
    <div class="right-side"></div>
</div>
        
<?php
    // include('../extra/footer.php');
?>