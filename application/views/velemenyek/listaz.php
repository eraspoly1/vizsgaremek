<div class="lista">
<div class="container p-3 my-3 border" > 
    <h1>Vélemények listája</h1>
    <?php if (isset($velemenyek)): ?>
        <?php if (!empty($velemenyek)): ?>
            <div class="container">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Felhasználó ID</th>
                    <th>Vélemény</th>
                    <th>Rendelő ID</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($velemenyek as $velemeny): ?>
                    <tr>
                        <td><?php echo $velemeny['id'] ?></td>
                        <td><?php echo $velemeny['felhasznalonev'] ?></td>
                        <td><?php echo $velemeny['velemeny'] ?></td>
                        <td><?php echo $velemeny['nev'] ?></td>
                        <td>
                            <button class="btn btn-dark"><a href="<?php echo base_url(); ?>velemenyek/modosit/<?php echo $velemeny['id'] ?>">Módosít</a></button>
                            <button class="btn btn-danger"><a href="<?php echo base_url(); ?>velemenyek/torol/<?php echo $velemeny['id'] ?>">Töröl</a></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>            
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Felhasználó ID</th>
                    <th>Vélemény</th>
                    <th>Rendelő ID</th>
                    <th>Műveletek</th>
                </tr>
            </tfoot>
            </table>
                </div>
        <?php else: ?>
            <h4>Nincs még vélemény az adatbázisban</h4>
        <?php endif; ?>
    <?php else: ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php endif; ?>
</div>
</div>