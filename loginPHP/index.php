<!doctype html>
<br>
    <body>
    <link rel="stylesheet" href="fileCSS/index.css" type="text/css">
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

    <h1 style="text-align:center;">ACCEDI CON LE TUE CREDENZIALI OPPURE REGISTRATI</h1>
    <i class="far fa-eye-slash"></i>
    <form id="formInsert" method="POST"><br>
        <div id="divUserPassword">
        <h1 style="text-align:center;position: relative;bottom:15px;">Login</h1>

            <div>
                <h2>username</h2>
                <input type="text" id="usrId" class="textInputInsertClass" maxlenght="30" name="in_username" placeholder="&#128100 username ...">
            </div>
            <div>
                <h2>password</h2>
                <input type="password" id="pwdId" class="textInputInsertClass" name="in_password" placeholder="&#128274 password ...">    <input type="button" id="pwdButtonId" onclick="mostraPassword()" value="&#128065">
            </div>
            <div>
                <input type="button" id="loginButton" onclick="inserisciDati()" value="accedi"><br>
                <input type="button" id="iscrivitiButton" onclick="location.href='signin.php';" value="registrati">
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
            $in_username = strtolower($in_username);
            $in_password = strtolower($in_password);

            $controllo = $connectionToServerDB->query("select * from users where username = '$in_username' and password = md5('$in_password')");
            if($controllo->num_rows > 0)
            {
                $_SESSION['in_username'] = $in_username;
                $_SESSION['in_password'] = $in_password;
                $row = $controllo->fetch_assoc();
                $_SESSION['in_date'] = $row["date"];
                header("Location: homePage.php");
            }
            else
            {
                echo '<script language="javascript">
                        alert("USERNAME O PASSWORD ERRATI");
                        document.getElementById("usrId").value="";
                        document.getElementById("pwdId").value="";
                    </script>';
            }
            
        }
    ?>
    </body>
</html>