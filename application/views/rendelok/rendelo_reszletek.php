<div class="modal" tabindex="-1" role="dialog" id="reszletek_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Részletek</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<img class="col-12" id="reszletek_kep" src="<?php echo base_url() . 'uploads/ford_focus_2022_01_28_18_56_26_1.jpg' ?>" alt="Rendelő képe">
				</div>
				<h5>Rendelő adatai</h5>
				<table class="table">
					<tbody>
						<tr>
							<th>Név</th>
							<td id="reszletek_nev">Ford</td>
						</tr>
						<tr>
							<th>Cím</th>
							<td id="reszletek_irsz">Focus</td>
						</tr>
						<tr>
							<th>Telefon</th>
							<td id="reszletek_telepules">benzin</td>
						</tr>
						<tr>
							<th>E-mail</th>
							<td id="reszletek_email">2020</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Bezárás</button>
			</div>
		</div>
	</div>
</div>

<script>
	function rendelo_reszletek(id) {
		let url = "<?php echo base_url() ?>api/rendelo/" + id;
		$.get(
			url,
			function(data, textStatus, jqXHR) {
				if (textStatus == "success") {
					$("#reszletek_modal").modal('show');
					$("#reszletek_nev").html(data.nev);
					$("#reszletek_irsz").html(data.irsz);
					$("#reszletek_telepules").html(data.telepules);
					$("#reszletek_email").html(data.email);
				}
			},
			"json"
		);
	}
</script>
