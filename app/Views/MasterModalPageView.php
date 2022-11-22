<script type="text/javascript">
  $(document).ready(function()
  {
    $('.dataTableModal').DataTable(
      {
        "order": [[ 0, "desc" ]],
        "lengthMenu": [ 5, 10, 25, 50, 75, 100, 200]
      });

    $(".needs-validation").submit(function()
    {
      if(!$(this)[0].checkValidity())
      {
        event.preventDefault();
        event.stopPropagation();
      }

      $(this).addClass("was-validated");
    });

    $(".needs-validation-modal").click(function()
    {
      if(!$(this)[0].checkValidity())
      {
        event.preventDefault();
        event.stopPropagation();
      }

      $(this).addClass("was-validated");
    });
  });
</script>

<div class="modal-header">
  <h5 class="m-0 font-weight-bold text-primary"><?= $title ?></h5>
  <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
</div>
<?= $content ?>