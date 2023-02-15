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
					<a href="<?=base_url()?>" class="mb-12">
						<img alt="Logo" src="<?=base_url()?>/assets/media/logos/LogoHeader-1.png" class="h-150px" />
					</a>
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<div class="text-center mb-10">
							<h1 class="text-dark mb-3">Form Absensi Peserta</h1>
							<div class="text-gray-400 fw-bold fs-4">Selamat Datang
							<a href="<?=base_url()?>" class="link-primary fw-bolder">di Aplikasi eVote</a></div>
						</div>
						<div class="fv-row mb-10 autocompletenik">
							<label class="form-label fs-6 fw-bolder text-dark">NIK</label>
							<input class="form-control form-control-lg form-control-solid" type="text" name="nik" id="nik" />
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
							<input class="form-control form-control-lg form-control-solid" maxlength="6" type="text" name="otp"/>
						</div>
						<div class="fv-row mb-10">
							<label class="form-label fs-6 fw-bolder text-dark">Kode Kehadiran</label>
							<input class="form-control form-control-lg form-control-solid" type="text" maxlength="6" name="kodeKehadiran"/>
							<span class="form-text text-muted">Kosongkan Apabila Anggota Hadir Secara Online</span>
						</div>
						<div class="text-center">
							<button type="submit" id="kt_sign_in_submit" onclick="validateAbsen()" class="btn btn-lg btn-primary w-100 mb-5">
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
	function sendOTP()
	{
		var sendOTPURL = "<?=$sendOTPUrl;?>";	

		var nomorWhatsapp = document.querySelector("[name='kodeNegaraTelp']").value + document.querySelector("[name='nomorWhatsapp']").value;
		var nik = document.querySelector("[name='nik']").value;

		if(document.querySelector("[name='nomorWhatsapp']").value == "" || nik == "")
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

	function validateAbsen()
	{
		var validateAbsenUrl = "<?=$validateAbsenUrl;?>";
		var submitFormUrl = "<?=$submitFormUrl;?>";	

		var paramNik = document.querySelector("[name='nik']").value;
		var paramOtp = document.querySelector("[name='otp']").value;
		var paramkodeKehadiran = document.querySelector("[name='kodeKehadiran']").value;

		if(paramNik == "" || paramOtp == "")
		{
			Swal.fire({
						text: "NIK dan OTP Tidak Boleh Kosong",
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
				url: validateAbsenUrl,
				data: {
					otp: paramOtp,
					nik: paramNik,
					kodeKehadiran: paramkodeKehadiran
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
						}).then((function(e) {
								window.location.href = submitFormUrl;
                            }));
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
<script>
	function autocomplete(inp, arr) {
	  var currentFocus;
	  inp.addEventListener("input", function(e) {
	      var a, b, i, val = this.value, countValue = this.value.length;
		  if(countValue > 5)
	      {
		  closeAllLists();
		      if (!val) { return false;}
		  currentFocus = -1;
			  a = document.createElement("DIV");
		  a.setAttribute("id", this.id + "autocomplete-list");
		  a.setAttribute("class", "autocomplete-items");
		  this.parentNode.appendChild(a);
	          var inInput = "";   
		  for (i = 0; i < arr.length; i++) {
			inInput = (!arr[i]['nik']) ? "" : arr[i]['nik'];
			if (inInput.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
				b = document.createElement("DIV");
				b.innerHTML = "<strong>" + arr[i]['nik'].substr(0, val.length) + "</strong>";
				b.innerHTML += arr[i]['nik'].substr(val.length) + " - " + arr[i]['name'];
				b.innerHTML += "<input type='hidden' value='" + arr[i]['nik'] + "'>";
				b.addEventListener("click", function(e) {
				inp.value = this.getElementsByTagName("input")[0].value;
				closeAllLists();
				});
				a.appendChild(b);
			}
			}
	     }
	  });
	  function closeAllLists(elmnt) {
	    var x = document.getElementsByClassName("autocomplete-items");
	    for (var i = 0; i < x.length; i++) {
	      if (elmnt != x[i] && elmnt != inp) {
		x[i].parentNode.removeChild(x[i]);
	      }
	    }
	  }
	}

	var arrayPilihan = [
		{"nik":"610208", "name":"Erwin Rajab"},
		{"nik":"600861", "name":"Slamet Widodo"},
		{"nik":"600509", "name":"Zaimanir"},
		{"nik":"621076", "name":"DEDY KUSWARA"},
		{"nik":"623095", "name":"BACHTIAR EFFENDY"},
		{"nik":"631616", "name":"EYO SUNARYO"},
		{"nik":"650416", "name":"MUHAMMAD FAISAL NASUTION"},
		{"nik":"651146", "name":"RACHMAD KARTIKAHADI, IR.MT."},
		{"nik":"651232", "name":"BUSTANUL ARIFIN"},
		{"nik":"651240", "name":"AMSJARUDY"},
		{"nik":"660038", "name":"ENDANG BUDI SULISTYA DEWI"},
		{"nik":"660217", "name":"M.RAMAHER ASMANUDIN DAMANIK"},
		{"nik":"660218", "name":"B.JAKA SUPRIYANTO"},
		{"nik":"660253", "name":"ANWAR YAKE, IR."},
		{"nik":"660285", "name":"JULIETTA PANGARIBUAN, IR.MM."},
		{"nik":"660308", "name":"OHA"},
		{"nik":"660321", "name":"HENDRIESJAF ARIEF"},
		{"nik":"660330", "name":"ANAK AGUNG GEDE MAYUN WIR"},
		{"nik":"660368", "name":"JHON HENDRY"},
		{"nik":"660420", "name":"SISWANTO DASIJO"},
		{"nik":"660421", "name":"SUHARTONO"},
		{"nik":"660437", "name":"ARIF EFFENDI"},
		{"nik":"660443", "name":"L.Lydia Pinarsinta"},
		{"nik":"660445", "name":"MARFRIAN ZARDI"},
		{"nik":"660450", "name":"DONY ALFONSIUS NADAPDAP, IR."},
		{"nik":"670042", "name":"ERA KAMALI NASUTION"},
		{"nik":"670072", "name":"R.MAULUD SYAFAAT AHMAD ANWAR"},
		{"nik":"670145", "name":"FAJAR ERI DIANTO "},
		{"nik":"670205", "name":"AFIANTO MUKTI HARIBOWO"},
		{"nik":"670223", "name":"HEPTA YUNIARITA"},
		{"nik":"670242", "name":"MOHAMMAD UNTUNG RAHARDJO"},
		{"nik":"670244", "name":"HARIS HASAN ASYARI"},
		{"nik":"670307", "name":"PRAMASALEH HARIO U"},
		{"nik":"670341", "name":"BENEDICTUS HARJO BASKORO, IR.MT."},
		{"nik":"670432", "name":"ZULKARNAINI"},
		{"nik":"670483", "name":"FERINO"},
		{"nik":"670523", "name":"ELIAS PARDOMUAN SITUMEANG"},
		{"nik":"680140", "name":"ADDY KURNIA KOMARA"},
		{"nik":"680157", "name":"JODDY HERNADY"},
		{"nik":"680165", "name":"HERRY SARTONO HAMIDJAJA"},
		{"nik":"680169", "name":"SASMITO"},
		{"nik":"680174", "name":"DINOOR SUSATIJO"},
		{"nik":"680200", "name":"RUSLAN"},
		{"nik":"680202", "name":"Eryanto Setiadi"},
		{"nik":"680393", "name":"SUDARMAWAN"},
		{"nik":"680583", "name":"SUPRIYADI"},
		{"nik":"690019", "name":"MINARFA MUIS"},
		{"nik":"690059", "name":"MOHAMMAD IZZUDIN"},
		{"nik":"690067", "name":"ALDRIAN"},
		{"nik":"690163", "name":"HANAFI"},
		{"nik":"690241", "name":"RIDUAN TAMPUBOLON"},
		{"nik":"690242", "name":"SUHARNO"},
		{"nik":"690288", "name":"JONO"},
		{"nik":"690347", "name":"JONATHAN PATTI NASARANI"},
		{"nik":"690615", "name":"SOSIDAH"},
		{"nik":"700018", "name":"HENNY JULIASTUTI"},
		{"nik":"700067", "name":"SUDIRMAN"},
		{"nik":"700075", "name":"BUDI SETIAWAN"},
		{"nik":"700087", "name":"IMAM HAMBALI"},
		{"nik":"700089", "name":"IRWAN AZHARI GUMAY"},
		{"nik":"700130", "name":"DEDY SUTARDI"},
		{"nik":"700143", "name":"SADIYO"},
		{"nik":"700248", "name":"DEDI"},
		{"nik":"700323", "name":"EVAN HUTAJULU"},
		{"nik":"700333", "name":"NASOHAN"},
		{"nik":"700335", "name":"SARWIJI"},
		{"nik":"700501", "name":"ROSYANA"},
		{"nik":"700557", "name":"RUSDY SUGIH ALAM"},
		{"nik":"700607", "name":"WAGIYO"},
		{"nik":"700674", "name":"DEDY KURNIADHIE"},
		{"nik":"710010", "name":"SAEFUDIN"},
		{"nik":"710193", "name":"SYARIPUDDIN"},
		{"nik":"710201", "name":"SUTARTO"},
		{"nik":"710289", "name":"MOHAMAD DIMYATI"},
		{"nik":"710381", "name":"ISKANDAR SATYOGO PRASETYO"},
		{"nik":"710409", "name":"ARIEF RACHMATSJAH"},
		{"nik":"710413", "name":"WAHYU UTOMO"},
		{"nik":"710444", "name":"Arif Rachman"},
		{"nik":"710452", "name":"DONY SAVIUS"},
		{"nik":"710485", "name":"ASLAM"},
		{"nik":"710505", "name":"RUDIYANSYAH"},
		{"nik":"710511", "name":"HARY MAHENDRA EKA WIBAWA"},
		{"nik":"710517", "name":"DUDY SOLEHUDDIN"},
		{"nik":"710530", "name":"ADRIANSJAH NASUTION, BET.MSIS."},
		{"nik":"720090", "name":"SUTIKNO"},
		{"nik":"720187", "name":"BEKTI SUPRAYITNO"},
		{"nik":"720197", "name":"SONJA YVONE MOMUAT"},
		{"nik":"720241", "name":"ANDRI PRIHANANTO"},
		{"nik":"720252", "name":"TONY ADI WIBOWO"},
		{"nik":"720275", "name":"HERDI WIDIANTORO"},
		{"nik":"720294", "name":"I MADE ARYA SUDIARTANA"},
		{"nik":"720300", "name":"AHMAD ROSADI DJARKASIH"},
		{"nik":"720307", "name":"PRASETIYO RAHARJO"},
		{"nik":"720332", "name":"ARIWIATI"},
		{"nik":"720353", "name":"ARIS BACHTIAR"},
		{"nik":"720378", "name":"GDE ASBAWA PUTRA"},
		{"nik":"720414", "name":"WAHYONO"},
		{"nik":"720457", "name":"ANTONYUS GORGA MARTUA RADJA S."},
		{"nik":"720481", "name":"HIDAYAT"},
		{"nik":"720506", "name":"KOMANG BUDI ARYASA"},
		{"nik":"720513", "name":"IWAN SETIADINATA"},
		{"nik":"720523", "name":"DANDIT HARDIARTO"},
		{"nik":"720539", "name":"EDWIN PURWANDESI"},
		{"nik":"720543", "name":"DJUFRI ARDIAN"},
		{"nik":"720565", "name":"M. SATRIA KESUMA SIMBOLON"},
		{"nik":"720574", "name":"DAVID MARTIN"},
		{"nik":"720592", "name":"Adnan Sudrajat"},
		{"nik":"720603", "name":"DODY DJUNAEDI PRIATNA"},
		{"nik":"730006", "name":"FATMAWATY MUIS"},
		{"nik":"730100", "name":"AGUS UTORO"},
		{"nik":"730159", "name":"MILONO WAHYU WIBOWO, R."},
		{"nik":"730160", "name":"WAWAN ISKANDAR"},
		{"nik":"730200", "name":"MUNGKI SULISTIONO"},
		{"nik":"730229", "name":"WIDYA KRISTIANTO"},
		{"nik":"730269", "name":"MISNE ERAWATY"},
		{"nik":"730277", "name":"MUHAMAD NIKMATUDDIN"},
		{"nik":"730280", "name":"WAHYONO"},
		{"nik":"730331", "name":"DANNY ARIFIAN IDIARTO"},
		{"nik":"730347", "name":"NUR WAHID"},
		{"nik":"730349", "name":"ZUHED NUR"},
		{"nik":"730388", "name":"WIDYATMOKO"},
		{"nik":"730398", "name":"HARYO SANTOSO"},
		{"nik":"730403", "name":"FERIE CAHYADIE"},
		{"nik":"730406", "name":"KRISDIASTORO FX,ST"},
		{"nik":"730427", "name":"SRI SAFITRI"},
		{"nik":"730430", "name":"JERRY ALVIJANO HARJADI"},
		{"nik":"730431", "name":"LEONARD LOLO SUTARDODO PARAPAT"},
		{"nik":"730458", "name":"AGUS SULISTYO"},
		{"nik":"730472", "name":"ANTON WAHYU PRAMONO"},
		{"nik":"730483", "name":"TWINTO GANDIDI"},
		{"nik":"730505", "name":"ERWIN RISWANTORO"},
		{"nik":"730565", "name":"ACEP ARNA HIKMAT"},
		{"nik":"730573", "name":"EKO HARYONO"},
		{"nik":"730583", "name":"SETYAJI NAWANDONO"},
		{"nik":"730585", "name":"RADEN TOMI ARIYO TEJO"},
		{"nik":"730599", "name":"KASIONO"},
		{"nik":"740043", "name":"SRI LOKOPOLO"},
		{"nik":"740045", "name":"MADE TEJA BUANA"},
		{"nik":"740059", "name":"ARI KURNIAWAN, ST"},
		{"nik":"740066", "name":"EKA SETIAWAN, ST, MBIS"},
		{"nik":"740093", "name":"BUDI LISTIANA"},
		{"nik":"740108", "name":"I KETUT AGUNG ENRIKO"},
		{"nik":"740151", "name":"YONGKY HARIMURTI"},
		{"nik":"740155", "name":"DIDIK BUDI SANTOSO"},
		{"nik":"740165", "name":"EKO RUDI WIHARTONO"},
		{"nik":"740172", "name":"BAMBANG MUJIONO"},
		{"nik":"740175", "name":"DANIEL SYAFRIL"},
		{"nik":"740176", "name":"AMELIA YUDANINGRUM"},
		{"nik":"740181", "name":"REGINA LENGGOGENI"},
		{"nik":"740186", "name":"JEFFRY IRMAWAN"},
		{"nik":"740215", "name":"HARWISNU PAMUNGKAS"},
		{"nik":"740216", "name":"CHRISTIANUS ARDHI YUDANTO"},
		{"nik":"740225", "name":"SURYA RAHMADIANSYAH"},
		{"nik":"740248", "name":"MUHAMMAD RIZAL"},
		{"nik":"740274", "name":"FERDINAND SORITAN"},
		{"nik":"740295", "name":"SANTI WIDYASARI"},
		{"nik":"740315", "name":"SOEDARMANTO HARJONO"},
		{"nik":"750030", "name":"Tutut Vaty Husnawati"},
		{"nik":"750070", "name":"ELNOFIAN"},
		{"nik":"760042", "name":"FUSHENG MANRE, ST"},
		{"nik":"770002", "name":"DESY DWI PURNOMO"},
		{"nik":"770047", "name":"NISA TUNGGADEWI"},
		{"nik":"770060", "name":"DON FERNANDO"},
		{"nik":"770068", "name":"SELLY ROSALINE"},
		{"nik":"770069", "name":"FAUZI OKTRIYANDARU"},
		{"nik":"770079", "name":"MUHAMMAD QADRIANSYAH"},
		{"nik":"780051", "name":"GUNAWAN WASISTO CIPTANING ANDRI"},
		{"nik":"780060", "name":"MAS MOCHAMAD SHOHIFUDDIN"},
		{"nik":"780072", "name":"SAMUEL MAY RATIFIL"},
		{"nik":"790036", "name":"ANDRIYONO HUTAGALUNG"},
		{"nik":"790060", "name":"Dian Lestari"},
		{"nik":"790069", "name":"SARI WIMURTI"},
		{"nik":"790080", "name":"LAKSMI JUWITA"},
		{"nik":"790093", "name":"FAISAL BACHTIAR"},
		{"nik":"790121", "name":"R. KIKI ERIK HERMAYA"},
		{"nik":"800007", "name":"AWALUDIN"},
		{"nik":"800009", "name":"IRMIA DIESTAYANA NILAM SARI"},
		{"nik":"800036", "name":"AKAS TRIONO HADI"},
		{"nik":"800037", "name":"AKHMAD ZAIMI"},
		{"nik":"800042", "name":"FAJAR ARIEF NUGRAHA, ST."},
		{"nik":"800045", "name":"MARLINA"},
		{"nik":"800047", "name":"RAKHMAT FIRDAUS"},
		{"nik":"800048", "name":"JOKOADI WIBOWO"},
		{"nik":"800050", "name":"PURBO ASIH SAYEKTI"},
		{"nik":"800052", "name":"DANI PRASETIAWAN"},
		{"nik":"800061", "name":"DANANJAYA"},
		{"nik":"800062", "name":"DWINANTO BASKORO"},
		{"nik":"800067", "name":"DINA KUSUMA WAHYUNI"},
		{"nik":"800072", "name":"CAKRA TRIAJI"},
		{"nik":"800081", "name":"RANI WISHNU HENINGTYAS"},
		{"nik":"800102", "name":"SANDY ADISUTIYONO"},
		{"nik":"800110", "name":"SRI KUNTADI"},
		{"nik":"800112", "name":"FINKA MEIRISSA ANGGARINI"},
		{"nik":"800116", "name":"IRFAN BUDIMAN"},
		{"nik":"810007", "name":"RIZKIYANTO"},
		{"nik":"810036", "name":"HARRY ARIYAMANSYAH"},
		{"nik":"810038", "name":"SHINTA IRAWATI"},
		{"nik":"810039", "name":"BRIAN PRAKOSA"},
		{"nik":"810043", "name":"E. SITI MAEMUNAH"},
		{"nik":"810046", "name":"ALFERDIN"},
		{"nik":"810071", "name":"Farulina Diana Dewi"},
		{"nik":"810073", "name":"LIA SOVIA EKAWATI"},
		{"nik":"810076", "name":"MAULIZA"},
		{"nik":"810077", "name":"RULI HAKIM CAHYONO"},
		{"nik":"810079", "name":"Tubagus Arief Fahmi"},
		{"nik":"810100", "name":"DITA PUSPITASARI"},
		{"nik":"810102", "name":"DIANA SUTANTI"},
		{"nik":"820008", "name":"MUHAMMAD HAKY RUFIANTO"},
		{"nik":"820014", "name":"DEWI JUWITA"},
		{"nik":"820022", "name":"LELY DIANA"},
		{"nik":"820027", "name":"WAODE LAILA WAHYUNI"},
		{"nik":"820030", "name":"SANDHI PRIMAYUDI"},
		{"nik":"820059", "name":"ARIFIN SETIAWAN"},
		{"nik":"820070", "name":"NURIL EKA NOORLIANA"},
		{"nik":"820071", "name":"DEDEN MIFTAH PUSPANINGRAT"},
		{"nik":"820072", "name":"TAUFIQ NUGROHO"},
		{"nik":"820079", "name":"RONI SETYO WIBOWO"},
		{"nik":"820082", "name":"LOSYE RATIH FARASTUTI"},
		{"nik":"820083", "name":"WARDHANI PRIHARTIWI"},
		{"nik":"820086", "name":"INNEKE ADILLA PUSPITA"},
		{"nik":"820092", "name":"YULIA NOVIANTI"},
		{"nik":"830032", "name":"YUSFI ARDIANSYAH"},
		{"nik":"830038", "name":"ATIK ARIYANI"},
		{"nik":"830064", "name":"NOVITASARI KUSUMADEWI"},
		{"nik":"830074", "name":"ANDI RIZQI"},
		{"nik":"830081", "name":"ERVINA PRIYANTI"},
		{"nik":"830083", "name":"DYAH AYU PREWITANINGSIH"},
		{"nik":"830086", "name":"DITO BARATA JUNANTO"},
		{"nik":"830087", "name":"MAYRISA"},
		{"nik":"830088", "name":"RISKI AMALIAH"},
		{"nik":"830090", "name":"HOPY FAMILIANTO"},
		{"nik":"830098", "name":"NUNING YUNI WAHYUNINGTYAS"},
		{"nik":"830101", "name":"DIANA IMAWATI"},
		{"nik":"830127", "name":"MOCHAMAD TAUFAN AJI"},
		{"nik":"830133", "name":"SITI MAHMUDAH"},
		{"nik":"830136", "name":"ACHMAD KHALIF HAKIM"},
		{"nik":"830149", "name":"TANTRI ARMA FITRI"},
		{"nik":"830156", "name":"ANDJAS WAHYU ARDIANSYAH"},
		{"nik":"840002", "name":"ROHMAT HIDAYAT"},
		{"nik":"840020", "name":"HENDRA SATRIA NUSAPUTRA"},
		{"nik":"840051", "name":"DARU PUSPITANINGRUM"},
		{"nik":"840066", "name":"Sendylenvi Regia"},
		{"nik":"840091", "name":"SYAFUAN"},
		{"nik":"840098", "name":"ADRIAN INDRA RAHMAWAN"},
		{"nik":"840104", "name":"KHRISNA DINI YUNITA SARI"},
		{"nik":"840109", "name":"YUSTINUS JUNIAWAN NUGROHO"},
		{"nik":"840118", "name":"NI LUH PUTU AGUSTINI SWASTI"},
		{"nik":"840120", "name":"MAS MOCHAMAD GUS NURULLAH"},
		{"nik":"840132", "name":"BERNADETTA RARAS INDAH R"},
		{"nik":"840135", "name":"TOUFIK GOZALI"},
		{"nik":"840147", "name":"AGUS SRI BUDI CAHYONO"},
		{"nik":"840162", "name":"IRMA NUR RAHMAWATI"},
		{"nik":"840173", "name":"MOFREN H. DAMANIK"},
		{"nik":"840177", "name":"ARIF RACHMAN YULLIANDI"},
		{"nik":"840183", "name":"AAN YULIA LUFTI"},
		{"nik":"840190", "name":"ANTO MARTUA CHRISTIAN SIHOMBING"},
		{"nik":"850072", "name":"ROMAULI SITINJAK"},
		{"nik":"850075", "name":"Farida Kartika Sari"},
		{"nik":"850093", "name":"DHIAANI ZAHRA"},
		{"nik":"850100", "name":"FITRILIANI HAYU PUSPASARI"},
		{"nik":"850102", "name":"AGUSTINA WULANDARI"},
		{"nik":"850106", "name":"RIZKIANA AMALIA"},
		{"nik":"850109", "name":"ERNA DWIYANTI"},
		{"nik":"850111", "name":"LINDA HIMAWATI"},
		{"nik":"850134", "name":"AKHMAD DENIAR PERDANA K"},
		{"nik":"850138", "name":"HAJAR NURI FIBRIYANTI"},
		{"nik":"850165", "name":"R EKO PERMONO JATI"},
		{"nik":"850167", "name":"WIDYA HAPSARI CHAERANI"},
		{"nik":"860056", "name":"RANY AULIA PARAMITHA"},
		{"nik":"860063", "name":"FEBRIAN SETIADI"},
		{"nik":"860066", "name":"NUGRAHA HADI WIBAWA"},
		{"nik":"860081", "name":"ANISA YUSTIKASARI"},
		{"nik":"860095", "name":"DEWI RISTIASSARI"},
		{"nik":"860101", "name":"SARAH RASYIDAH"},
		{"nik":"860104", "name":"CITA NURANI LESTARI"},
		{"nik":"860132", "name":"ROSMA FEBRI DIANDARI"},
		{"nik":"860141", "name":"RANI AGUSTIANI "},
		{"nik":"860148", "name":"AZMAN NURGOZALI"},
		{"nik":"870002", "name":"AKHMAD ARYANDI"},
		{"nik":"870009", "name":"YULIATI ATHIAH"},
		{"nik":"870010", "name":"AFIS HERMAN REZA DEVARA"},
		{"nik":"870026", "name":"ARIEF ADHIYANTO KUSUMO PUTRO"},
		{"nik":"870037", "name":"KARTIKA DWI AYUNINGTIAS"},
		{"nik":"870041", "name":"RONA FAJAR IMANSYAH"},
		{"nik":"870044", "name":"ERVIANTI RIZQIA"},
		{"nik":"870048", "name":"ELVA APULINA BR SITEPU"},
		{"nik":"870052", "name":"VANI RAKHMAWATI"},
		{"nik":"870053", "name":"ALDI AFRIANSYAH"},
		{"nik":"880004", "name":"INTAN YUSANTINA CALVIANTY"},
		{"nik":"880012", "name":"FEBTRIANY"},
		{"nik":"880026", "name":"HANUNG TYAS SAKSONO"},
		{"nik":"880037", "name":"NAILA FITRIA"},
		{"nik":"880038", "name":"ILHAM ANANTO YUWONO"},
		{"nik":"880043", "name":"DESITA MUSTIKANINGRUM"},
		{"nik":"880059", "name":"PRAMESTI PUJI LESTARI"},
		{"nik":"890006", "name":"MARIANA"},
		{"nik":"890007", "name":"FAIZAL ADI WARDANA"},
		{"nik":"890010", "name":"AFRIZILLA YULIKA HANIFAH"},
		{"nik":"890012", "name":"DONNY RIDO SUHADA"},
		{"nik":"890020", "name":"RAGIL WIDIHARSO"},
		{"nik":"890030", "name":"GEDE DOKO HARIKUSUMA"},
		{"nik":"890033", "name":"Fahmi Rahmadani"},
		{"nik":"890038", "name":"FADEL RANDIA"},
		{"nik":"890041", "name":"HAFIDH AL AFIF"},
		{"nik":"890067", "name":"ARFIYAH CITRA EKA DEWI"},
		{"nik":"890084", "name":"Achmad Hadi"},
		{"nik":"900016", "name":"Mukhamad Ifanto"},
		{"nik":"900046", "name":"STEVANY PRIESCILA PALILU"},
		{"nik":"900104", "name":"Carine Wulandari Prasetyowati"},
		{"nik":"900121", "name":"REZA DWI PERMANA"},
		{"nik":"900141", "name":"ANDI AULIA SABRI"},
		{"nik":"910010", "name":"SITI NURJAMILLAH"},
		{"nik":"910023", "name":"MOCHAMAD GANI AMRI"},
		{"nik":"910071", "name":"ANINDITA PRITA DWIPUTRI"},
		{"nik":"910080", "name":"DYANG INTAN MEIDIATY"},
		{"nik":"910085", "name":"AMIEN KARIM"},
		{"nik":"910129", "name":"GAMA BISMATAMA PRASETYO"},
		{"nik":"910133", "name":"VONDA BRI VALDO ARY"},
		{"nik":"910216", "name":"JESSICA ADELAIDE GUSTI"},
		{"nik":"910235", "name":"HENDRY PEBRIANSYAH"},
		{"nik":"920008", "name":"DIKA SWADANI"},
		{"nik":"920011", "name":"I GUSTI AGUNG AYU MADE SIASTIKA INKASARI"},
		{"nik":"920081", "name":"HASYIM YUSUF ASJARI"},
		{"nik":"920209", "name":"QOLIQINA ZOLLA SABRINA"},
		{"nik":"920234", "name":"ANDREW SETIAWAN TARIGAN"},
		{"nik":"920255", "name":"HARTANTO PRABOWO"},
		{"nik":"920267", "name":"Bondan Bhaskara"},
		{"nik":"920304", "name":"REZA AKHMAD GANDARA"},
		{"nik":"920316", "name":"Yudha Ryandieka"},
		{"nik":"920341", "name":"AL BUKHARI PAHLEVI"},
		{"nik":"930011", "name":"Dhika Febrianov"},
		{"nik":"930014", "name":"Evan Naratama"},
		{"nik":"930113", "name":"Doni Imam Bahtiar"},
		{"nik":"930146", "name":"Mentari Nur Fajrin"},
		{"nik":"930156", "name":"ANTON SUHARTONO"},
		{"nik":"930162", "name":"Muhammad Fadhil"},
		{"nik":"930185", "name":"ZETIL HIKMAH"},
		{"nik":"930190", "name":"Muhammad Mizan Ghifari"},
		{"nik":"930212", "name":"AHYAD ROSYADA JORDIAWAN"},
		{"nik":"930213", "name":"ANINDITA PUTRI APRILIANI"},
		{"nik":"930225", "name":"HERBANU MAHARINDRO"},
		{"nik":"930232", "name":"NANDA SEPTIANA"},
		{"nik":"930238", "name":"Rian Widyatomo"},
		{"nik":"930241", "name":"MUHAMMAD FARIZKO NURDITAMA"},
		{"nik":"930247", "name":"Nurman Wibisana"},
		{"nik":"930256", "name":"Iman Muhamad Ramadhan"},
		{"nik":"930265", "name":"NUR FITRI APRILIA"},
		{"nik":"930382", "name":"IKHWAN REZA"},
		{"nik":"930393", "name":"ASTRID ARDIANI"},
		{"nik":"940002", "name":"BIMO EKA PUTRA"},
		{"nik":"940013", "name":"DINARYATI AMINDA"},
		{"nik":"940037", "name":"WULAN NURHIDAYAH"},
		{"nik":"940039", "name":"Himawan Adi Prakosa"},
		{"nik":"940078", "name":"TESAR DAYANSYAH"},
		{"nik":"940085", "name":"MUHAMMAD IQBAL"},
		{"nik":"940088", "name":"IQBAL HANIF"},
		{"nik":"940116", "name":"CORNELIA HEMA RETNANDA"},
		{"nik":"940133", "name":"Anisa Lutfiana"},
		{"nik":"940161", "name":"TANTRI MAWARSIH"},
		{"nik":"940173", "name":"Ratih Ayu Indraswari"},
		{"nik":"940175", "name":"Amirsyah Rayhan Mubarak"},
		{"nik":"940178", "name":"SANDRA PUTERI YOHANI"},
		{"nik":"940193", "name":"Agung Prasetiyo"},
		{"nik":"940203", "name":"FARHANA IRMADELA ERDIA"},
		{"nik":"940261", "name":"SARAH NITALYA BAKARA"},
		{"nik":"950018", "name":"Rya Sofi Aulia"},
		{"nik":"950037", "name":"DWI HANDAYANI"},
		{"nik":"950050", "name":"GALIH PANGESTI"},
		{"nik":"950089", "name":"Faiz burhanuddin ramdhani"},
		{"nik":"950137", "name":"LARAS ADHIANTI"},
		{"nik":"950176", "name":"DYLAN MAHESA ANGGASTA"},
		{"nik":"950237", "name":"DARISA SYAHRINI"},
		{"nik":"950263", "name":"SYAHRUL RASYID"},
		{"nik":"960004", "name":"Suadev Prashant Mahasagara"},
		{"nik":"960087", "name":"ADITA DHIRA NARESWARI"},
		{"nik":"730038", "name":"RIZA A.N RUKMANA"},
		{"nik":"780048", "name":"ABDUL GHONY"},
		{"nik":"920250", "name":"ERFAN SOFHA"},
		{"nik":"920225", "name":"RAHADIAN FARIZI"},
		{"nik":"920097", "name":"BELLA DWI JAYANTI"},
		{"nik":"900060", "name":"GST. NGURAH ANDIKA PRAMUDYA"},
		{"nik":"910186", "name":"ARIF FAJARUDDIN"},
		{"nik":"720576", "name":"ROSLINAWATI"},
		{"nik":"710404", "name":"IRSYAD ILYAS"},
		{"nik":"970119", "name":"JANAH EKA WIDIARNI"},
		{"nik":"950342", "name":"ANANTASSA FITRI ANDINI"},
		{"nik":"960196", "name":"WEDAR PANJI MARDYANINGSIH"},
		{"nik":"960199", "name":"HEPTA SEPTIANI"},
		{"nik":"950476", "name":"Andre Rizki Dewo Nugroho"},
		{"nik":"950395", "name":"Muhammad Isradi Azhar"},
		{"nik":"880018", "name":"Irvan Supradana"},
		{"nik":"940120", "name":"BASKARA WIDHI JAYANTA"},
		{"nik":"760053", "name":"Wisdarmanto Erlangga"},
		{"nik":"970101", "name":"CLARA DEWANTI"},
		{"nik":"820077", "name":"Dwi Anggreni"},
		{"nik":"930463", "name":"KHAIRUNNISA"},
		{"nik":"930205", "name":"Pricilla Maria Krisna Violetta"},
		{"nik":"910277", "name":"Alvin Natanael"},
		{"nik":"950355", "name":"Ade Vreyyuning Monika"},
		{"nik":"840043", "name":"Andri Sembiring"},
		{"nik":"740142", "name":"Arif Swasono"},
		{"nik":"740091", "name":"Ermono Liman Prabowo"},
		{"nik":"980113", "name":"Timothy Elia Tallulembang"},
		{"nik":"700669", "name":"Nur Afandi"},
		{"nik":"950047", "name":"SYAMSUL HIDAYAT"},
		{"nik":"940427", "name":"YULITA AYU RENGGANIS"},
		{"nik":"960260", "name":"ALVINA RAHMATIANA SARI"},
		{"nik":"960062", "name":"Theresia Vania Hamolin"},
		{"nik":"940124", "name":"REZA ADITYA PRATAMA"},
		{"nik":"960282", "name":"Fanny Istifadah"},
		{"nik":"810083", "name":"RAHMI MULIANA"},
		{"nik":"930439", "name":"GITA PUSPITA SIKNUN"},
		{"nik":"960161", "name":"DEILLA TSAMROTUL FUADAH"},
		{"nik":"970088", "name":"AHMAD WAHRUDIN"},
		{"nik":"970154", "name":"RIZKIANA RANI SEJAHTERA"},
		{"nik":"970126", "name":"MAULANA FALITHURRAHMAN"},
		{"nik":"850186", "name":"Desi Pramudiwati"},
		{"nik":"940200", "name":"ALIFIYAH PRATIWI P WEDDA"},
		{"nik":"890087", "name":"Hayudya Witasari"},
		{"nik":"970236", "name":"ROBBY SYAIFULLAH"},
		{"nik":"760035", "name":"ADITYA INDRAWAN"},
		{"nik":"840076", "name":"ADDRIB LEPONG BULAN"}
	];

	autocomplete(document.getElementById("nik"), arrayPilihan);
</script>
