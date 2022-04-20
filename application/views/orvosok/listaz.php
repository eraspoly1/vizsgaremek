<div class="lista">
<div class="container p-3 my-3 border" > 
    <h1>Orvosok listája</h1>
    <?php if (isset($orvosok)): ?>
        <?php if (!empty($orvosok)): ?>
            <div class="container">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Előtag</th>
                    <th>Vezetéknév</th>
                    <th>Keresztnév</th>
                    <th>E-mail</th>
                    <th>Rendelő</th>
                    <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                    <th>Műveletek</th>
                    <?php else: ?>
				    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orvosok as $orvos): ?>
                    <tr>
                        <td><?php echo $orvos['id'] ?></td>
                        <td><?php echo $orvos['elotag'] ?></td>
                        <td><?php echo $orvos['vnev'] ?></td>
                        <td><?php echo $orvos['knev'] ?></td>
                        <td><?php echo $orvos['email'] ?></td>
                        <td><?php echo $orvos['nev'] ?></td>
                        <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                        <td>
                            <button class="btn btn-dark"><a href="<?php echo base_url(); ?>orvosok/modosit/<?php echo $orvos['id'] ?>">Módosít</a></button>
                            <button class="btn btn-danger"><a href="<?php echo base_url(); ?>orvosok/torol/<?php echo $orvos['id'] ?>">Töröl</a></button>
                        </td>
                        <?php else: ?>
				        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>            
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Előtag</th>
                    <th>Vezetéknév</th>
                    <th>Keresztnév</th>
                    <th>E-mail</th>
                    <th>Rendelő</th>
                    <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                    <th>Műveletek</th>
                    <?php else: ?>
				    <?php endif; ?>
                </tr>
            </tfoot>
            </table>
            </div>
        <?php else: ?>
            <h4>Nincs még orvos az adatbázisban</h4>
        <?php endif; ?>
    <?php else: ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php endif; ?>
</div>
    </div>