<script type="text/javascript">
  notificationURL = "<?= $notificationURL ?>";

  $(document).ready(function()
  { 
    $.ajax(
    {
      type: 'POST',
      url: '<?= base_url() ?>/notification/getlistnotification',
      data: 
      {
        limit : 5
      },
      dataType: 'json',
      success: function(response) 
      {
        if(response.code == '00')
        {
          var baseURL = "<?= base_url() ?>";

          response.data.forEach(function(item)
          {
            var url = "#";

            if(url != "#")
            {
              url += "/" + item.reference_id;
            }

            var message = item.module + ' ' + item.type + ': ' + item.message;

            var htmlItem = '<div class="customer-message align-items-center">' +
                              '<a class="font-weight-bold" href="' + url + '">' + 
                                '<div class="text-truncate message-title">' + message + '</div>' + 
                                '<div class="small text-gray-500 message-time font-weight-bold">' + item.created_date + '0</div>' + 
                              '</a>' + 
                            '</div>';

            $('#field_view_all_notification').before(htmlItem);
          });
        }
        else
        {
          alert(response.message);
        }
      }
    });
  });
</script>

<div class="row mb-3">
  <!-- Notification Center -->
  <div class="col-xl-12 col-lg-12 ">
    <div class="card">
      <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-light">Notification Center</h6>
      </div>
      <div>
        <div class="card-footer text-center" id="field_view_all_notification">
          <a class="m-0 small text-primary card-link" href="<?= $notificationMenuURL ?>">View More <i
              class="fas fa-chevron-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>