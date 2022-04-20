<div class="container p-3 my-3 border">
    <h1>Ár rögzítése</h1>
    <div class="container">
    <form method="post">
    <div class="form-group">
        <input type="number" class="form-control" name="ar" id="ar" placeholder="Ár" required 
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('ar', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['ar']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>


        <div class="form-group">
        <input type="number" class="form-control" name="allat_id" id="allat_id" placeholder="Állat ID" required
                
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('allat_id', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['allat_id']; ?>"
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



        <div class="form-group">
        <input type="text" name="szolgaltatas_id" id="szolgaltatas_id" placeholder="Szolgáltatás ID" required
                
        <?php if ($this->session->userdata('last_request')): ?>
            <?php if (array_key_exists('szolgaltatas_id', $this->session->userdata('last_request'))): ?>
                value="<?php echo $this->session->userdata('last_request')['szolgaltatas_id']; ?>"
            <?php endif; ?>
        <?php endif; ?>
        >
        </div>
        <br>
        <button type="submit" class="btn btn-dark">Rögzít</button>
        <?php  $prev = $prev ??=  site_url('arak/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
    </form>
</div>
</div>