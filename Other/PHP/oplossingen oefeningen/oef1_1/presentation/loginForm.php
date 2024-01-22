<!DOCTYPE html>
<!-- presentation/loginForm.php -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        
        <h1>Aanmelden</h1>
        
        <form action="aanmelden.php?action=login" method="post">
            <table>
                <tbody>
                    <tr>
                        <td>Gebruikersnaam:</td>
                        <td><input type="text" name="txtGebruikersnaam"></td>
                    </tr>
                    <tr>
                        <td>Wachtwoord:</td>
                        <td><input type="password" name="txtWachtwoord"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Aanmelden" /></td>
                    </tr>
                </tbody>
            </table>
        </form>
        
    </body>
</html>
