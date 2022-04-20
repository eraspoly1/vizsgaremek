<h2 class="mt-3">Bejelentkezés</h2>
<form action="<?php echo base_url(); ?>bejelentkezes" method="POST">
    <div class="form-group">
        <label for="email">Felhasználónév:</label>
        <input type="email" class="form-control" id="email" placeholder="Felhasználónév" name="email" required>
    </div>
    <div class="form-group">
        <label for="jelszo">Jelszó:</label>
        <input type="password" class="form-control" id="jelszo" placeholder="Jelszó" name="jelszo" required>
    </div>
    <button type="submit" class="btn btn-info">Bejelentkezés</button>
</form>