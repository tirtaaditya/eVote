<!DOCTYPE html>
<html lang="en">
	<head><base href="../../../">
	    	<title><?= getenv('applicationName')." | Login" ?></title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="<?=base_url()?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url()?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
        <style type="text/css">
        	.signature-pad{
        		border: 1px solid #ccc;
        		border-radius: 5px;
        		width: 100%;
        		height: 260px;
        	}
        </style>
	</head>
	<form method="post" action="<?= $postbackURL  ?>" enctype="multipart/form-data">
		<body id="kt_body" class="bg-body">
			<div class="d-flex flex-column flex-root">
				<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(<?=base_url()?>/assets/media/illustrations/sketchy-1/14.png">                
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
								<input class="form-control form-control-lg form-control-solid" type="File" id="document" name="document" autocomplete="off" />
							</div>
							<center>
								<button class="btn btn-primary" type="submit">Submit</button>
							</center>
						</div>
					</div>
					<div class="d-flex flex-center flex-column-auto p-10">
						<div class="d-flex align-items-center fw-bold fs-6">
						</div>
					</div>
				</div>
			</div>
		</form>
			
			<!-- Javascript -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
				<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
				<script src="<?=base_url()?>/assets/plugins/global/plugins.bundle.js"></script>
		</body>
	</form>
</html>

<script type="text/javascript">
	var canvas = document.getElementById('signature-pad');
	// Adjust canvas coordinate space taking into account pixel ratio,
	// to make it look crisp on mobile devices.
	// This also causes canvas to be cleared.
	function resizeCanvas() {
		// When zoomed out to less than 100%, for some very strange reason,
		// some browsers report devicePixelRatio as less than 1
		// and only part of the canvas is cleared then.
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


		// $('#submit').submit(function(e){
		// 	e.preventDefault();

		// 	document.getElementById('save-png').addEventListener('click', function () {
		// 	if (signaturePad.isEmpty()) {
		// 		alert("Tanda Tangan Anda Kosong! Silahkan tanda tangan terlebih dahulu.");
		// 	}else{
		// 		var data = signaturePad.toDataURL('image/png');
		// 		console.log(data);
		// 		$('#myModal').modal('show').find('.modal-body').html('<h4>Format .PNG</h4><img src="'+data+'"><textarea id="signature64" name="signed" style="display:none">'+data+'</textarea>');
		// 	}
		// 	});
		// 	// data =  new FormData(this)
		// 		$.ajax({
		// 			url:'<?php echo base_url();?>/submit',
		// 			type:"post",
		// 			data:new FormData(this),
		// 			processData:false,
		// 			contentType:false,
		// 			cache:false,
		// 			async:false,
		// 			success: function(data){
		// 				alert("Upload Image Berhasil.");
		// 		}
		// 		});
        // });
	})

	function sendOTP()
	{
		var sendOTPURL = "<?=$sendOTPUrl;?>";

		var nomorWhatsapp = document.querySelector("[name='kodeNegaraTelp']").value + document.querySelector("[name='nomorWhatsapp']").value;
		var nik = document.querySelector("[name='nik']").value;

		if(nomorWhatsapp == "" || nik == "")
		{
			Swal.fire({
						text: "NIK dan Nomor Whatsapp Tidak Boleh Kosong",
						icon: "error",
						buttonsStyling: !1,
						confirmButtonText: "Ok",
						customClass: {
							confirmButton: "btn btn-primary"
						}
					});
		}
		else
		{
			$.ajax({
				type: "POST",
				url: sendOTPURL,
				data: {
					nomorWhatsapp: nomorWhatsapp,
					nik: nik
				},
				dataType: 'JSON',
				success: function (result) {
					if(result.code == "00")
					{
						Swal.fire({
							text: result.message,
							icon: "success",
							buttonsStyling: !1,
							confirmButtonText: "Ok",
							customClass: {
								confirmButton: "btn btn-primary"
							}
						});
					}
					else
					{
						Swal.fire({
								text: result.message,
								icon: "error",
								buttonsStyling: !1,
								confirmButtonText: "Ok",
								customClass: {
									confirmButton: "btn btn-primary"
								}
							});
					}
				}
			});
		}		
	}
</script>