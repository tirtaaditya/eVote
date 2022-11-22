<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="icon" type="image/ico" href="<?=base_url()?>/assets/img/logo/BRIlogo2.ico" sizes="any"/>
    
    <title><?= getenv('applicationName')." | ".$title ?></title>

    <link href="<?=base_url()?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>/assets/css/ruang-admin.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/assets/vendor/datatables-export/buttons.dataTables.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/assets/vendor/select2/css/select2.min.css" rel="stylesheet"/>
    <link href="<?=base_url()?>/assets/vendor/select2/css/select2-bootstrap4.min.css" rel="stylesheet"/>
    <link href="<?=base_url()?>/assets/vendor/select2/css/bootstrap-select.min.css" rel="stylesheet"/>

    <script src="<?=base_url()?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/jquery/jquery.number.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/jquery/jquery.form.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="<?=base_url()?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="<?=base_url()?>/assets/vendor/datatables-export/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/datatables-export/buttons.flash.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/datatables-export/pdfmake.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/datatables-export/vfs_fonts.js"></script>
    <script src="<?=base_url()?>/assets/vendor/datatables-export/buttons.html5.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/datatables-export/buttons.print.min.js"></script>

    <script src="<?=base_url()?>/assets/vendor/select2/js/select2.min.js"></script>
   
  <?php
    $user = session('user');
    $apphelper = new App\Libraries\AppHelper();
  
    $successMessage = $apphelper->getErrorMessageAPI(session('successMessage'));
    $errorMessage = $apphelper->getErrorMessageAPI(session('errorMessage'));
  ?>
  
  <script>
    var successMessage = "<?= $successMessage ?>";
    var errorMessage = "<?= $errorMessage ?>";

    var baseURL = "<?= base_url() ?>";

    $(document).ready(function () 
    {
      setActiveMenu(5);

      if(successMessage != "")
      {
        $('#success-modal').modal('show');
      }

      if(errorMessage != "")
      {
        $('#failed-modal').modal('show');
      }
      
      getListNotification();

      $('.number-input').number(true);

      $('.decimal-input').number(true, 2);

      $('.table-datatable').DataTable(
      {
        "lengthMenu": [ 10, 25, 50, 75, 100, 200]
      });

      $('.table-datatable-export').DataTable(
      {
        "lengthMenu": [ 10, 25, 50, 75, 100, 200],
        dom: '<"row"<"col-12"B>>r<"row"<"col-6"l><"col-6"f>>rt<"row"<"col-6"i><"col-6"p>>',
        buttons: 
        [
          {
              extend: 'copy',
              exportOptions: 
              {
                columns: 'th:not(:last-child)'
              }
          },
          {
              extend: 'csv',
              exportOptions: 
              {
                columns: 'th:not(:last-child)'
              }
          },
          {
              extend: 'pdf',
              orientation: 'landscape',
              pageSize: 'LEGAL',
              exportOptions: 
              {
                columns: 'th:not(:last-child)'
              }
          }
        ]
      });

      $('.needs-validation').submit(function()
      {
        if(!$(this)[0].checkValidity())
        {
          event.preventDefault();
          event.stopPropagation();
        }

        $(this).addClass("was-validated");
      });

      $('.needs-validation-modal').click(function()
      {
        if(!$(this)[0].checkValidity())
        {
          event.preventDefault();
          event.stopPropagation();
        }

        $(this).addClass("was-validated");
      });
    });

    function handleRedirectButton(myButton)
    {    
      window.location = $(myButton).data("url");
    }

    function handleOpenBlankButton(myButton)
    {
      var win = window.open($(myButton).data("url"), '_blank');

      if (win) 
      {
          //Browser has allowed it to be opened
          win.focus();
      }
      else
      {
          //Browser has blocked it
          alert('Please allow popups for this website');
      }
    }

    function setActiveMenu(maxSegment)
    {
      if(maxSegment >= 3)
      {
        var search = "";

        var pathnames = window.location.pathname.split( '/' );

        for(var i=1; i<=maxSegment; i++)
        {
          if(pathnames[i] != undefined)
          {
            search += "/" + pathnames[i];
          }
        }

        var active_menu = $("a[href='" + window.location.origin + search + "'");

        if(active_menu.length == 0)
        {
          setActiveMenu(maxSegment - 1);
        }
        else
        {
          active_menu.addClass("active");
          active_menu.parents("div").parents("div").addClass("show");
        }
      }
    }

    function getListNotification()
    {
      $.ajax(
      {
        type: 'POST',
        url: baseURL + '/notification/getlistnotification',
        data: 
        {
          limit : 5
        },
        dataType: 'json',
        success: function(response) 
        {
          if(response.code == '00')
          {
            response.data.forEach(function(item)
            {
              var url = "#";

              if(url != "#")
              {
                url += "/" + item.reference_id;
              }

              var message = item.module + ' ' + item.type + ': ' + item.message;

              var htmlItem = '<a class="dropdown-item d-flex align-items-center" href="' + url + '">' +
                              '<div class="mr-3">' +
                                '<div class="icon-circle bg-' + item.type.toLowerCase() +'">' +
                                  '<i class="fas fa-exclamation-triangle text-white"></i>' +
                                '</div>' +
                              '</div>' +
                              '<div>' +
                                '<div class="small text-gray-500">' + item.created_date + '</div>' +
                                message +
                              '</div>' +
                            '</a>';

              $('#field_header_notification_center').after(htmlItem);
            });
          }
          else
          {
            alert(response.message);
          }
        }
      });
    }
  </script>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url().'/home' ?>">
        <div class="sidebar-brand-icon">
          <img src="<?=base_url()?>/assets/img/logo/BRIlogo.png">
        </div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url().'/home' ?>">
          <i class="fa fa-home"></i>
          <span>Home</span></a>
      </li>
      <hr class="sidebar-divider">
      <?php
        $authority_menu = $user['authority_menu'];

        foreach ($authority_menu as $menu) 
        {
          $collapse_id = "collapse${menu['title']}";
          $collapse_id = str_replace(' ', '', $collapse_id);

          $icon = "fas fa-fw fa-folder";

          if($menu['title'] == 'Report')
          {
            $icon = "fas fa-fw fa-table";
          }
          else if($menu['title'] == 'Management')
          {
            $icon = "fas fa fa-cogs";
          }
          else if($menu['title'] == 'Dashboard')
          {
            $icon = "fas fa-tachometer-alt";
          }
          else if($menu['title'] == 'Audit')
          {
            $icon = "fas fa-list-alt";
          }
      ?>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#<?= $collapse_id ?>"
              aria-expanded="true" aria-controls="<?= $collapse_id ?>">
              <i class="<?= $icon ?>"></i>
              <span><?= $menu['title'] ?></span>
            </a>
            <div id="<?= $collapse_id ?>" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <?php
                  $isShowDivider = false;

                  foreach ($menu['submenu'] as $submenu)
                  {
                    if(!empty($submenu['submenu']))
                    {
                      if($isShowDivider)
                      {
                        echo "<hr class='divider'>";
                      }

                      echo "<h6 class='collapse-header'>".$submenu['title']."</h6>";

                      foreach ($submenu['submenu'] as $childmenu)
                      {
                        echo "<a class='collapse-item' href='".base_url()."/".$childmenu['url']."''>".$childmenu['title']."</a>";
                      }

                      $isShowDivider = true;
                    }
                    else
                    {
                      echo "<a class='collapse-item' href='".base_url()."/".$submenu['url']."''>".$submenu['title']."</a>";

                      $isShowDivider = true;
                    }
                  }
                ?>
              </div>
            </div>
          </li>
      <?php
        }
      ?>
      <hr class="sidebar-divider">
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- <span class="badge badge-danger badge-counter">0</span> -->
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header" id="field_header_notification_center">
                  Notification Center
                </h6>
                <a class="dropdown-item text-center small text-gray-500" href="<?= base_url().'/notification' ?>">Show All Notification</a>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <?php
                  $userIcon = $user['gender'] == "L" ? "boy.png" : "girl.png";
                ?>
                <img class="img-profile rounded-circle" src="<?=base_url()?>/assets/img/<?= $userIcon ?>" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?= $user['fullname']." | ".$user['user_id']." | ".$user['working_unit'] ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url().'/profile' ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="<?= base_url().'/main/logout' ?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
            <ol class="breadcrumb">
              <?php
                $breadcrumb = $apphelper->getBreadCrumb();
                $base_url = base_url().'/home';
                for($i = 0; $i < count($breadcrumb); $i++)
                {
                  if($i != 0)
                  {
                    echo "<li class='breadcrumb-item active' aria-current='page'>".$breadcrumb[$i]."</li>";
                  }
                  else
                  {
                    echo "<li class='breadcrumb-item'><a href=${base_url}>".$breadcrumb[$i]."</a></li>";
                  }
                }
              ?>
            </ol>
          </div>

          <?= $content ?>
        
        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; 2020 - developed by
              <b><a>PT. Bank Rakyat Indonesia (Persero) Tbk.</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <?php
    if(!empty($successMessage))
    {
  ?>
    <div class="modal fade" id="success-modal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
             </div>

            <div class="modal-body">
              <div class="thank-you-pop">
                <img src="<?=base_url()?>/assets/img/success-submit.png" alt="">
                <h1>Success!</h1>
                <p><?= $successMessage ?></p>

                <?php
                    if(!empty(session('displayResult')))
                    {
                  ?>
                    <h3 class="cupon-pop"><span><?= session('displayResult') ?></span></h3>
                  <?php
                    }
                  ?>
              </div>  
            </div>
          </div>
      </div>
    </div>
  <?php
    }
  ?>

  <?php
    if(!empty($errorMessage))
    {
  ?>
    <div class="modal fade" id="failed-modal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
             </div>

            <div class="modal-body">
               
                <div class="thank-you-pop">
                  <img src="<?=base_url()?>/assets/img/failed-submit.png" alt="">
                  <h1>Failed</h1>

                  <p><?= $errorMessage ?></p>

                  <?php
                    if(!empty(session('displayResult')))
                    {
                  ?>
                    <h3 class="cupon-pop"><span><?= session('displayResult') ?></span></h3>
                  <?php
                    }
                  ?>
                </div>  
              </div>
          </div>
      </div>
    </div>
  <?php
    }
  ?>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="<?=base_url()?>/assets/js/ruang-admin.min.js"></script>  

</body>


</html>