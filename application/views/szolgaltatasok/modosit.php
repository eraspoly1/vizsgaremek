<div class="container p-3 my-3 border">
    <?php if (!isset($szolgaltatas)): ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php else: ?>
        <h1>Szolgáltatás módosítása</h1>
        <div class="container">
        <form method="post" action="<?php echo base_url(); ?>szolgaltatasok/modosit">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $szolgaltatas['id'] ?>">
            <input type="text" class="form-control" name="nev" id="nev" placeholder="Név" required
                    
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (szolgaltatasray_key_exists('nev', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['nev']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $szolgaltatas['nev'] ?>"
            <?php endif; ?>
            >
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="leiras" id="leiras" placeholder="Leírás" required

            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (szolgaltatasray_key_exists('leiras', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['leiras']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $szolgaltatas['leiras'] ?>"
            <?php endif; ?>
            >
            </div>
            <br>
            <button type="submit" class="btn btn-dark">Módosít</button>
            <?php  $prev = $prev ??=  site_url('szolgaltatasok/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
        </form>
    <?php endif; ?>
</div>
</div>