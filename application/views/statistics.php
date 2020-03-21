<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="amirsh.nll@gmail.com">
    <title>Coronavirus - Statistics</title>
    <link rel="stylesheet" href="{base}assets/css/layout.css">
    <link rel="stylesheet" href="{base}assets/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{base}assets/lib/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="{base}assets/lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{base}assets/lib/datatable/datatables.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="{base}assets/img/favicon.png" type="image/png" sizes="32x32" />
    <link rel="icon" href="{base}assets/img/favicon.png" type="image/png" sizes="32x32">
    <script src="{base}assets/lib/datatable/datatables.min.js"></script>
    <script src="{base}/assets/lib/chart_js/dist/Chart.min.js"></script>
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#"><img src="{base}assets/img/logo.png" alt="" width="22" height="22"> Coronavirus</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarCollapse" style="">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="{base}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{base}login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{base}detect">Detect</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{base}statistics">Statistics <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{base}export">Export</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://github.com/amirshnll/coronavirus" target="_blank">Project</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

     <main class="myContent d-block">

      <section class="text-center">
        <div class="container gray-box">
          <div class="row">
            <div class="col-md-12">
              <h1>Statistics</h1>

              <p>&nbsp;</p>
              <?php
                if($top_ten!==false && is_array($top_ten)) {
                  ?>
                  <h6 class="text-muted text-left">Top 10 Country (number_of_patients):</h6>
                  <canvas id="myChart1" class="mychart col-md-10 m-auto d-block" style="height: 80vh;"></canvas>
                  <script>
                    var ctx = document.getElementById('myChart1').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [<?php foreach ($top_ten as $key => $value) echo "'" . $value["name"] . "', "; ?>],
                            datasets: [{
                                label: 'Top 10 Country',
                                data: [<?php foreach ($top_ten as $key => $value) echo "'" . $value["number_of_patients"] . "', "; ?>],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(255, 99, 132, 0.7)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(255, 99, 132, 0.7)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            },
                            title: {
                          fontStyle:"bold",
                                display: true,
                                text: 'Top 10 Country'
                            },
                          responsive: true
                        }
                    });
                  </script>
                  <?php
                }
              ?>
              <p>&nbsp;</p>
              <h6 class="text-muted text-left">Country Detail:</h6>
                <table id="country_datatable" class="country_datatable display table table-striped table-responsive-sm" style="width:100%">
                <thead class="bg-dark text-light">
                  <tr>
                    <td width="10%">#</td>
                    <td width="30%">country name</td>
                    <td width="20%">number of patients</td>
                    <td width="20%">number of death</td>
                    <td width="20%">updated time</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $i = 1;
                    if($country !== false && is_array($country)) {
                      foreach ($country as $key => $value) {
                        ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $value['name']; ?></td>
                          <td><?php echo $value['number_of_patients']; ?></td>
                          <td><?php echo $value['number_of_death']; ?></td>
                          <td><?php echo date("Y/m/d", $value['updated_time']); ?></td>
                        </tr>
                        <?php
                        $i++;
                      }
                    }
                    else {
                      ?> <td colspan="5" width="100%">Datatable is empty.!</td> <?php
                    }
                  ?>
                </tbody>
                <tfoot class="bg-dark text-light">
                  <tr>
                    <td width="10%">#</td>
                    <td width="30%">country name</td>
                    <td width="20%">number of patients</td>
                    <td width="20%">number of death</td>
                    <td width="20%">updated time</td>
                  </tr>
                </tfoot>
              </table>
              <script>
                $(document).ready( function () {
                    $('#country_datatable').DataTable();
                } );
              </script>
            </div>
          </div>
        </div>
      </section>
      <p>&nbsp;</p>
      <p class="text-muted text-center">&copy; 2020 All rights reserved | <a class="text-muted" href="https://amirshnll.ir" title="A.shokri" target="_blank">A.shokri</a></p>
      <p>&nbsp;</p>
    </main>

    <script src="{base}assets/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="{base}assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
