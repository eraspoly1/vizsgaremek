<div class="container-fluid">
    <?php if (!isset($allat)): ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php else: ?>
        <h1>Állat módosítása</h1>
        <div class="container-fluid">
        <form method="post" action="<?php echo base_url(); ?>allatok/modosit">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $allat['id'] ?>">
            <input type="text" class="form-control" name="fajta" id="fajta" placeholder="Fajta" required 
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('fajta', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['fajta']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $allat['fajta'] ?>"
            <?php endif; ?>
            >
            </div>
            <br>
            
            <button type="submit" class="btn btn-dark">Módosít</button>
            <?php  $prev = $prev ??=  site_url('allatok/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
        </form>
    <?php endif; ?>
</div>
</div>