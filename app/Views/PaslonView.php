<div class="row gy-5 g-xl-8" id="rowForm">
    <form method="post" id="upload_image_form" enctype="multipart/form-data">
        <div class="col-xxl-12">
            <div class="card card-xxl-stretch">
                <div class="card-header border-0">
                    <h3 class="card-title fw-bolder text-dark">Form Paslon</h3>
                    <div style="float: right; margin-top :20px;" >
                        <button type="button" class="btn btn-danger btn-sm" id="reset">Reset</button>
                    </div>
                </div>
                <div class="card-body pt-2 mb-3">
                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                                 <label for="name">Nama Paslon</label>
                                 <input type="text" name="name" id="name" class="form-control readonly">
                             </div>
                        </div>
                        <div class="col-md-6" style="visibility: hidden;"   >
                             <div class="form-group">
                                <label for="master_vote">Master Vote</label>
                                <select name="master_vote" id="master_vote" class="form-control disabled">
                                    <option value="1" selected>Satu</option>
                                </select> 
                             </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                                 <label for="description">Deskripsi</label>
                                 <textarea name="description" id="description" class="form-control readonly" cols="30" rows="10"></textarea>
                             </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="file">Foto </label>
                                <input type="file" name="file" multiple="true" id="file" onchange="onFileUpload(this);"
                                    class="form-control form-control-lg readonly"  accept="image/*">
                             </div>
                             <br>
                             <div class="d-grid text-center">
                                <center>
                                    <img class="mb-3" id="ajaxImgUpload" alt="Preview Image" src="https://via.placeholder.com/300" />
                                </center>
                             </div>
                        </div>
                    </div>
                    <hr>
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="action" name="action" value="Create">
                    <input type="hidden" id="upload" name="upload">
                    <button type="submit" class="btn btn-primary uploadBtn" id="btn-upload" name="btn-upload" value="Create">Create</button>
                </div>
            </div>
        </div>
    </form>
        <div class="col-xxl-12">
            <div class="card card-xxl-stretch">
                <div class="card-header border-0">
                    <h3 class="card-title fw-bolder text-dark"></h3>
                </div>
                <div class="card-body pt-2">
                    <table class="table table-striped table-bordered" id="tablePaslon">
                        <thead>
                            <tr>
                                <th style='text-align:center; vertical-align:middle; font-weight: 900;'> No. </th>
                                <th style='text-align:center; vertical-align:middle; font-weight: 900;'> Nama </th>
                                <th style='text-align:center; vertical-align:middle; font-weight: 900;'> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no =1;
                            foreach($paslon as $key => $value): ?>
                                <tr>
                                    <td style='text-align:center; vertical-align:middle'><?= $no++ ?></td>
                                    <td><?= $value['name'] ?></td>
                                    <td>
                                        <button type="button" class="btn  btn-primary btn-action" id="detailBtn<?=$value['master_candidate_vote_id']?>" data-id="<?= $value['master_candidate_vote_id'] ?>" value="Detail">Detail</button>
                                        <button type="button" class="btn  btn-warning btn-action" id="detailEdit<?=$value['master_candidate_vote_id']?>" data-id="<?= $value['master_candidate_vote_id'] ?>" value="Edit">Edit</button>
                                        <button type="button" class="btn  btn-danger btn-action" id="detailDelete<?=$value['master_candidate_vote_id']?>" data-id="<?= $value['master_candidate_vote_id'] ?>" value="Delete">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div style="float: right">
                        <?= $pager->Links() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
	 function onFileUpload(input, id) {
        id = id || '#ajaxImgUpload';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(id).attr('src', e.target.result).width(300)
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    base_url = "<?= base_url(); ?>";
    $(document).ready(function () {
        $('#file').on('change', function(){
            $('#upload').val('');
        })

        $("#reset").on("click", function(){
            $('#file').val("")
            $('#name').val("")
            $('#master_vote').val("")
            $('#description').val("")
            $('#upload').val("")
            $('#id').val("")
            $('#ajaxImgUpload').attr('src', 'https://via.placeholder.com/300');
            $('#btn-upload').val('Create')
            $('#btn-upload').text('Create')
            $('#btn-upload').attr("disabled", false)
            $('.readonly').attr('readonly', false)
            $('.disabled').attr('disabled', false)
            
        });

        $(".btn-action").on("click", function(){
            id = $(this).data("id");
            action = this.value;

            if(action == "Delete")
            {
                deleteData(id, action);
            }
            else
            {
                getData(id, action)
            }
        })

        $('#upload_image_form').on('submit', function (e) {
            $('.uploadBtn').html('Uploading ...');
            $('.uploadBtn').prop('Disabled');
            image = $('#file').val()
            name = $('#name').val()
            master_vote = $('#master_vote').val()
            description = $('#description').val()
            action = $('#btn-upload').val()
            e.preventDefault();
            if(action != "Create")
            {
                if (!name || !master_vote || !description) {
                    Swal.fire({
                        text: "tolong Input semua data .. !",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                    $('.uploadBtn').html(action);
                    $('.uploadBtn').prop('enabled');
                } else {
                    $.ajax({
                        url: "<?php echo base_url(); ?>/main/getPaslon",
                        method: "POST",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",
                        success: function (res) {
                            if (res.code == "00") {
                                $('#ajaxImgUpload').attr('src', 'https://via.placeholder.com/300');
                                $('#alertMsg').html(res.message);
                                Swal.fire({
                                    text: res.message,
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                })
    
                                $('.uploadBtn').html('Upload');
                                $('.uploadBtn').prop('Enabled');
                                $('#file').val("")
                                $('#name').val("")
                                $('#master_vote').val("")
                                $('#description').val("")
                                $('#ajaxImgUpload').attr('src', 'https://via.placeholder.com/300');
                                $('#btn-upload').val('Create')
                                $('#btn-upload').text('Create')
                                $('#btn-upload').attr("disabled", false)
                                
                                setTimeout(function() { 
                                    location.reload();
                                }, 1000);
                            } else {
                                Swal.fire({
                                    text: res.message,
                                    icon: "error",
                                    buttonsStyling: !1,
                                })
                                $('.uploadBtn').html('Upload');
                                $('.uploadBtn').prop('Enabled');
                            }
                            
                            $( "#mytable" ).load( " #mytable" );
                        }
                    });
                }
            }
            else
            {
                if (!image || !name || !master_vote || !description) {
                    Swal.fire({
                        text: "tolong Input semua data .. !",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                    $('.uploadBtn').html(action);
                    $('.uploadBtn').prop('enabled');
                } else {
                    $.ajax({
                        url: "<?php echo base_url(); ?>/main/getPaslon",
                        method: "POST",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",
                        success: function (res) {
                            if (res.code == "00") {
                                $('#ajaxImgUpload').attr('src', 'https://via.placeholder.com/300');
                                $('#alertMsg').html(res.message);
                                Swal.fire({
                                    text: res.message,
                                    icon: "success",
                                    buttonsStyling: !1,
                                    
                                })
    
                                $('.uploadBtn').html('Upload');
                                $('.uploadBtn').prop('Enabled');
                                $('#file').val("")
                                $('#name').val("")
                                $('#master_vote').val("")
                                $('#description').val("")
                                $('#ajaxImgUpload').attr('src', 'https://via.placeholder.com/300');
                                $('#btn-upload').val('Create')
                                $('#btn-upload').text('Create')
                                $('#btn-upload').attr("disabled", false)
                                
                                setTimeout(function() { 
                                    location.reload();
                                }, 1000);
                            } else {
                                Swal.fire({
                                    text: res.message,
                                    icon: "error",
                                    buttonsStyling: !1,
                                })
                                $('.uploadBtn').html('Upload');
                                $('.uploadBtn').prop('Enabled');
                            }
                            
                        }
                    });
                }
            }
        });
    });

    function getData(id, action)
    {
        $.ajax({
            url: "<?php echo base_url(); ?>/main/getData",
            method: "POST",
            data: {id:id},
            dataType: "json",
            success: function (res) {
                $('#name').val(res.name)
                $('#description').val(res.description)
                $('#master_vote').val(res.master_vote_id)
                $('#ajaxImgUpload').attr('src', base_url+'/'+res.picture).width(300);
                $('#btn-upload').val(action)
                $('#btn-upload').text(action)
                $('#action').val(action)
                
                if(action == "Detail")
                {
                    $('#btn-upload').attr("disabled", true)
                    $('.readonly').attr('readonly', true)
                    $('.disabled').attr('disabled', true)
                }
                else
                {
                    $("#id").val(res.master_candidate_vote_id);
                    $("#upload").val(res.picture);
                    $('#btn-upload').attr("disabled", false)
                    $('.readonly').attr('readonly', false)
                    $('.disabled').attr('disabled', false)
                }

                $('html, body').animate({
                    scrollTop: $("#rowForm").offset().top
                }, 500);
            }
        });
    }

    function deleteData(id, action)
    {
        $('.btn-action').attr('disabled', true)

    //     swal({
    //         title: "Are you sure?",
    //         text: "You will not be able to recover this imaginary file!",
    //         type: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#DD6B55",
    //         confirmButtonText: "Yes, delete it!",
    //         closeOnConfirm: false
    //     },
    //     function(isConfirm){
    //        if (isConfirm) {
    //         $.ajax({
    //             url: "scriptDelete.php",
    //             type: "POST",
    //             data: {id: 5},
    //             dataType: "html",
    //             success: function () {
    //                 swal("Done!","It was succesfully deleted!","success");
    //             }
    //         });
    //       }else{
    //             swal("Cancelled", "Your imaginary file is safe :)", "error");
    //       } 
    //    })

        $.ajax({
            url: "<?php echo base_url(); ?>/main/deletePaslon",
            method: "POST",
            data: {id:id},
            dataType: "json",
            success: function (res) {
                if(res)
                {
                    Swal.fire({
                        text: "Data Berhasil Di Hapus",
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });

                    setTimeout(function() { 
                        location.reload();
                    }, 1000);
                }
                else
                {
                    Swal.fire({
                        text: "Data Gagal Di Hapus",
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }

                $('.btn-action').attr('disabled', false)
            }
        });
    }
</script>
