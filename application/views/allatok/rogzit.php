<div class="container-fluid">
    <h1>Állat rögzítése</h1>
    <div class="container-fluid">
    <form method="post">
        <input type="text" class="form-control" name="fajta" id="fajta" placeholder="Fajta" required 
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('Fajta', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['fajta']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>
        <br>
        <button type="submit" class="btn btn-dark">Rögzít</button>
        <?php  $prev = $prev ??=  site_url('allatok/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
    </form>
</div>
</div>