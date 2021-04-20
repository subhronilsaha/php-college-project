<?php
    include('../extra/connection_h.php');

	$query = "SELECT * FROM categories";
    $result = mysqli_query($con, $query);
    
    if(isset($_REQUEST['del'])) {
        $query = "delete from categories where c_id = '" . $_REQUEST['del'] . "'";
        mysqli_query($con, $query);
        header("location: get_courses.php");
    }

    if(isset($_REQUEST['status'])) {
        $query = "update categories set status = '" . $_REQUEST['status'] . "' where c_id = '" . $_REQUEST['id'] . "'";
        mysqli_query($con, $query);
        header("location: get_courses.php");
    }

	include('../extra/meta.php');
    include('../extra/header_course.php');
?>

<div class="content">
    <div class="left-side"><h1></h1></div>
	<div class="middle"> 
        <h2> All Categories </h2>
        <br>
    	<table>
    		<tr>
    			<td> <b> Categories ID </b> </td>
    			<td> <b> Categories Name </b> </td>
                <td> <b> Status </b> </td>
                <td> <b> Action </b> </td>
    		</tr>
    		<?php while($fetch = mysqli_fetch_object($result)) { ?>
    		<tr>
    			<td> <?php echo $fetch->c_id; ?> </td>
    			<td> <?php echo $fetch->c_name; ?> </td>
                <td> 
                    <?php 
                    if ($fetch->status == 'active') {
                    ?>
                        <a href="?status=inactive&id=<?php echo $fetch->c_id; ?>" class="green">Active</a>
                    <?php 
                    } 
                    else {
                    ?>
                        <a href="?status=active&id=<?php echo $fetch->c_id; ?>" class="red">Inactive</a>
                    <?php
                    }
                    ?> 
                </td>
                <td><a href="edit_course.php?id=<?php echo $fetch->c_id; ?>">Edit</a></td>
                <td><a href="get_courses.php?del=<?php echo $fetch->c_id; ?>">Delete</a></td>
    		</tr>
    		<?php } ?>
    	</table>
    </div>
    <div class="right-side"><h1></h1></div>
</div>
        
<?php
    // include('../extra/footer.php');
?>