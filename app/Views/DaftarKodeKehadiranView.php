<div class="row gy-5 g-xl-8" id="rowForm">
    <div class="col-xxl-12">
        <div class="card card-xxl-stretch">
            <div class="card-header border-0">
                <h3 class="card-title fw-bolder text-dark">List Daftar Kode Kehadiran</h3>
                <div style="float: right; margin-top :20px;" >
                    <button type="button" class="btn btn-success btn-sm" onclick="exportReportToExcel(this)">Export Excel</button>
                </div>                
            </div>
            <div class="card-body pt-2">
                <table class="table table-striped table-bordered" id="tablePaslon">
                    <thead>
                        <tr>
                            <th style='text-align:center; vertical-align:middle; font-weight: 900;'> No </th>
                            <th style='text-align:center; vertical-align:middle; font-weight: 900;'> Kode </th>
                            <th style='text-align:center; vertical-align:middle; font-weight: 900;'> NIK Pengguna </th>
                            <th style='text-align:center; vertical-align:middle; font-weight: 900;'> Digunakan Pada </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no =1;
                        foreach($dataKode as $key => $value) { 
                            ?>
                            <tr>
                                <td style='text-align:center; vertical-align:middle'><?= $no++ ?></td>
                                <td><?= $value['kode_kehadiran'] ?></td>
                                <td><?= $value['identity_code'] ?></td>
                                <td><?= $value['use_on'] ?></td>                              
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script>
    function exportReportToExcel() {
        var table = document.getElementById("tablePaslon");
        TableToExcel.convert(document.getElementById("tablePaslon"), {
            name: "DaftarPeserta.xlsx",
            sheet: {
            name: "List"
            }
          });
    }

    function resendLink(id)
    {
        var baseURL = '<?=base_url();?>'
        location.href=baseURL+'/pemilihan/resendLink/'+id;
    }
</script>
