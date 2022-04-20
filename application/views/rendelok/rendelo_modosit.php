<div class="container-fluid"> 

    <?php if (!isset($rendelo)): ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php else: ?>
        <h1>Rendelő módosítása</h1>
        <div class="container-fluid">
        <form method="post" action="<?php echo base_url(); ?>rendelok/modosit">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $rendelo['id'] ?>">
            <input type="text" class="form-control" name="nev" id="nev" placeholder="Név" required 
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('nev', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['nev']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $rendelo['nev'] ?>"
            <?php endif; ?>
            >
        </div>

        <div class="form-group"> <!-- "irsz" input type="text"??? -->
            <input type="number" class="form-control" name="irsz" id="irsz" placeholder="Irányítószám" required
           
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('irsz', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['irsz']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $rendelo['irsz'] ?>"
            <?php endif; ?>
            >
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="telepules" id="telepules" placeholder="Település" required
                    
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('telepules', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['telepules']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $rendelo['telepules'] ?>"
            <?php endif; ?>
            >
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="utca" id="utca" placeholder="Utca, házszám" required
                    
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('utca', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['utca']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $rendelo['utca'] ?>"
            <?php endif; ?>
            >
            </div>

        <div class="form-group">
            <input type="text" class="form-control" name="telefon" id="telefon" placeholder="Telefon" required
            
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('telefon', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['telefon']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $rendelo['telefon'] ?>"
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
                value="<?php echo $rendelo['email'] ?>"
            <?php endif; ?>
            >
            </div>
            <br>
            <button type="submit" class="btn btn-dark">Módosít</button>
            <?php  $prev = $prev ??=  site_url('rendelok/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
        </form>
    <?php endif; ?>
</div>
</div