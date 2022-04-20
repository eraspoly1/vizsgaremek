<div class="lista">
<div class="container p-3 my-3 border" > 
    <h1>Szolgáltatások listája</h1>
    <?php if (isset($szolgaltatasok)): ?>
        <?php if (!empty($szolgaltatasok)): ?>
            <div class="container">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Név</th>
                    <th>Leírás</th>
                    <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                    <th>Műveletek</th>
                    <?php else: ?>
				    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($szolgaltatasok as $szolgaltatas): ?>
                    <tr>
                        <td><?php echo $szolgaltatas['id'] ?></td>
                        <td><?php echo $szolgaltatas['nev'] ?></td>
                        <td><?php echo $szolgaltatas['leiras'] ?></td>
                        <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                        <td>
                            <button class="btn btn-dark"><a href="<?php echo base_url(); ?>szolgaltatasok/modosit/<?php echo $szolgaltatas['id'] ?>">Módosít</a></button>
                            <button class="btn btn-danger"><a href="<?php echo base_url(); ?>szolgaltatasok/torol/<?php echo $szolgaltatas['id'] ?>">Töröl</a></button>
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
                    <th>Leírás</th>
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