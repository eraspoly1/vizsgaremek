<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
 
      <div class="container">
       <div class="col-md-4 col-md-offset-4">
         <form class="form-signin" action="<?php echo base_url('login/auth');?>" method="post">
           <h2 class="form-signin-heading">Kérlek jelentkezz be!</h2>
           <?php echo $this->session->flashdata('msg');?>
           <label for="email" class="sr-only">Felhasználónév</label>
           <input type="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
           <label for="jelszo" class="sr-only">Jelszó</label>
           <input type="password" name="jelszo" class="form-control" placeholder="Jelszó" required>
           <div class="checkbox">
             <label>
               <input type="checkbox" value="remember-me"> Emlékezz rám
             </label>
           </div>
           <button class="btn btn-lg btn-primary btn-block" type="submit">Bejelentkezés</button>
         </form>
       </div>
       </div> <!-- /container -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>