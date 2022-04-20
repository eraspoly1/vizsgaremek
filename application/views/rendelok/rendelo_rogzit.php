<div class="container-fluid">
    <h1>Rendelő rögzítése</h1>
    <div class="container-fluid">
    <form method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="nev" id="nev" placeholder="Név" required 
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('nev', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['nev']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>
        
        <div class="form-group">
        <input type="number" class="form-control" name="irsz" id="irsz" placeholder="Irányítószám" required
                
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('irsz', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['irsz']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>

        <div class="form-group">
        <input type="text" class="form-control" name="telepules" id="telepules" placeholder="Település" required
                
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('telepules', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['telepules']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>

        <div class="form-group">
        <input type="text" class="form-control" name="utca" id="utca" placeholder="Utca, házszám" required
                
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('utca', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['utca']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>

        <div class="form-group">
        <input type="text" class="form-control" name="telefon" id="telefon" placeholder="Telefon" required
        
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('telefon', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['telefon']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" required
        
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('email', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['email']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>
        <br>
        <button type="submit" class="btn btn-dark">Rögzít</button>
        <?php  $prev = $prev ??=  site_url('rendelok/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
    </form>
</div>
</div>