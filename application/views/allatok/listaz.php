<div class="lista">
<div class="container p-3 my-3 border" > 
    <h1>Állatok listája</h1>
    <?php if (isset($allatok)): ?>
        <?php if (!empty($allatok)): ?>
            <div class="container-fluid">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fajta</th>
                    <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                    <th>Műveletek</th>
                </tr>
                <?php else: ?>
				<?php endif; ?>
            </thead>
            <tbody>
                <?php foreach ($allatok as $allat): ?>
                    <tr>
                        <td><?php echo $allat['id'] ?></td>
                        <td><?php echo $allat['fajta'] ?></td>
                        <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                        <td>
                            <button class="btn btn-dark"><a href="<?php echo base_url(); ?>allatok/modosit/<?php echo $allat['id'] ?>">Módosít</a></button>
                            <button class="btn btn-danger"><a href="<?php echo base_url(); ?>allatok/torol/<?php echo $allat['id'] ?>">Töröl</a></button>
                        </td>
                        <?php else: ?>
				        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>            
            <tfoot>
                <tr>
                <th>ID</th>
                    <th>Fajta</th>
                    <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                    <th>Műveletek</th>
                    <?php else: ?>
				    <?php endif; ?>
                </tr>
                
            </tfoot>
            </table>
                </div>
        <?php else: ?>
            <h4>Nincs még állat az adatbázisban</h4>
        <?php endif; ?>
    <?php else: ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php endif; ?>
</div>
</div>