<div class="container p-3 my-3 border"> 
    
    <?php if (!isset($felhasznalo)): ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php else: ?>
        <h1>Felhasználó módosítása</h1>
        <div class="container">
        <form method="post" action="<?php echo base_url(); ?>felhasznalok/modosit">
        <div class="form-group">
            <input type="hidden" class="form-control" name="id" value="<?php echo $felhasznalo['id'] ?>">
            <input type="text" class="form-control" name="felhasznalonev" id="felhasznalonev" placeholder="Felhasználónév" required 
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('felhasznalonev', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['felhasznalonev']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $felhasznalo['felhasznalonev'] ?>"
            <?php endif; ?>
            >
            </div>
        <div class="form-group">
            <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" required
                    
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('email', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['email']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $felhasznalo['email'] ?>"
            <?php endif; ?>
            >
            </div>


        <div class="form-group">
            <input type="password" class="form-control" name="jelszo" id="jelszo" placeholder="Jelszó" required
            
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('jelszo', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['jelszo']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $felhasznalo['jelszo'] ?>"
            <?php endif; ?>
            >
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="tipus" id="tipus" placeholder="Felhasználó típusa" required
            
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('tipus', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['tipus']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $felhasznalo['tipus'] ?>"
            <?php endif; ?>
            >
            </div>
            <br>
            <button type="submit" class="btn btn-dark">Módosít</button>
            <?php  $prev = $prev ??=  site_url('felhasznalok/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
        </form>
    <?php endif; ?>
</div>
</div>