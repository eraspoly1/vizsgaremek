<div class="container p-3 my-3 border">
    <?php if (!isset($nyitvatartas)): ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php else: ?>
        <h1>Nyitvatartás módosítása</h1>
        <div class="container">
        <form method="post" action="<?php echo base_url(); ?>nyitvatartasok/modosit">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $nyitvatartas['id'] ?>">
            <input type="number" class="form-control" name="nap" id="nap" min="0" max="6" placeholder="Nap" required 
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('nap', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['nap']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $nyitvatartas['nap'] ?>"
            <?php endif; ?>
            >
            </div>
            <div class="form-group">
            <input type="time" class="form-control" name="nyitas" id="nyitas" placeholder="Nyitás" required
                    
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('nyitas', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['nyitas']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $nyitvatartas['nyitas'] ?>"
            <?php endif; ?>
            >
            </div>
            <div class="form-group">
            <input type="time" class="form-control" name="zaras" id="zaras" placeholder="Zárás" required
            
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('zaras', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['zaras']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $nyitvatartas['zaras'] ?>"
            <?php endif; ?>
            >
            </div>
            <div class="form-group">
            <input type="number" class="form-control" name="rendelo_id" id="rendelo_id" placeholder="Rendelő ID" required
            
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('rendelo_id', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['rendelo_id']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $nyitvatartas['rendelo_id'] ?>"
            <?php endif; ?>
            >
            </div>
            <br>
            <button type="submit" class="btn btn-dark">Módosít</button>
            <?php  $prev = $prev ??=  site_url('nyitvatartasok/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
        </form>
    <?php endif; ?>
</div>
</div>