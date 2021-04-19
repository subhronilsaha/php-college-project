<?php
    $con = mysqli_connect('localhost', 'root', '', 'demo1');
    @session_start(); // Start session for user

    // FETCH Category DATA
    $query1 = "select * from categories where status='active'";
    $result1 = mysqli_query($con, $query1);

    if(isset($_REQUEST['cid'])) {
        $query = "SELECT * FROM foodItems WHERE c_id = '" . $_REQUEST['cid'] . "'";
        $result = mysqli_query($con, $query);
    } else {
        $query = "SELECT * FROM foodItems";
        $result = mysqli_query($con, $query);
    }

    if (isset($_POST['done'])) {
        $dest = "location: index.php?cid=" . $_POST['categories'];
        echo $dest;
        header($dest);
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Day 1 Assignment | Software Engineering </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600&display=swap" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class = "header-container">
        <div class="header">
            <div class="name-details">
                <h1>Food Website</h1>
            </div>
            <ul class="navbar">
                <li><a href="login.php"> Login</a></li>
            </ul>
        </div>
    </div>
        <div class="content">
            
            <div class="left-side">
                
                <h3>Select Category</h3>

                <form method="post" action="">
                    <select name="categories" id="categories">
                        <?php 
                        // echo $_REQUEST['cid'];
                        while($fetch1 = mysqli_fetch_object($result1)) { 
                        ?>
                            <option 
                            value="<?php echo $fetch1->c_id; ?>"
                            selected="<?php echo ($_REQUEST['cid'] == $fetch1->c_id); ?>"
                            >
                                <?php echo $fetch1->c_name; ?>
                            </option>
                        <?php 
                        }
                        ?>
                    </select>

                    <br>

                    <input type="submit" name="done" value="DONE">

                </form>

            </div>

            <div class="middle"> 
                <h1>Available food items</h1> 

                <br>
                
                <table>
                    <tr>
                        <td> <b> Food ID  </b> </td>
                        <td> <b> Photo        </b> </td>
                        <td> <b> Name         </b> </td>
                        <td> <b> Category   </b> </td>
                    </tr>
                    <?php while($fetch = mysqli_fetch_object($result)) { ?>
                    <tr>
                        <td> <?php echo $fetch->f_id; ?> </td>
                        <td> 
                            <img 
                            src="admin-panel/user_modules/user_images/<?php echo $fetch->f_image_name; ?>" 
                            width=50 
                            height=50>
                        </td>
                        <td> <?php echo $fetch->f_name; ?> </td>
                        <?php 
                            $query1 = "select c_name from categories where c_id = '" . $fetch->c_id . "'";
                            $result1 = mysqli_query($con, $query1);
                            $fetch1 = mysqli_fetch_object($result1);
                        ?>
                        <td> <?php echo $fetch1->c_name; ?> </td>
                    </tr>
                    <?php } ?>
                </table>

            </div>

            <div class="right-side"></div>

        </div>
    </div>
</body>
</html>