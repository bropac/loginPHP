<!doctype html>
<br>
    <body>
    <link rel="stylesheet" href="fileCSS/editProfile.css" type="text/css">

    <script type="text/javascript">
        function inserisciDati()
        {
            var inputElement = document.getElementsByClassName("textInputInsertClassPwd");
            var controllo = true;
            for (var i = 0; i < inputElement.length; i++)
            {
                if(inputElement[i].value == "")
                {
                    controllo = false;
                }
            }
            if(!controllo)
            {
                alert("INSERISCI LA PASSWORD CORRENTE");
            }
            else
            {
                document.getElementById("formInsert").submit();
            }
        }
        function mostraPassword()
        {
            var pwd = document.getElementById("pwdId");
            if (pwd.type === "password")
                pwd.type = "text";
            else
                pwd.type = "password";
        }
        function mostraDati()
        {
            document.getElementById("formMostraDati").submit();
        }
    </script>

    <?php
        session_start();
        $typeAllowed = array('jpg','jpeg','png');
        $cartellaCorrente = getcwd();
        if (isset($_SESSION['in_username']) && isset($_SESSION['in_password']))
        {
            include 'connectToServer.php'; 
            $usernameSearch = $_SESSION['in_username'];
            if(isset($_POST['in_password']))
            {
                $in_password = $_POST['in_password'];

                $controllo = $connectionToServerDB->query("select * from users where username = '$usernameSearch' and password = md5('$in_password')");
                if($controllo->num_rows > 0)
                {
                    if(isset($_POST["buttonEliminaName"]))
                    {
                        $in_password = $_POST['in_password'];

                        $controllo = $connectionToServerDB->query("select * from users where username = '$usernameSearch' and password = md5('$in_password')");
                        if($controllo->num_rows > 0)
                        {
                            $controllo = $connectionToServerDB->query("delete from users where username = '$usernameSearch';");
                            header("Location: logout.php");
                        }
                    }
                    else
                    {
                        if(isset($_POST['in_username']) && $_POST['in_username'] != "")
                        {
                            $in_username = $_POST['in_username'];
                        }
                        else
                        {
                            $in_username = $_SESSION['in_username'];
                        }
                        if(isset($_POST['in_date']) && $_POST['in_date'] != "" )
                        {
                            $in_date = $_POST['in_date'];
                        }
                        else
                        {
                            $in_date = $_SESSION['in_date'];
                        }

                        $in_date = str_replace("/", "-", $in_date);
                        $in_username = strtolower($in_username);

                        $controllo = $connectionToServerDB->query("update users set username='$in_username',date='$in_date' where username='$usernameSearch';");
                        if($controllo === true)
                        {
                            $_SESSION['in_username'] = $in_username;
                            $_SESSION['in_password'] = $in_password;
                            $_SESSION['in_date'] = $in_date;
                            header("Location: homePage.php");
                        }
                        else
                        {
                            echo '<script language="javascript">alert("LO USERNAME CHE STAI UTILIZZANDO E\' GIA\' UTILIZZATO");</script>';
                        }
                    }
                }
                else
                {
                    echo '<script language="javascript">alert("PASSWORD ERRATA");</script>';
                }
            }
        }
        else
        {
            header("Location: index.php");
        }
        
    ?>

    <div id="divTop">
        <input type="button" id="buttonHomeId" class="buttonHome" onclick="location.href='homePage.php';" value="Home">
        <input type="button" id="buttonEditId" class="buttonEditLogout" onclick="location.href='editProfile.php';" value="Edit">
        <input type="button" id="buttonLogoutId" class="buttonEditLogout" onclick="location.href='logout.php';" value="Logut">
    </div>
    
    <div id="divTopButton"></div>
    
    <div id="divMainPage">
        <h1 style="text-align:center">MODIFICA IL TUO PROFILO</h1>
        
        <form id="formInsert" method="POST"><br>
            <div id="divUserPassword">
                    <div>
                        <h2>username</h2>
                        <input type="text" id="usrId" class="textInputInsertClass" maxlenght="30" name="in_username" placeholder="&#128100 username ...">
                    </div>
                    <div>
                        <h2>password corrente *</h2>
                        <input type="password" id="pwdId" class="textInputInsertClassPwd" name="in_password" placeholder="&#128274 password ...">    <input type="button" id="pwdButtonId" onclick="mostraPassword()" value="&#128065">
                    </div>
                    <div>
                        <h2>data di nascita</h2>
                        <input type="date" id="dateId" class="textInputInsertClass" min="1000-01-01" max="9999-12-31" name="in_date">
                    </div>
            </div>
            <div id="divButtonConferma">
                <input type="button" id="buttonConferma" onclick="inserisciDati()" value="conferma modifiche">
            </div>
            <div id="divButtonElimina">
                <input type="submit" id="buttonElimina" name="buttonEliminaName" onclick="inserisciDati()" value="elimina profilo">
            </div>
        </form>
    </div>
    </body>
</html>