<!DOCTYPE html>
<html lang="en">
	<head><base href="../../../">
	    	<title><?= getenv('applicationName')." | Login" ?></title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="<?=base_url()?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url()?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="bg-body">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(<?=base_url()?>/assets/media/illustrations/sketchy-1/14.png">
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<a href="<?=base_url()?>" class="mb-12">
						<img alt="Logo" src="<?=base_url()?>/assets/media/logos/LogoHeader.png" class="h-150px" />
					</a>
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<div class="text-center mb-10">
							<h1 class="text-dark mb-3">Form Absensi Peserta</h1>
							<div class="text-gray-400 fw-bold fs-4">Selamat Datang
							<a href="<?=base_url()?>" class="link-primary fw-bolder">di Aplikasi eVote</a></div>
						</div>
						<div class="fv-row mb-10">
							<label class="form-label fs-6 fw-bolder text-dark">NIK</label>
							<input class="form-control form-control-lg form-control-solid" type="text" name="nik" autocomplete="off" />
						</div>
						<div class="fv-row mb-10">
							<div class="d-flex flex-stack mb-2">
								<label class="form-label fw-bolder text-dark fs-6 mb-0">Nomor Whatsapp</label>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<select class="form-control form-control-lg form-control-solid" name="kodeNegaraTelp">
										<option value = '62'>+ 62<option>
										<option value = '93'>+ 93<option>
										<option value = '27'>+ 27<option>
										<option value = '236'>+ 236<option>
										<option value = '355'>+ 355<option>
										<option value = '213'>+ 213<option>
										<option value = '1'>+ 1<option>
										<option value = '376'>+ 376<option>
										<option value = '244'>+ 244<option>
										<option value = '1-268+ '>1-268<option>
										<option value = '966'>+ 966<option>
										<option value = '54'>+ 54<option>
										<option value = '374'>+ 374<option>
										<option value = '61'>+ 61<option>
										<option value = '43'>+ 43<option>
										<option value = '994'>+ 994<option>
										<option value = '1-242+ '>1-242<option>
										<option value = '973'>+ 973<option>
										<option value = '880'>+ 880<option>
										<option value = '1-246+ '>1-246<option>
										<option value = '31'>+ 31<option>
										<option value = '375'>+ 375<option>
										<option value = '32'>+ 32<option>
										<option value = '501'>+ 501<option>
										<option value = '229'>+ 229<option>
										<option value = '975'>+ 975<option>
										<option value = '591'>+ 591<option>
										<option value = '387'>+ 387<option>
										<option value = '267'>+ 267<option>
										<option value = '55'>+ 55<option>
										<option value = '44'>+ 44<option>
										<option value = '673'>+ 673<option>
										<option value = '359'>+ 359<option>
										<option value = '226'>+ 226<option>
										<option value = '257'>+ 257<option>
										<option value = '420'>+ 420<option>
										<option value = '235'>+ 235<option>
										<option value = '56'>+ 56<option>
										<option value = '86'>+ 86<option>
										<option value = '45'>+ 45<option>
										<option value = '253'>+ 253<option>
										<option value = '1-767+ '>1-767<option>
										<option value = '593'>+ 593<option>
										<option value = '503'>+ 503<option>
										<option value = '291'>+ 291<option>
										<option value = '372'>+ 372<option>
										<option value = '251'>+ 251<option>
										<option value = '679'>+ 679<option>
										<option value = '63'>+ 63<option>
										<option value = '358'>+ 358<option>
										<option value = '241'>+ 241<option>
										<option value = '220'>+ 220<option>
										<option value = '995'>+ 995<option>
										<option value = '233'>+ 233<option>
										<option value = '1-473+ '>1-473<option>
										<option value = '502'>+ 502<option>
										<option value = '224'>+ 224<option>
										<option value = '245'>+ 245<option>
										<option value = '240'>+ 240<option>
										<option value = '592'>+ 592<option>
										<option value = '509'>+ 509<option>
										<option value = '504'>+ 504<option>
										<option value = '36'>+ 36<option>
										<option value = '852'>+ 852<option>
										<option value = '91'>+ 91<option>											
										<option value = '964'>+ 964<option>
										<option value = '98'>+ 98<option>
										<option value = '353'>+ 353<option>
										<option value = '354'>+ 354<option>
										<option value = '972'>+ 972<option>
										<option value = '39'>+ 39<option>
										<option value = '1-876+ '>1-876<option>
										<option value = '81'>+ 81<option>
										<option value = '49'>+ 49<option>
										<option value = '962'>+ 962<option>
										<option value = '855'>+ 855<option>
										<option value = '237'>+ 237<option>
										<option value = '1'>+ 1<option>
										<option value = '7'>+ 7<option>
										<option value = '254'>+ 254<option>
										<option value = '996'>+ 996<option>
										<option value = '686'>+ 686<option>
										<option value = '57'>+ 57<option>
										<option value = '269'>+ 269<option>
										<option value = '243'>+ 243<option>
										<option value = '82'>+ 82<option>
										<option value = '850'>+ 850<option>
										<option value = '506'>+ 506<option>
										<option value = '385'>+ 385<option>
										<option value = '53'>+ 53<option>
										<option value = '965'>+ 965<option>
										<option value = '856'>+ 856<option>
										<option value = '371'>+ 371<option>
										<option value = '961'>+ 961<option>
										<option value = '266'>+ 266<option>
										<option value = '231'>+ 231<option>
										<option value = '218'>+ 218<option>
										<option value = '423'>+ 423<option>
										<option value = '370'>+ 370<option>
										<option value = '352'>+ 352<option>
										<option value = '261'>+ 261<option>
										<option value = '853'>+ 853<option>
										<option value = '389'>+ 389<option>
										<option value = '960'>+ 960<option>
										<option value = '265'>+ 265<option>
										<option value = '60'>+ 60<option>
										<option value = '223'>+ 223<option>
										<option value = '356'>+ 356<option>
										<option value = '212'>+ 212<option>
										<option value = '692'>+ 692<option>
										<option value = '222'>+ 222<option>
										<option value = '230'>+ 230<option>
										<option value = '52'>+ 52<option>
										<option value = '20'>+ 20<option>
										<option value = '691'>+ 691<option>
										<option value = '373'>+ 373<option>
										<option value = '377'>+ 377<option>
										<option value = '976'>+ 976<option>
										<option value = '382'>+ 382<option>
										<option value = '258'>+ 258<option>
										<option value = '95'>+ 95<option>
										<option value = '264'>+ 264<option>
										<option value = '674'>+ 674<option>
										<option value = '977'>+ 977<option>
										<option value = '227'>+ 227<option>
										<option value = '234'>+ 234<option>
										<option value = '505'>+ 505<option>
										<option value = '47'>+ 47<option>
										<option value = '968'>+ 968<option>
										<option value = '92'>+ 92<option>
										<option value = '680'>+ 680<option>
										<option value = '507'>+ 507<option>
										<option value = '225'>+ 225<option>
										<option value = '675'>+ 675<option>
										<option value = '595'>+ 595<option>
										<option value = '33'>+ 33<option>
										<option value = '51'>+ 51<option>
										<option value = '48'>+ 48<option>
										<option value = '351'>+ 351<option>
										<option value = '974'>+ 974<option>
										<option value = '242'>+ 242<option>
										<option value = '1-809+ ; 1-829'>1-809; 1-829<option>
										<option value = '40'>+ 40<option>
										<option value = '7'>+ 7<option>
										<option value = '250'>+ 250<option>
										<option value = '1-869+ '>1-869<option>
										<option value = '1-758+ '>1-758<option>
										<option value = '1-784+ '>1-784<option>
										<option value = '685'>+ 685<option>
										<option value = '378'>+ 378<option>
										<option value = '239'>+ 239<option>
										<option value = '64'>+ 64<option>
										<option value = '221'>+ 221<option>
										<option value = '381'>+ 381<option>
										<option value = '248'>+ 248<option>
										<option value = '232'>+ 232<option>
										<option value = '65'>+ 65<option>
										<option value = '357'>+ 357<option>
										<option value = '386'>+ 386<option>
										<option value = '421'>+ 421<option>
										<option value = '677'>+ 677<option>
										<option value = '252'>+ 252<option>
										<option value = '34'>+ 34<option>
										<option value = '94'>+ 94<option>
										<option value = '249'>+ 249<option>
										<option value = '211'>+ 211<option>
										<option value = '963'>+ 963<option>
										<option value = '597'>+ 597<option>
										<option value = '268'>+ 268<option>
										<option value = '46'>+ 46<option>
										<option value = '41'>+ 41<option>
										<option value = '992'>+ 992<option>
										<option value = '238'>+ 238<option>
										<option value = '255'>+ 255<option>
										<option value = '886'>+ 886<option>
										<option value = '66'>+ 66<option>
										<option value = '670'>+ 670<option>
										<option value = '228'>+ 228<option>
										<option value = '676'>+ 676<option>
										<option value = '1-868+ '>1-868<option>
										<option value = '216'>+ 216<option>
										<option value = '90'>+ 90<option>
										<option value = '993'>+ 993<option>
										<option value = '688'>+ 688<option>
										<option value = '256'>+ 256<option>
										<option value = '380'>+ 380<option>
										<option value = '971'>+ 971<option>
										<option value = '598'>+ 598<option>
										<option value = '998'>+ 998<option>
										<option value = '678'>+ 678<option>
										<option value = '58'>+ 58<option>
										<option value = '84'>+ 84<option>
										<option value = '967'>+ 967<option>
										<option value = '30'>+ 30<option>
										<option value = '260'>+ 260<option>
										<option value = '263'>+ 263<option>
									</select>
								</div>
								<div class="col-sm-5">
									<input class="form-control form-control-lg form-control-solid" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" type="text" name="nomorWhatsapp" />
								</div>
								<div class="col-sm-4">
									<button type="submit" onclick="sendOTP()" class="btn btn-lg btn-primary w-100 mb-5">
										<span class="indicator-label">Kirim OTP</span>
									</button>
								</div>
							</div>
						</div>
						<div class="fv-row mb-10">
							<label class="form-label fs-6 fw-bolder text-dark">Kode OTP</label>
							<input class="form-control form-control-lg form-control-solid" type="text" name="otp"/>
						</div>
						<div class="text-center">
							<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
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
		<script src="<?=base_url()?>/assets/plugins/global/plugins.bundle.js"></script>
	</body>
</html>

<script>
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