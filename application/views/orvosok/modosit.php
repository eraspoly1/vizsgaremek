<div class="container p-3 my-3 border">
    <?php if (!isset($orvos)): ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php else: ?>
        <h1>Orvos módosítása</h1>
        <div class="container">
        <form method="post" action="<?php echo base_url(); ?>orvosok/modosit">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $orvos['id'] ?>">

            <input type="text" class="form-control" name="elotag" id="elotag" placeholder="Előtag" required 
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('elotag', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['elotag']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $orvos['elotag'] ?>"
            <?php endif; ?>
            >
            </div>


            <div class="form-group">
            <input type="text" class="form-control" name="vnev" id="vnev" placeholder="Vezetéknév" required 
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('vnev', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['vnev']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $orvos['vnev'] ?>"
            <?php endif; ?>
            >
            </div>



            <div class="form-group">
            <input type="text" class="form-control" name="knev" id="knev" placeholder="Keresztnév" required
                    
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('knev', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['knev']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $orvos['knev'] ?>"
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
                value="<?php echo $orvos['email'] ?>"
            <?php endif; ?>
            >
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="rendelo_id" id="rendelo_id" placeholder="Rendelő" required
            
            <?php if ($this->session->userdata('last_request')): ?>
                <?php if (array_key_exists('rendelo_id', $this->session->userdata('last_request'))): ?>
                    value="<?php echo $this->session->userdata('last_request')['rendelo_id']; ?>"
                <?php endif; ?>
            <?php else: ?>
                value="<?php echo $orvos['rendelo_id'] ?>"
            <?php endif; ?>
            >
            </div>
            <br>
            <button type="submit" class="btn btn-dark">Módosít</button>
            <?php  $prev = $prev ??=  site_url('orvosok/index'); ?>
                <a  href="<?= $prev ?>" class="btn btn-dark">Mégsem</a>
        </form>
    <?php endif; ?>
</div>
            </div>