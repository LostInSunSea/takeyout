<?php
    ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);  // 7 day cookie lifetime
    session_start();

    $dbHost = 'localhost';
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['id']))
    {
        $id = $_POST['id'];
    }
    if (isset($_POST['formattedName']))
    {
        $name = $_POST['formattedName'];
    }
    if (isset($_POST['headline']))
    {
        $headline = $_POST['headline'];
    }
    if (isset($_POST['pictureUrl']))
    {
        $picThumbnail = $_POST['pictureUrl'];
    }
    if (isset($_POST['pictureUrls']))
    {
        $urls = $_POST['pictureUrls'];
        $values = $urls['values'];
        $picFull = $values[0];
    }
    if (isset($_POST['industry']))
    {
        $industry = $_POST['industry'];
    }
    if (isset($_POST['positions']))
    {
        $positions = $_POST['positions'];
        if ($positions['_total'] > 0)
        {
            $values = $positions['values'];
            $curPosition = $values[0];
            $lastJobtitle = $curPosition['title'];
            $lastJobSummary = $curPosition['summary'];
            $company = $curPosition['company'];
            $lastCompany = $company['name'];
            $startDate = $curPosition['startDate'];
            $month = $startDate['month'];
            $year = $startDate['year'];
        }
    }
    if (isset($_POST['summary']))
    {
        $summary = $_POST['summary'];
    }
    $sql = "SELECT * FROM user WHERE id = '$id'";
    if ($result=mysqli_query($conn,$sql))
    {
        //If the user already exists, go to homepage
        if (mysqli_num_rows($result))
        {
            $_SESSION["name"] = $name;
            $_SESSION["id"] = $id;
            $_SESSION["picUrl"] = $picture;
            echo "connect";
        }
        else
        {
            $sql = "INSERT INTO user (id, name, headline, industry, city, country, picThumbnail, picFull, lastJobTitle, lastCompany, lastJobStartDate, lastJobSummary, summary)
            VALUES ('$id', '$name', '$headline', '$industry', NULL, NULL, '$picThumbnail', '$picFull', '$lastJobtitle', '$lastCompany',  STR_TO_DATE('$year-$month', '%Y-%m'), '$lastJobSummary', '$summary')";
            if ($conn->query($sql) === TRUE)
            {
                $_SESSION["name"] = $name;
                $_SESSION["id"] = $id;
                $_SESSION["picUrl"] = $picture;
                echo "setup";
            } else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();

?>