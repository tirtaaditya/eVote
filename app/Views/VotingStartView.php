<div class="row gy-5 g-xl-8" id="rowForm">
    <form method="post">
        <div class="col-xxl-12">
            <div class="card card-xxl-stretch">
                <div class="card-header border-0">
                    <h3 class="card-title fw-bolder text-dark">Form Waktu Pemilihan</h3>
                </div>
                <div class="card-body pt-2 mb-3">
                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                                 <label for="name">Mulai Voting</label>
                                 <input type="datetime-local" name="startVote" id="startVote" value="<?=$votingStart['start_date']?>" class="form-control">
                             </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                 <label for="name">Selesai Voting</label>
                                 <input type="datetime-local" name="endVote" id="endVote" value="<?=$votingStart['end_date']?>" class="form-control">
                             </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary uploadBtn" id="btn-upload" name="btn-upload">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

