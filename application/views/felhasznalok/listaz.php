<div class="lista">
<div class="container p-3 my-3 border" > 
    <h1>Felhasználók listája</h1>
    <?php if (isset($felhasznalok)): ?>
        <?php if (!empty($felhasznalok)): ?>
            <div class="container-fluid">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Felhasználónév</th>
                    <th>E-mail</th>
                    <th>Felhasználó típusa</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($felhasznalok as $felhasznalo): ?>
                    <tr>
                        <td><?php echo $felhasznalo['id'] ?></td>
                        <td><?php echo $felhasznalo['felhasznalonev'] ?></td>
                        <td><?php echo $felhasznalo['email'] ?></td>
                        <td><?php echo $felhasznalo['tipus'] ?></td>
                        <td>
                            <button class="btn btn-dark"><a href="<?php echo base_url(); ?>felhasznalok/modosit/<?php echo $felhasznalo['id'] ?>">Módosít</a></button>
                            <button class="btn btn-danger"><a href="<?php echo base_url(); ?>felhasznalok/torol/<?php echo $felhasznalo['id'] ?>">Töröl</a></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>            
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Felhasználónév</th>
                    <th>E-mail</th>
                    <th>Felhasználó típusa</th>
                    <th>Műveletek</th>
                </tr>
            </tfoot>
            </table>
            </div>
        <?php else: ?>
            <h4>Nincs még Felhasználó az adatbázisban</h4>
        <?php endif; ?>
    <?php else: ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php endif; ?>
</div>
</div>