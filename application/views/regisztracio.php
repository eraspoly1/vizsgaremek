<h2 class="mt-3">Regisztráció</h2>
<form action="<?php echo base_url(); ?>regisztracio" method="POST">
    
    <div class="form-group">
        <label for="felhasznalonev">Felhasználónév:</label>
        <input type="text" class="form-control" id="felhasznalonev" placeholder="Felhasználónév" name="felhasznalonev" required <?php if ($this->session->flashdata('last_request') !== null) : ?> value="<?php echo ($this->session->flashdata('last_request')['felhasznalonev']) ?>" <?php endif; ?>>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required <?php if ($this->session->flashdata('last_request') !== null) : ?> value="<?php echo ($this->session->flashdata('last_request')['email']) ?>" <?php endif; ?>>
    </div>
    <div class="form-group">
        <label for="jelszo">Jelszó:</label>
        <input type="password" class="form-control" id="jelszo" placeholder="Jelszó" name="jelszo" required <?php if ($this->session->flashdata('last_request') !== null) : ?> value="<?php echo ($this->session->flashdata('last_request')['jelszo']) ?>" <?php endif; ?>>
    </div>
    <div class="form-group">
        <label for="jelszo_confirm">Jelszó megerősítése:</label>
        <input type="password" class="form-control" id="jelszo_confirm" placeholder="Jelszó megerősítése" name="jelszo_confirm" required <?php if ($this->session->flashdata('last_request') !== null) : ?> value="<?php echo ($this->session->flashdata('last_request')['jelszo_confirm']) ?>" <?php endif; ?>>
    </div>
    
    <button type="submit" class="btn btn-info">Regisztráció</button>
</form>