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
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(<?=base_url()?>/assets/media/illustrations/dozzy-1/14.png">
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<img alt="Logo" src="<?=base_url()?>/assets/media/logos/sukses.png"/>
					<a href="<?= base_url()?>" class="btn btn-primary">Kembali</a>
				</div>
				<div class="d-flex flex-center flex-column-auto p-10">
					<div class="d-flex align-items-center fw-bold fs-6">
					</div>
				</div>
			</div>
		</div>
		<script src="<?=base_url()?>/assets/plugins/global/plugins.bundle.js"></script>
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
	});
</script>
