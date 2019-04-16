<!doctype html>
<br>
    <body>
    <link rel="stylesheet" href="fileCSS/signin.css" type="text/css">
    <script type="text/javascript">
        function inserisciDati()
        {
            var inputElement = document.getElementsByClassName("textInputInsertClass");
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
                alert("HAI LASCIATO QUALCHE CAMPO VUOTO");
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

    <h1 style="text-align:center">ISCRIVITI ALLA PAGINA</h1>
    
    <form id="formInsert" method="POST"><br>
    <div id="divUserPassword">
        <h1 style="text-align:center;position: relative;bottom:15px;">Sign in</h1>

            <div>
                <h2>username</h2>
                <input type="text" id="usrId" class="textInputInsertClass" maxlenght="30" name="in_username" placeholder="&#128100 username ...">
            </div>
            <div>
                <h2>password</h2>
                <input type="password" id="pwdId" class="textInputInsertClass" name="in_password" placeholder="&#128274 password ...">    <input type="button" id="pwdButtonId" onclick="mostraPassword()" value="&#128065">
            </div>
            <div>
                <h2>data di nascita</h2>
                <input type="date" id="dateId" class="textInputInsertClass" min="1000-01-01" max="9999-12-31" name="in_date">
            </div>
            <div>
                <input type="button" id="iscrivitiButton" onclick="inserisciDati()" value="registrati">
                <input type="button" id="indietroButton" onclick="location.href='login.php';" value="indietro">
            </div>
        </div>
    </form>
    <?php
        session_start();
        include 'connectToServer.php';
        if(isset($_POST['in_username']) && isset($_POST['in_password']))
        {
            $in_username = $_POST['in_username'];
            $in_password = $_POST['in_password'];
            $in_date = $_POST['in_date'];
            $in_date = str_replace("/", "-", $in_date);
            $in_username = strtolower($in_username);
            $in_password = strtolower($in_password);

            $controllo = $connectionToServerDB->query("insert into users(username,password,date) values ('$in_username',md5('$in_password'),'$in_date');");
            if($controllo === true)
            {
                $_SESSION['in_username'] = $in_username;
                $_SESSION['in_password'] = $in_password;
                $_SESSION['in_date'] = $in_date;
                echo '<script language="javascript">
                        alert("ISCRITTO CON SUCCESSO");
                    </script>';
                header("Location: homePage.php");
            }
            else
            {
                echo '<script language="javascript">alert("LO USERNAME CHE STAI UTILIZZANDO E\' GIA\' UTILIZZATO");</script>';
            }
        }
    ?>
    </body>
</html>