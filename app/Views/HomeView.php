<?php 
$user = session('user');
if($user['role'] !== 'Voters') { ?>
    <div class="row gy-5 g-xl-8">
        <div class="col-xxl-4">
            <div class="card card-xxl-stretch">
                <div class="card-header border-0 bg-danger py-5">
                    <h3 class="card-title fw-bolder text-white">Tautan Cepat</h3>
                    <div class="card-toolbar">
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class=" card-rounded-bottom bg-danger" data-kt-color="danger" style="height: 200px"></div>
                    <div class="card-p mt-n20 position-relative">
                        <div class="row g-0">
                            <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                                        <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                                        <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                                        <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
                                    </svg>
                                </span>
                                <a href="<?=base_url();?>/votes/hasil" class="text-warning fw-bold fs-6">Hasil Pemilihan</a>
                            </div>
                            <div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
                                </svg>
                                </span>
                                <a href="<?=base_url();?>/users/voters" class="text-primary fw-bold fs-6">Voters</a>
                            </div>
                        </div>
                        <div class="row g-0">
                            <div class="col bg-light-danger px-6 py-8 rounded-2 me-7">
                                <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black" />
                                        <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black" />
                                    </svg>
                                </span>
                                <a href="<?=base_url();?>/votes/daftar" class="text-danger fw-bold fs-6 mt-2">Daftar Pemilihan</a>
                            </div>
                            <div class="col bg-light-success px-6 py-8 rounded-2">
                                <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black" />
                                        <path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="black" />
                                    </svg>
                                </span>
                                <a href="<?=base_url();?>/audit/kesalahansistem" class="text-success fw-bold fs-6 mt-2">Laporan Bugs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4">
            <div class="card card-xxl-stretch">
                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="fw-bolder mb-2 text-dark">Aktivitas Hari Ini</span>
                    </h3>
                    
                </div>
                <div class="card-body pt-5">
                    <div class="timeline-label">
                        <?php
                            foreach ($activity as $key => $value) 
                            {
                                $time = date("H:i", strtotime($value['created_on']));

                                echo "<div class='timeline-item'>";
                                echo "<div class='timeline-label fw-bolder text-gray-800 fs-6'>$time</div>";
                                echo "<div class='timeline-badge'>";
                                echo "<i class='fa fa-genderless text-warning fs-1'></i>";
                                echo "</div>";
                                echo "<div class='fw-mormal timeline-content text-muted ps-3'>${value['activity']}</div>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4">
            <div class="card card-xxl-stretch">
                <div class="card-header border-0">
                    <h3 class="card-title fw-bolder text-dark">Top Voters</h3>
                </div>
                <div class="card-body pt-2">
                    <div class="d-flex align-items-center mb-8">
                        <span class="bullet bullet-vertical h-40px bg-success"></span>
                        <div class="form-check form-check-custom form-check-solid mx-5">
                            <input class="form-check-input" type="checkbox" value="" />
                        </div>
                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Nama 1</a>
                            <span class="text-muted fw-bold d-block">100 M<sup>2</sup></span>
                        </div>
                        <span class="badge badge-light-success fs-8 fw-bolder">Top 1</span>
                    </div>
                    <div class="d-flex align-items-center mb-8">
                        <span class="bullet bullet-vertical h-40px bg-primary"></span>
                        <div class="form-check form-check-custom form-check-solid mx-5">
                            <input class="form-check-input" type="checkbox" value="" />
                        </div>
                        <div class="flex-grow-1">
                        <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Nama 2</a>
                            <span class="text-muted fw-bold d-block">90 M<sup>2</sup></span>
                        </div>
                        <span class="badge badge-light-primary fs-8 fw-bolder">Top 2</span>
                    </div>
                    <div class="d-flex align-items-center mb-8">
                        <span class="bullet bullet-vertical h-40px bg-warning"></span>
                        <div class="form-check form-check-custom form-check-solid mx-5">
                            <input class="form-check-input" type="checkbox" value="" />
                        </div>
                        <div class="flex-grow-1">
                        <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Nama 3</a>
                            <span class="text-muted fw-bold d-block">80 M<sup>2</sup></span>
                        </div>
                        <span class="badge badge-light-warning fs-8 fw-bolder">Top 3</span>
                    </div>
                    <div class="d-flex align-items-center mb-8">
                        <span class="bullet bullet-vertical h-40px bg-primary"></span>
                        <div class="form-check form-check-custom form-check-solid mx-5">
                            <input class="form-check-input" type="checkbox" value="" />
                        </div>
                        <div class="flex-grow-1">
                        <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Nama 4</a>
                            <span class="text-muted fw-bold d-block">70 M<sup>2</sup></span>
                        </div>
                        <span class="badge badge-light-primary fs-8 fw-bolder">Top 4</span>
                    </div>
                    <div class="d-flex align-items-center mb-8">
                        <span class="bullet bullet-vertical h-40px bg-danger"></span>
                        <div class="form-check form-check-custom form-check-solid mx-5">
                            <input class="form-check-input" type="checkbox" value="" />
                        </div>
                        <div class="flex-grow-1">
                        <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Nama 5</a>
                            <span class="text-muted fw-bold d-block">60 M<sup>2</sup></span>
                        </div>
                        <span class="badge badge-light-danger fs-8 fw-bolder">Top 5</span>
                    </div>
                    <div class="d-flex align-items-center mb-8">
                        <span class="bullet bullet-vertical h-40px bg-success"></span>
                        <div class="form-check form-check-custom form-check-solid mx-5">
                            <input class="form-check-input" type="checkbox" value="" />
                        </div>
                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Nama 6</a>
                            <span class="text-muted fw-bold d-block">50 M<sup>2</sup></span>
                        </div>
                        <span class="badge badge-light-success fs-8 fw-bolder">Top 6</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="bullet bullet-vertical h-40px bg-danger"></span>
                        <div class="form-check form-check-custom form-check-solid mx-5">
                            <input class="form-check-input" type="checkbox" value="" />
                        </div>
                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Nama 7</a>
                            <span class="text-muted fw-bold d-block">40 M<sup>2</sup></span>
                        </div>
                        <span class="badge badge-light-danger fs-8 fw-bolder">Top 7</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        }else { 
    ?>
    <?php

    $now = new DateTime();
    $startdate = new DateTime($startVote);
    $enddate = new DateTime($endVote);
    
    if($startdate <= $now && $now <= $enddate) { ?>
        <div class="row gy-5 g-xl-8 boxed-check-group boxed-check-success">
	<div class="alert alert-custom alert-primary" role="alert">
	    <div class="alert-text">Pemilihan Pengurus</div>
	</div>
            <?php 
                foreach($candidate as $key => $value)
                {
                    $idCalon = $value['master_candidate_vote_id'];
            ?>
            <div class="col-sm-4">
                <div class="card card-xxl-stretch">
                    <div class="card-header border-0">
                        <h3 class="card-title fw-bolder text-dark"><?=$value['name'];?></h3>
                    </div>
                    <div class="card-body pt-2">
                        <div class="d-flex align-items-center mb-8">
                            <img class='img-fluid w-100' src="<?=base_url()?>/<?=$value['picture']?>" alt="" />
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="d-flex align-items-center mb-8">
                            <span class="bullet bullet-vertical h-40px bg-success"></span>
                            <div class="form-check form-check-custom form-check-solid mx-5">
                                &nbsp;
                            </div>
                            <div class="flex-grow-1">
                                <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Tentang Calon :</a>
                                <span class="text-muted fw-bold d-block"><?=$value['description'];?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="d-flex align-items-center mb-8">
				<label class="boxed-check w-100 mb-5 text-center">
				    <input class="boxed-check-input w-100 mb-5" type="radio" value="<?=$idCalon;?>" name="pengurus">
				    <div class="boxed-check-label">Pilih</div>
				</label>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
        <div class="row gy-5 g-xl-8 boxed-check-group boxed-check-success">
  	    <div class="alert alert-custom alert-primary" role="alert">
	       <div class="alert-text">Pemilihan Badan Pengawas</div>
	    </div>		
            <?php 
                foreach($candidateBawas as $key => $value)
                {
                    $idCalon = $value['master_candidate_vote_id'];
            ?>
            <div class="col-sm-4">
                <div class="card card-xxl-stretch">
                    <div class="card-header border-0">
                        <h3 class="card-title fw-bolder text-dark"><?=$value['name'];?></h3>
                    </div>
                    <div class="card-body pt-2">
                        <div class="d-flex align-items-center mb-8">
                            <img class='img-fluid w-100' src="<?=base_url()?>/<?=$value['picture']?>" alt="" />
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="d-flex align-items-center mb-8">
                            <span class="bullet bullet-vertical h-40px bg-success"></span>
                            <div class="form-check form-check-custom form-check-solid mx-5">
                                &nbsp;
                            </div>
                            <div class="flex-grow-1">
                                <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Tentang Calon :</a>
                                <span class="text-muted fw-bold d-block"><?=$value['description'];?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="d-flex align-items-center mb-8">
				<label class="boxed-check w-100 mb-5 text-center">
				    <input class="boxed-check-input w-100 mb-5" type="radio" value="<?=$idCalon;?>" name="pengawas">
				    <div class="boxed-check-label">Pilih</div>
				</label>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
        <div class="row gy-5 g-xl-8">
            <div class="col-sm-12">
		  <div class="card-body pt-2">
                       <div class="d-flex align-items-center mb-8">
                           <button type="submit" id="kt_sign_in_submit" onclick="processVote()" class="btn btn-lg btn-primary w-100 mb-5">
                               <span class="indicator-label">Simpan Pilihan</span>
                           </button>
                      </div>
                 </div>
	    </div>
	</div>
    <?php
        }else{
    ?>
        <div class="alert alert-custom alert-danger" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">Vote dimulai pada <strong><?=date_format($startdate,"d-m-Y H:i:s");?></strong> s.d <strong><?=date_format($enddate,"d-m-Y H:i:s");?></strong></div>
        </div>
    <?php
    }}  
    ?>

<script>
    function processVote()
    {
        Swal.fire({
                        title: 'Yakin dengan pilihan anda ?',
                        type: 'Message!',
                        showCancelButton: true,
                        confirmButtonColor: '#4083be',
                        cancelButtonColor: '#fb645c',
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak'
                  }).then((result) => {
                        if (result['isConfirmed']){
                            saveVote();
                        }
                    });

    }

    function saveVote()
    {
        var processVoteUrl = "<?=$processVoteUrl?>";
	if(!document.querySelector('input[name="pengawas"]:checked').value)
	{
		Swal.fire({
			text: "Pengawas belum dipilih",
			icon: "error",
			buttonsStyling: !1,
			confirmButtonText: "Ok",
			customClass: {
				confirmButton: "btn btn-primary"
			}
		}).then((result) => {
                        return;
                    });;		
	}
	
	var pengawas = document.querySelector('input[name="pengawas"]:checked').value;
	var pengurus = document.querySelector('input[name="pengurus"]:checked').value;

        /*
        $.ajax({
				type: "POST",
				url: processVoteUrl,
				data: {
					idCalon: idCalon
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
	*/
    }
</script>
