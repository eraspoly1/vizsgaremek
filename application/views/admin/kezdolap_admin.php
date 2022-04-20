<form class="form-inline my-2 my-lg-0" method="get" action="<?php echo base_url('kezdolap/index')?>">
	      <input class="form-control mr-sm-2" type="search" placeholder="Keresés" aria-label="Search" name="keyword" value="<?php if($this->input->get('keyword'))echo $this->input->get('keyword');?>">
	      <button class="btn btn-outline-info mr-2" type="submit">Keresés</button>
	    </form>
		<br>
		<h1><p>Üdv újra <?php echo $this->session->userdata('felhasznalonev');?>!</p></h1>
		<p>Ez a felület ad lehetőséget az adminnak hogy teljekörű adminisztrációt végezzen.</p>
		<p>Kattintgasd végig a menüpontokat további infóért.</p>
		<p>Ha idáig eljutottál, akkor az azt jelenti, hogy bármit meg tudsz változtatni. Ne feledd, csak óvatosan! 
		</p>
		<p>Sok sikert a használathoz! Ha elakadnál, keress bátran.</p>
<div class="row gy-3">
<?php
		foreach($kereso as $k)
		{
			?>
			<?php
if($this->input->get('keyword'))
{
	?>
	<b>Keresés eredménye "<?php echo $this->input->get('keyword');?>"</b>
	<?php
}
?>
<div class="col-lg-3 col-md-4 col-sm-6 col-12 d-flex">

			<div class="card flex-fill">
				<div class="card-body">
					<h5 class="card-title"><?php echo $k->nev;  $k->irsz ?></h5>
					<p class="card-text"><?php echo strlen($k->telepules) > 75 ? substr($k->telepules, 0, 75) . "..." : $k->telepules  ?></p>
				</div>
				<div class="card-footer">
					<p>E-mail: <?php echo $k->email ?></p>
					<button class="btn btn-primary" style="width: 100%;"><a href="<?php echo base_url(); ?>kezdolap/reszletek/<?php echo $k->id ?>">Részletek</a></button>
				</div>
			</div>

  </div>
			<?php
		}
		?>
		
	</div>
	<div class="mt-3">
	<?php echo $this->pagination->create_links();?>
	</div>