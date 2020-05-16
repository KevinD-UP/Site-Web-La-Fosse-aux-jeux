<?php  
if(!isset($_SESSION)){session_start();}
?>

<!DOCTYPE html>
    <html lang='fr'>
        <head>
            <meta charset="utf-8">
            <title>Contact</title>
            <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>
            <link href="style2.css" type="text/css" rel="stylesheet">
        </head>

        <body>
            <div class="nav">
              <div class="container">
                <nav>
                <ul>
                  <li><a href="index.php" >Accueil</a></li>         
                  <li><a href="propos.html">A propos</a></li>
                </ul>
              </nav>
              </div>
            </div>


            <div class="form">

                <?php 
                if(array_key_exists('errors',$_SESSION)): 
                ?>
                   <?= implode('<br>', $_SESSION['errors']); ?>

                <?php endif;  
                ?>

                <?php if(array_key_exists('success',$_SESSION)):?>

                      Votre email a bien été envoyé.

                <?php endif;  ?>

                <form action="post_contact.php" method="post">
                    <fieldset>
                        <legend>Contact</legend>

                         <label for="name">Nom</label>
                          <input type="text" name="name"  id="name" value="<?=isset($_SESSION['inputs']['name']) ? $_SESSION['inputs']['name']:'';?>"><br>

                         <label for="Email">Email</label>
                          <input type="email" name="email"  id="Email" value="<?=isset($_SESSION['inputs']['email']) ? $_SESSION['inputs']['email']:'';?>"><br>

                            <label for="Message">Message</label>
                            <textarea name="message"id="Message"><?=isset($_SESSION['inputs']['message']) ? $_SESSION['inputs']['message']:'';?></textarea><br>

                            <input type="submit">
                    </fieldset>
                </form>
            </div> 
        </body>

    </html>
    
    <?php
    unset($_SESSION['inputs']);
    unset($_SESSION['success']);
    unset($_SESSION['errors']);
    ?>