<?php
    ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);  // 7 day cookie lifetime
    session_start();
    $result = htmlspecialchars($_POST['result']);
    $decoded = json_decode($result, true);

    $dbHost = 'localhost';
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($decoded['id']))
    {
        $id = $decoded['id'];
    }
    if (isset($decoded['formattedName']))
    {
        $name = $decoded['formattedName'];
    }
    if (isset($decoded['headline']))
    {
        $headline = $decoded['headline'];
    }
    if (isset($decoded['pictureUrl']))
    {
        $picThumbnail = $decoded['pictureUrl'];
    }
    if (isset($decoded['pictureUrls']))
    {
        $urls = $decoded['pictureUrls'];
        $values = $urls['values'];
        $picFull = $values[0];
    }
    if (isset($decoded['industry']))
    {
        $industry = $decoded['industry'];
    }
    if (isset($decoded['positions']))
    {
        $positions = $decoded['positions'];
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
    if (isset($decoded['summary']))
    {
        $summary = $decoded['summary'];
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
            echo "User found, redirecting to connect";
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
                echo "New user, creating new entry in db and redirecting to setup";
            } else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();

?>