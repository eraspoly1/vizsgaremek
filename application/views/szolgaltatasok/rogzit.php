<div class="container p-3 my-3 border">
    <h1>Szolgáltatás rögzítése</h1>
    <div class="container">
    <form method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="nev" id="nev" placeholder="Szolgáltatás neve" required 
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('nev', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['nev']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>
        <div class="form-group">
        <input type="text" class="form-control" name="leiras" id="leiras" placeholder="Leírás" required
                
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('leiras', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['leiras']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>
        <br>
        <button type="submit" class="btn btn-dark">Rögzít</button>
        <?php  $prev = $prev ??=  site_url('szolgaltatasok/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
    </form>
</div>
</div>