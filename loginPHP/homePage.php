<!doctype html>
<br>
    <body>
    <link rel="stylesheet" href="fileCSS/homePage.css" type="text/css">
    <?php
        include 'connectToServer.php';
        session_start();

        if (isset($_SESSION['in_username']) && isset($_SESSION['in_password']))
        {
            $in_username = $_SESSION['in_username'];
            $in_date = $_SESSION['in_date']; 
        }
        else
        {
            header("Location: index.php");
        }
        
    ?>
    <div id="divTop" style="text-align:center">
        <input type="button" id="buttonHomeId" class="buttonHomePlayAbout" onclick="location.href='homePage.php';" value="Home">
        <input type="button" id="buttonEditId" class="buttonEditLogout" onclick="location.href='editProfile.php';" value="Edit">
        <input type="button" id="buttonLogoutId" class="buttonEditLogout" onclick="location.href='logout.php';" value="Logout">
    </div>

    <div id="divTopButton">

    </div>

    <div id="divMainPage">
        <?php
            $controllo = $connectionToServerDB->query("select * from users where username = '$in_username';");
            if($controllo->num_rows > 0)
            {
                $row = $controllo->fetch_assoc();
                echo '<div id="divInfoProfilo" style="position:absolute;top:15%;left:10%;font-size:26px">';
                echo '<p>Username : '.$row['username'].'</p><br>';
                echo '<p>Password codificata con "md5" : '.$row['password'].'</p><br>';
                echo '<p>Data di nascita : '.$row['date'].'</p><br>';
                echo '</div>';
            }
        ?>
    </div>
    </body>
</html>