<div class="lista">
<div class="container p-3 my-3 border" >
<h1><?php echo $rendelo->nev; ?> részletei</h1>
<?php if (isset($rendelo)): ?>
        <?php if (!empty($rendelo)): ?>
<div class="container p-3 my-3 border" > 
            <div class="container-fluid" id="main">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>Név</th>
                    <th>Cím</th>
                    <th>Telefon</th>
                    <th>E-mail</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td><?php echo $rendelo->nev; ?></td>
                        <td><?php echo $rendelo->telepules . " (" . $rendelo->irsz. ")" .", " . $rendelo->utca; ?></td>
                        <td><?php echo $rendelo->telefon ?></td>
                        <td><?php echo $rendelo->email ?></td>
                    </tr>
            </tbody>            
            </table>
            <?php else: ?>
            <h4>Nincs még rendelő az adatbázisban</h4>
        <?php endif; ?>
    <?php else: ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php endif; ?>
    <?php if (isset($nyitvatartas)): ?>
        <?php if (!empty($nyitvatartas)): ?>
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nap</th>
                    <th>Nyitás időpontja</th>
                    <th>Zárás időpontja</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($nyitvatartas as $ny):  ?>
                    <tr>
                        <td><?php echo $ny->nap ?></td>
                        <td><?php echo $ny->nyitas ?></td>
                        <td><?php echo $ny->zaras ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>            
            </table>
            </div>
            <?php else: ?>
            <h4>Ehhez a rendelőhöz nincs még nyitvatartás megadva</h4>
        <?php endif; ?>
    <?php else: ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php endif; ?>

    <?php if (isset($arak)): ?>
        <?php if (!empty($arak)): ?>
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>Ár</th>
                    <th>Állat fajta</th>
                    <th>Rendelő név</th>
                    <th>Szolgáltatás név</th>
                    <th>Szolgáltatás leírás</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($arak as $a):  ?>
                    <tr>
                        <td><?php echo $a->ar ?> Ft</td>
                        <!--<td><?php echo $a->alid ?></td> -->
                        <td><?php echo $a->fajta ?></td>
                        <td><?php echo $a->rnev ?></td>
                        <td><?php echo $a->sznev ?></td>
                        <td><?php echo $a->leiras ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>            
            </table>
            </div>
            <?php else: ?>
            <h4>Ehhez a rendelőhöz nincs még ár megadva</h4>
        <?php endif; ?>
    <?php else: ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php endif; ?>

    <?php if (isset($velemenyek)): ?>
        <?php if (!empty($velemenyek)): ?>
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>Felhasznalónév</th>
                    <th>Vélemény</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($velemenyek as $v):  ?>
                    <tr>
                        <td><?php echo $v->fnev ?></td>
                        <td><?php echo $v->velemeny ?></td>

                    </tr>
                <?php endforeach; ?>
                </tbody>            
            </table>
            <button class="btn btn-dark"><a href="<?php echo base_url(); ?>kezdolap/index/">Vissza a kezdőlapra</a></button>
            </div>
            <?php else: ?>
            <h4>Ehhez a rendelőhöz nincs még írtak véleményt</h4>
            <button class="btn btn-dark"><a href="<?php echo base_url(); ?>kezdolap/index/">Vissza a kezdőlapra</a></button>
        <?php endif; ?>
    <?php else: ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php endif; ?>


    </div>
</div>