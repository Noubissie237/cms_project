<?php
session_start();
include '../db/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nom = $_POST['nom'];
  $password = SHA1($_POST['password']);
  
  // Requête préparée pour récupérer l'utilisateur
  $sql = "SELECT * FROM admins WHERE nom = :nom";
  
  // Préparer la requête
  $stmt = $conn->prepare($sql);
  // Lier le paramètre
  $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
  // Exécuter la requête
  $stmt->execute();
  
  // Récupérer les résultats
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Debug pour vérifier si les résultats sont renvoyés
  if ($user) {
    if ($password == $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../");
        exit();
    } else {
        $error = "Nom ou mot de passe incorrect.";
    }
  } else {
    $error = "Aucun utilisateur trouvé avec ce nom.";
  }
}
?>



<html>
<head>
  <meta charset="utf-8">
  <title>CMS_Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        <div class="loginbackground-gridContainer">
          <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
            <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
            </div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
            <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
            <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
            <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
            <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
            <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
            <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
            <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
            <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
          </div>
        </div>
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <h1><a href="../" rel="dofollow">Consultancy System</a></h1>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Sign in to your account</span>
              <?php if (isset($error)) echo "<p>$error</p>"; ?>
              <form id="stripe-login" method="POST">
                <div class="field padding-bottom--24">
                  <label for="nom">Nom</label>
                  <input type="text" id="nom" name="nom">
                </div>

                <div class="field padding-bottom--24">
                  <div class="grid--50-50">
                    <label for="password">Password</label>
                  </div>
                  <input type="password" id="password" name="password">
                </div>
                <div class="field padding-bottom--24">
                  <input type="submit" name="submit" value="Se connecter">
                </div>
              </form>
            </div>
          </div>
          <div class="footer-link padding-top--24">
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>