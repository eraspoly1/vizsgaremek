<div class="lista">
<div class="container p-3 my-3 border" > 
    <h1>Rendelők listája</h1>
    <?php if (isset($rendelok)): ?>
        <?php if (!empty($rendelok)): ?>
            <div class="container-fluid" id="main">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Név</th>
                    <th>Irányítószám</th>
                    <th>Település</th>
                    <th>Utca, házszám</th>
                    <th>Telefon</th>
                    <th>E-mail</th>
                    <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                    <th>Műveletek</th>
                </tr>
                <?php else: ?>
				<?php endif; ?>
            </thead>
            <tbody>
                <?php foreach ($rendelok as $rendelo): ?>
                    <tr>
                        <td><?php echo $rendelo['id'] ?></td>
                        <td><?php echo $rendelo['nev'] ?></td>
                        <td><?php echo $rendelo['irsz'] ?></td>
                        <td><?php echo $rendelo['telepules'] ?></td>
                        <td><?php echo $rendelo['utca'] ?></td>
                        <td><?php echo $rendelo['telefon'] ?></td>
                        <td><?php echo $rendelo['email'] ?></td>
                        <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                        <td>
                            <button class="btn btn-dark"><a href="<?php echo base_url(); ?>rendelok/modosit/<?php echo $rendelo['id'] ?>">Módosít</a></button>
                            <button class="btn btn-danger"><a href="<?php echo base_url(); ?>rendelok/torol/<?php echo $rendelo['id'] ?>">Töröl</a></button>
                        </td>
                        <?php else: ?>
				        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>            
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Név</th>
                    <th>Irányítószám</th>
                    <th>Település</th>
                    <th>Utca, házszám</th>
                    <th>Telefon</th>
                    <th>E-mail</th>
                    <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                    <th>Műveletek</th>
                    <?php else: ?>
				    <?php endif; ?>
                </tr>
            </tfoot>
            </table>
            </div>
        <?php else: ?>
            <h4>Nincs még rendelő az adatbázisban</h4>
        <?php endif; ?>
    <?php else: ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php endif; ?>
</div>
</div>