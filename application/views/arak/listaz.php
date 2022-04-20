<div class="lista">
<div class="container p-3 my-3 border" >   
    <h1>Árak listája</h1>
    <?php if (isset($arak)): ?>
        <?php if (!empty($arak)): ?>
            <div class="container">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ár</th>
                    <th>Állat</th>
                    <th>Rendelő</th>
                    <th>Szolgáltatás</th>
                    <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                    <th>Műveletek</th>
                    <?php else: ?>
				    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arak as $ar): ?>
                    <tr>
                        <td><?php echo $ar['id'] ?></td>
                        <td><?php echo $ar['ar'] ?></td>
                        <td><?php echo $ar['fajta'] ?></td>
                        <td><?php echo $ar['name'] ?></td>
                        <td><?php echo $ar['nev'] ?></td>
                        <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                        <td>
                            <button class="btn btn-dark"><a href="<?php echo base_url(); ?>arak/modosit/<?php echo $ar['id'] ?>">Módosít</a></button>
                            <button class="btn btn-danger"><a href="<?php echo base_url(); ?>arak/torol/<?php echo $ar['id'] ?>">Töröl</a></button>
                        </td>
                        <?php else: ?>
				        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>            
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Ár</th>
                    <th>Állat</th>
                    <th>Rendelő</th>
                    <th>Szolgáltatás</th>
                    <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                    <th>Műveletek</th>
                    <?php else: ?>
				    <?php endif; ?>
                </tr>
            </tfoot>
            </table>
                </div> 
        <?php else: ?>
            <h4>Nincs még ár az adatbázisban</h4>
        <?php endif; ?>
    <?php else: ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php endif; ?>
</div>
    </div>