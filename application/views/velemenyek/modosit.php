<div class="container p-3 my-3 border">
    <?php if (!isset($velemeny)): ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php else: ?>
        <h1>Vélemény módosítása</h1>
        <div class="container">
        <form method="post" action="<?php echo base_url(); ?>velemenyek/modosit">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $velemeny['id'] ?>">

            <div class="form-group">
            <input type="text" class="form-control" name="felhasznalo_id" id="felhasznalo_id" placeholder="Felhasznalo ID" required

            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('felhasznalo_id', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['felhasznalo_id']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $velemeny['felhasznalo_id'] ?>"
            <?php endif; ?>
            >
            </div>

            <input type="text" class="form-control" name="velemeny" id="velemeny" placeholder="Vélemény" required

            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('velemeny', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['velemeny']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $velemeny['velemeny'] ?>"
            <?php endif; ?>
            >
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="rendelo_id" id="rendelo_id" placeholder="Rendelő ID" required

            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('rendelo_id', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['rendelo_id']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $velemeny['rendelo_id'] ?>"
            <?php endif; ?>
            >
            </div>
            <br>
            <button type="submit" class="btn btn-dark">Módosít</button>
            <?php  $prev = $prev ??=  site_url('velemenyek/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
        </form>
    <?php endif; ?>
</div>
</div>