<?php
    include('../extra/connection_h.php');

	$query = "SELECT * FROM categories WHERE c_id = '" . $_REQUEST['id'] . "'";
    $result = mysqli_query($con, $query);
    $fetch = mysqli_fetch_object($result);

    if(isset($_POST['update_category'])) {
        $query = "update categories set c_name='" . $_POST['c_name'] . "' where c_id = '" .$_REQUEST['id'] . "'";
        mysqli_query($con, $query);
        header("location: get_category.php");
    }
    
	include('../extra/meta.php');
    include('../extra/header_category.php');
?>

<div class="content">
    <div class="left-side"><h1></h1></div>
    <div class="middle"> 
        <h2> Edit Category </h2>
        <br>
        <form method="post" action="">
            <table>
                <tr>
                    <td>Category Name</td>
                    <td><input type="text" name="c_name" value="<?php echo $fetch->c_name; ?>"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="update_category" value="UPDATE"></td>

                </tr>
            </table>
    </form>
    </div>
    <div class="right-side"><h1></h1></div>
</div>
        
<?php
    // include('../extra/footer.php');
?>