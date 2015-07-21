<?php
    ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);  // 7 day cookie lifetime
    session_start();
    $name = htmlspecialchars($_POST['Name']);
    $job = htmlspecialchars($_POST['Job']);
    $id = htmlspecialchars($_POST['ID']);
    $location = htmlspecialchars($_POST['Location']);
    $picture = htmlspecialchars($_POST['Picture']);
    $industry = htmlspecialchars($_POST['Industry']);

    $_SESSION["Name"] = $name;
    $_SESSION["ID"] = $id;
    $_SESSION["PicURL"] = $picture;

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "yourpasswordhere";
    $dbDatabase = "test";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM User WHERE id = '$id'";
    if ($result=mysqli_query($conn,$sql))
    {
        if (mysqli_num_rows($result))
        {
            header( 'Location: ./chatwindow.html' );
        }
        else
        {
            $sql = "INSERT INTO User (id, job, name, location, pictureurl, industry)
        VALUES ('$id', '$job', '$name', '$location', '$picture', '$industry')";

            if ($conn->query($sql) === TRUE)
            {
                header( 'Location: ./chatwindow.html' );
            } else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

    }
    $conn->close();
?>