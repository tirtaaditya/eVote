<!DOCTYPE html>
<html lang="en">
	<head><base href="../../../">
	    	<title><?= getenv('applicationName')." | Login" ?></title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="<?=base_url()?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url()?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

		<!-- Javascript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
		<script src="<?=base_url()?>/assets/plugins/global/plugins.bundle.js"></script>
        <style type="text/css">
        	.signature-pad{
        		border: 1px solid #ccc;
        		border-radius: 5px;
        		width: 100%;
        		height: 260px;
        	}
        </style>
	<style>
			.screen {
				position: fixed;
				transition: all .5s;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				z-index: 10;
				background-color: rgba(16, 16, 16, 0.5);
			}

			.loader {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				display: flex;
				align-items: center;
				border-radius:20px;
			}
		</style>		
	</head>
		<div class="screen">
			<div class="box">
				<div class="loader">
					<div class="spinner-grow text-danger"></div>&nbsp;&nbsp;
					<div class="spinner-grow text-muted"></div>&nbsp;&nbsp;
					<div class="spinner-grow text-primary"></div>&nbsp;&nbsp;
					<div class="spinner-grow text-success"></div>&nbsp;&nbsp;
				</div>
			</div>
		</div>
	<form method="post" action="<?= $postbackURL  ?>" enctype="multipart/form-data">
		<body id="kt_body" class="bg-body">
			<div class="d-flex flex-column flex-root">
				<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(<?=base_url()?>/assets/media/illustrations/dozzy-1/14.png">                
					<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
						<a href="<?=base_url()?>" class="mb-12">
							<img alt="Logo" src="<?=base_url()?>/assets/media/logos/LogoHeader-1.png" class="h-150px" />
						</a>
						<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
							<div class="text-center mb-10">
								<h1 class="text-dark mb-3">Form Submit</h1>
								<div class="text-gray-400 fw-bold fs-4">
								<a href="<?=base_url()?>" class="link-primary fw-bolder">RAT KOPEGTEL MEDIATRON TAHUN BUKU 2022</a></div>
							</div>
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Nama</label>
								<input class="form-control form-control-lg form-control-solid" type="text" name="nama" value="<?= $dataSession['name'] ?? '' ?>" autocomplete="off" readonly />
							</div>
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">NIK</label>
								<input class="form-control form-control-lg form-control-solid" type="text" name="nik" value="<?= $dataSession['nik'] ?? '' ?>" autocomplete="off" readonly />
							</div>
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Phone Number</label>
								<input class="form-control form-control-lg form-control-solid" type="text" name="phoneNumber" value="<?= $dataSession['phoneNumber'] ?? '' ?>" autocomplete="off" readonly />
							</div>
							<div class="fv-row mb-10">   
								<h4>Signature</h4>
								<div class="text-right">
									<button type="button" class="btn btn-default btn-sm" id="undo"><i class="fa fa-undo"></i> Undo</button>
									<button type="button" class="btn btn-danger btn-sm" id="clear"><i class="fa fa-eraser"></i> Clear</button>
								</div>
								<hr>
								<div class="wrapper">
									<canvas id="signature-pad" name="signature" class="signature-pad"></canvas>
								</div>
							</div>
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Surat Kuasa</label>
								<select name="kuasa" id="kuasa" class="form-control">
									<option value="">Pilih</option>
									<option value="Ya">Ya</option>
									<option value="Tidak">Tidak</option>
								</select>
							</div>
							<div class="fv-row mb-10" id="row-document" style="display : none">
								<label class="form-label fs-6 fw-bolder text-dark">Upload Bukti Surat Kuasa</label>
								<textarea name="pemberiKuasa" id="pemberiKuasa" cols="30" rows="5" class="form-control" placeholder="input nik pisahkan dengan tanda ,"></textarea>
								<p class="text-danger">*example : 20001,2009,2008</p>
							</div>
							<center>
							<button type="button" class="btn btn-primary" data-toggle="modal" id="modal-submit" data-target="#myModal">
								Simpan
							</button>
							<!-- <button type="button" class="btn btn-primary" id="modal-submit" data-toggle="modal" onclick="handleSubmit()">
								Submit
							</button> -->
							</center>
						</div>
					</div>
					<div class="d-flex flex-center flex-column-auto p-10">
						<div class="d-flex align-items-center fw-bold fs-6">
						</div>
					</div>
				</div>
			</div>

			<!-- The Modal -->
				<div class="modal fade" id="myModal">
					<div class="modal-dialog">
						<div class="modal-content">

						<!-- Modal body -->
						<div class="modal-body">
							
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<button type="button" class="btn btn-danger closeModal" data-dismiss="modal">Tidak</button>
							<button type="submit" id="SaveButton" onclick="disabledButton()" class="btn btn-primary">Ya</button>
						</div>

						</div>
					</div>
				</div>
		</form>
		<?php if (!empty(session()->getFlashdata('errorMessage')) ) : ?>
			<script>
				pesan = "<?= session()->getFlashdata('errorMessage'); ?>";
				
				Swal.fire({
					text: pesan,
					icon: "error",
					buttonsStyling: !1,
					confirmButtonText: "Ok",
					customClass: {
						confirmButton: "btn btn-primary"
					}
				})
			</script>
		<?php endif; ?>
		</body>
	</form>
</html>

<script type="text/javascript">
	var canvas = document.getElementById('signature-pad');
	function resizeCanvas() {
		var ratio =  Math.max(window.devicePixelRatio || 1, 1);
		canvas.width = canvas.offsetWidth * ratio;
		canvas.height = canvas.offsetHeight * ratio;
		canvas.getContext("2d").scale(ratio, ratio);
	}

	window.onresize = resizeCanvas;
	resizeCanvas();

	var signaturePad = new SignaturePad(canvas, {
		backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
	});

	document.getElementById('clear').addEventListener('click', function () {
		signaturePad.clear();
	});

	document.getElementById('undo').addEventListener('click', function () {
		var data = signaturePad.toData();
		if (data) {
			data.pop(); // remove the last dot or line
			signaturePad.fromData(data);
		}
	});

	$(document).ready(function(){		
		$('#kuasa').on('change', function(){
			if(this.value == "Ya")
			{
				$('#row-document').show()
			}
			else
			{
				$('#row-document').hide()
			}
			$('#document').val('');
		})

		$('#modal-submit').on('click', function(){
			if (signaturePad.isEmpty()) {	
			Swal.fire({
				text: "Tanda Tangan Anda Kosong! Silahkan tanda tangan terlebih dahulu.",
				icon: "error",
				buttonsStyling: !1,
				confirmButtonText: "Ok",
				customClass: {
					confirmButton: "btn btn-primary"
				}
			}).then((function(e) {
				$('#myModal').modal('hide');
				$('.modal-backdrop').hide();
				$("body").removeClass("modal-open");				
				return false;
			}))

		}
		
		let pemberiKuasa = $('#pemberiKuasa').val()
		let kuasa = $('#kuasa').val()
		if(kuasa == "")
		{
			Swal.fire({
				text: "Surat Kuasa Wajib Di Isi",
				icon: "error",
				buttonsStyling: !1,
				confirmButtonText: "Ok",
				customClass: {
					confirmButton: "btn btn-primary"
				}
			}).then((function(e) {
				$('#myModal').modal('hide');
				$('.modal-backdrop').hide();
				$("body").removeClass("modal-open");
				return false;
			}))
		}

		if(kuasa == "Ya" && pemberiKuasa == "")
		{
			Swal.fire({
				text: "Pemberi Kuasa Tidak Boleh Kosong !",
				icon: "error",
				buttonsStyling: !1,
				confirmButtonText: "Ok",
				customClass: {
					confirmButton: "btn btn-primary"
				}
			}).then((function(e) {
				$('#myModal').modal('hide');
				$('.modal-backdrop').hide();
				$("body").removeClass("modal-open");
				return false;
			}))
		}

		var data = signaturePad.toDataURL('image/jpeg');
		$('#myModal').modal('show').find('.modal-body').html('<h4>Apakah Anda Yakin ?</h4>	<textarea id="signature64" name="signed" style="display:none">'+data+'</textarea>');
	})
	})
    let handleSubmit = () => {
		if (signaturePad.isEmpty()) {
			Swal.fire({
				text: "Tanda Tangan Anda Kosong! Silahkan tanda tangan terlebih dahulu.",
				icon: "error",
				buttonsStyling: !1,
				confirmButtonText: "Ok",
				customClass: {
					confirmButton: "btn btn-primary"
				}
			}).then((function(e) {
				return false;
			}))

		}
		
		let pemberiKuasa = $('#pemberiKuasa').val()
		let kuasa = $('#kuasa').val()
		if(kuasa == "")
		{
			Swal.fire({
				text: "Surat Kuasa Wajib Di Isi",
				icon: "error",
				buttonsStyling: !1,
				confirmButtonText: "Ok",
				customClass: {
					confirmButton: "btn btn-primary"
				}
			}).then((function(e) {
				return false;
			}))
		}

		if(kuasa == "Ya" && pemberiKuasa == "")
		{
			Swal.fire({
				text: "Pemberi Kuasa Tidak Boleh Kosong !",
				icon: "error",
				buttonsStyling: !1,
				confirmButtonText: "Ok",
				customClass: {
					confirmButton: "btn btn-primary"
				}
			}).then((function(e) {
				return false;
			}))
		}

		var data = signaturePad.toDataURL('image/jpeg');
		alert("oke");
		$('#myModal').modal('show').find('.modal-body').html('<h4>Apakah Anda Yakin ?</h4>	<textarea id="signature64" name="signed" style="display:none">'+data+'</textarea>');
	}
</script>
<script>
	function disabledButton()
	{
		document.getElementById("SaveButton").disabled = true;
		$(".screen").show();
	}
</script>
<script>
	$(document).ready(function () 
	{
		$(".screen").hide();
	});
</script>
