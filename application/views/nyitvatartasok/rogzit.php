<div class="container p-3 my-3 border">
    <h1>Nyitvatartás rögzítése</h1>
    <div class="container">
    <form method="post">
    <div class="form-group">
        <input type="number" class="form-control" name="nap" id="nap" value="1" min="0" max="6" placeholder="Nap" required 
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('nap', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['nap']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>
        <div class="form-group">
        <input type="time" class="form-control" name="nyitas" id="nyitas" placeholder="Nyitás" required
                
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('nyitas', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['nyitas']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>
        <div class="form-group">
        <input type="time" class="form-control" name="zaras" id="zaras" placeholder="Zárás" required
        
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('zaras', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['zaras']; ?>"
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
        <?php  $prev = $prev ??=  site_url('nyitvatartasok/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
    </form>
</div>
</div>