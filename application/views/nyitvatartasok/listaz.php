<div class="lista">
<div class="container p-3 my-3 border" > 
    <h1>Nyitvatartások listája</h1>
    <?php if (isset($nyitvatartasok)): ?>
        <?php if (!empty($nyitvatartasok)): ?>
            <div class="container">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nap</th>
                    <th>Nyitás</th>
                    <th>Zárás</th>
                    <th>Rendelő Neve</th>
                    <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                    <th>Műveletek</th>
                    <?php else: ?>
				    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nyitvatartasok as $nyitvatartas): ?>
                    <tr>
                        <td><?php echo $nyitvatartas['id'] ?></td>
                        <td><?php echo $nyitvatartas['nap'] ?></td>
                        <td><?php echo $nyitvatartas['nyitas'] ?></td>
                        <td><?php echo $nyitvatartas['zaras'] ?></td>
                        <td><?php echo $nyitvatartas['rendelo_nev'] ?></td>
                        <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                        <td>
                            <button class="btn btn-dark"><a href="<?php echo base_url(); ?>nyitvatartasok/modosit/<?php echo $nyitvatartas['id'] ?>">Módosít</a></button>
                            <button class="btn btn-danger"><a href="<?php echo base_url(); ?>nyitvatartasok/torol/<?php echo $nyitvatartas['id'] ?>">Töröl</a></button>
                        </td>
                        <?php else: ?>
				        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>            
            <tfoot>
                <tr>
                <th>ID</th>
                    <th>Nap</th>
                    <th>Nyitás</th>
                    <th>Zárás</th>
                    <th>Rendelő Neve</th>
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