<div class="container-fluid" > 
<div class="container-fluid">
    <h1>Rendelők listája</h1>
    <?php if (isset($rendelok)): ?>
        <?php if (!empty($rendelok)): ?>
            <div class="container">
            <div class="row">
            <?php foreach ($rendelok as $rendelo): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 d-flex">
			<div class="card flex-fill">
			<!--	<div class="img-container card-header">
					<img class="card-img-top" src="<?php echo base_url() . 'uploads/' . $auto['kep']; ?>" alt="Autó képe">
				</div> -->
				<div class="card-body">
					<h5 class="card-title"><?php echo $rendelo['nev'] . ' - ' . $rendelo['irsz'] ?></h5>
					<p class="card-text"><?php echo strlen($rendelo['telepules']) > 75 ? substr($rendelo['telepules'], 0, 75) . "..." : $rendelo['telepules']  ?></p>
				</div>
				<div class="card-footer">
					<p>E-mail: <?php echo $rendelo['email'] ?></p>
					<button class="btn btn-dark" style="width: 100%;"><a href="<?php echo base_url(); ?>rendelok/modosit/<?php echo $rendelo['id'] ?>">Módosít</a></button>
                    <button class="btn btn-danger" style="width: 100%;"><a href="<?php echo base_url(); ?>rendelok/torol/<?php echo $rendelo['id'] ?>">Töröl</a></button>
				</div>
			</div>


  </div><br>
  <?php endforeach; ?>
  </div>
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
                    <th>Műveletek</th>
                </tr>
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
                        <td>
                            <button class="btn btn-dark"><a href="<?php echo base_url(); ?>rendelok/modosit/<?php echo $rendelo['id'] ?>">Módosít</a></button>
                            <button class="btn btn-danger"><a href="<?php echo base_url(); ?>rendelok/torol/<?php echo $rendelo['id'] ?>">Töröl</a></button>
                        </td>
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
                    <th>Műveletek</th>
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