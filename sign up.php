<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
 <link rel="stylesheet" type="text/css" href="style.css">
 <meta charset="utf-8">
 <title></title>
</head>
<body>
 <header>
 <h1>Headbook</h1>

 <nav>
 <ul>
<li><a href="logud.php" class="forsidelinks"> Log ud </a></li>
<li><a href="tilmelding.php" class="forsidelinks"> Tilmeld/Login </a></li>
<li><a href="forum.php" class="forsidelinks"> Stil et spørgsmål </a></li>
</ul>
</nav>
</header>
<main>
<div =class"tilmelding">
<br>
<h3>Tilmeld dig</h3>
<a href="forsiden.php" class="tilmeldtilbage"> Gå tilbage til forside </a>
<form action="" method="post" class="tilmeldingboks">
 <table>
 <tr><td>Username:</td> <td><input type="text" name="username"
required/></td></tr>
 <tr><td>Password:</td> <td><input type="password" name="password"
required/></td></tr>
 <tr><td>First name:</td> <td><input type="text" name="fornavn" placeholder="Enter
 first name" required/></td></tr>
 <tr><td>Last name:</td> <td><input type="text" name="efternavn" placeholder="Enter
 last name"required/></td></tr>
 <tr><td></td> <td><input type="submit" name="submit" value="Tilmeld
dig"></td></tr>
 </table>
</form>
</div>
<?php
if (!isset($_SESSION['user'])) {
?>

<div>
<h3>Log in, hvis du allerede har en bruger</h3>
<div class="loginboks">
<form action="login.php" method="post">
 <table>
 <tr>
 <td>Username:</td>
 <td><input type="text" name="username" required/></td>
 </tr>
 <tr>
 <td>Password:</td>
 <td><input type="password" name="password" required/></td>
 </tr>
 </td></tr>
 <tr>
 <td></td>
 <td><input type="submit" name="Login" value="Login"></td>
 </tr>
 </table>
</form>
</div>
</div>
</main>
</body>
</html>
<?php
}
?>
