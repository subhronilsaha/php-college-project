<?php

include('extra/connection.php');

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
                <li><a href="login_do.php?logout=true">Logout</a></li>
            </ul>
        </div>
    </div>
        <div class="content">
            <div class="left-side"></div>
            <div class="middle"> 
                <!-- <h1>MODULES AVAILABLE</h1>  -->
                <h1 class="cyan">Categories</h1>
                <br>
                <div>
                    <ul>
                        <li><a href="user_modules/get_users.php">All food items </a></li>
                        <li><a href="course_modules/get_courses.php">Category </a></li>
                    </ul>
                </table>
                </div>
            </div>
            <div class="right-side"></div>
        </div>
    </div>
</body>
</html>