<form class="form-inline my-2 my-lg-0" method="get" action="<?php echo base_url('kezdolap/index')?>">
    <input class="form-control mr-sm-2" type="search" placeholder="Keresés" aria-label="Search" name="keyword"
        value="<?php if($this->input->get('keyword'))echo $this->input->get('keyword');?>">
    <button class="btn btn-outline-info mr-2" type="submit">Keresés</button>
</form>
<br>
<h1>
    <p>Ez az Országos Állatorvos Kereső teszt oldala</p>
</h1>
<p class="text-justify">Bizonyára ismerős a szituáció azoknak akik kisállatot tartanak. Hétvége vagy ünnepnap és látjuk,
    hogy baj van, orvosra lenne szükség. Azonnal.</p>
<p class="text-justify">A kereső erre a problémára kínál megoldást.</p>
<p class="text-justify">Országos állatorvoskeresőnk részletes találati listákat és térképes szűrési eredményeket nyújt
    azoknak a felhasználó gazdiknak, akiknek (kis)állata orvosi ellátásra szorul.
    Különös hangsúlyt fektetünk rá, hogy azok a nehezebb helyzetben lévő kisállatgazdik is megtalálhassák az állatuk
    számára segítséget nyújtani képes állatorvosokat, akiknek nem kutyusuk vagy macskájuk van.
    Ők ugyanis sokszor azzal kell, hogy szembesüljenek, hogy az állatklinikáknak csupán egy szűkebb köre foglalkozik
    egyéb állatfajták szakszerű ellátásával.
    Ezen helyek és szakemberek felkutatásának nehézsége inspirálta projektünket.
    A felhasználó oldalunkon nem csak az adott orvosok, klinikák adatlapjait tekintheti meg, hanem nyitvatartási
    idejükről is tájékozódhat, illetve az aktuálisan ügyeletes orvosokra is szűrhet.
    Ez sürgős ellátást igénylő esetben nagy segítséget jelenthet.
    Az a felhasználó pedig, aki regisztrál, az megoszthatja tapasztalatait az igénybe vett orvosi ellátással
    kapcsolatban.
    A regisztráló orvosoknak pedig, azon kívül, hogy megjelenési felületet biztosítunk, lehetőségük van a felhasználók
    által feltett kérdésekre válaszolni, és így népszerűsíteni magukat.
    Állatorvosok mellett kiegészítésként tervezzük az oldalon az állatpatikák összegyűjtését is.
</p>
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
                <p class="card-text">
                    <?php echo strlen($k->telepules) > 75 ? substr($k->telepules, 0, 75) . "..." : $k->telepules  ?></p>
            </div>
            <div class="card-footer">
                <p>E-mail: <?php echo $k->email ?></p>
                <button class="btn btn-primary" style="width: 100%;"><a
                        href="<?php echo base_url(); ?>kezdolap/reszletek/<?php echo $k->id ?>">Részletek</a></button>
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