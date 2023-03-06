<!DOCTYPE html>
<html lang="en">
	<head><base href="../../../">
	    <title><?= getenv('applicationName')." | Form Absensi Peserta" ?></title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="<?=base_url()?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url()?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
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
			
			.autocompletenik {
				position: relative;
			}
			
			.autocompletenik-items div {
				padding: 10px;
				cursor: pointer;
			}

		</style>
	</head>
	<body id="kt_body" class="bg-body">
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
		<form action="<?= $submitFormUrl ?>" method="post">
			<div class="d-flex flex-column flex-root">
				<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(<?=base_url()?>/assets/media/illustrations/dozzy-1/14.png">
					<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
						<a href="<?=base_url()?>" class="mb-12">
							<img alt="Logo" src="<?=base_url()?>/assets/media/logos/LogoHeader-1.png" class="h-150px" />
						</a>
						<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
							<div class="text-center mb-10">
								<h1 class="text-dark mb-3">Form Absensi Peserta</h1>
								<div class="text-gray-400 fw-bold fs-4">Selamat Datang
								<a href="<?=base_url()?>" class="link-primary fw-bolder">di Aplikasi eVote</a></div>
							</div>
							
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Type Kehadiran</label>
								<select class="form-control" name="typeKehadiran" id="typeKehadiran" required>
									<option value="">Pilih Type Kehadiran</option>
									<option value="Offline">Offline</option>
									<option value="Online">Online</option>
								</select>
							</div>
							<div class="fv-row mb-10" id="rowKodeKehadiran" style="display :none;">
								<label class="form-label fs-6 fw-bolder text-dark">Kode Kehadiran</label>
								<input class="form-control form-control-lg" type="text" maxlength="6" id="kodeKehadiran" name="kodeKehadiran"/>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
									<span class="indicator-label">Konfirmasi</span>
									<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
							</div>
						</div>
					</div>
					<div class="d-flex flex-center flex-column-auto p-10">
						<div class="d-flex align-items-center fw-bold fs-6">
						</div>
					</div>
				</div>
			</div>
		</form>
		<script src="<?=base_url()?>/assets/plugins/global/plugins.bundle.js"></script>

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
		
		<?php if (!empty(session()->getFlashdata('successMessage')) ) : ?>
			<script>
				pesan = "<?= session()->getFlashdata('successMessage'); ?>";
				
				Swal.fire({
					text: pesan,
					icon: "success",
					buttonsStyling: !1,
					confirmButtonText: "Ok",
					customClass: {
						confirmButton: "btn btn-primary"
					}
				})
			</script>
		<?php endif; ?>
	</body>
</html>

<script>
	$(document).ready(function () 
	{
		$(".screen").hide();
		$(document).ajaxStart(function()
		{
			$(".screen").show();
		});

		$(document).ajaxStop(function()
		{
			$(".screen").hide();
		});

		$('#typeKehadiran').on('change', function(){
			var paramType = $(this).val();

			if(paramType == "Offline")
			{
				$('#rowKodeKehadiran').show(500)
				$('#kodeKehadiran').prop('required',true);
			}
			else
			{
				$('#rowKodeKehadiran').hide(500)
				$('#kodeKehadiran').prop('required',false);
			}
		})
	});
</script>
