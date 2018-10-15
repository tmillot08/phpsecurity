<?php
 session_start();
?>
!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <form  method="POST" action="inscription.php">
        <input type="text" name="nom" value="" placeholder="Votre Nom">
        <input type="text" name="fnom" value="" placeholder="Votre Prenom">
        <input type="email" name='mail' value= "" placeholder="Votre Mail">
        <input type="text"  name= 'zipcode' value="" placeholder="Votre Code postal">
        <input type="password" name= 'password' value= "" placeholder="Votre mot de passe">
        <input type="password" name= 'cpassword' value= "" placeholder="Confirmation mot de passe">
        <div class="g-recaptcha" data-sitekey="6Lfsg3QUAAAAAFS5F3nWxtOP1D0yLcZwSfGmqnVQ"></div>
        <input type="submit" name="submit" value="Send"> 
        <?php echo $_SESSION['error']?>
    </form>
</body>
</html>