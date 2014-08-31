<?php require_once("../../controller/controller_captcha.php");?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <form method="post" action="../../action/action_register.php">
        <input name="user" type="text" placeholder="user">
        <input name="pass" type="password" placeholder="pass">
        <button type="submit">Register</button>
        <br>
        <img src='<?php create_captcha(150,25); ?>' alt="captcha">
        <br>
        <label>Captcha</label>
        <input name="captcha" type="text" placeholder="captcha">
    </form>
<br>
    <a href="../login">Login</a>
</body>
</html>
