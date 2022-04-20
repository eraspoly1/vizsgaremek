<div class="container p-3 my-3 border">
    <h1>Vélemény rögzítése</h1>
    <div class="container">
    <form method="post">

        <div class="form-group">
        <input type="number" class="form-control" name="felhasznalo_id" id="felhasznalo_id" placeholder="Felhasználó ID" required
                
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('felhasznalo_id', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['felhasznalo_id']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>

        <div class="form-group">
        <input type="text" class="form-control" name="velemeny" id="velemeny" placeholder="Vélemény velemeny" required 
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('velemeny', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['velemeny']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>
        
        
        
        <div class="form-group">
        <input type="number" class="form-control" name="rendelo_id" id="rendelo_id" placeholder="Rendelő ID" required
                
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('rendelo_id', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['rendelo_id']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>
        <br>
        <button type="submit" class="btn btn-dark">Rögzít</button>
        <?php  $prev = $prev ??=  site_url('velemenyek/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
    </form>
</div>
</div>