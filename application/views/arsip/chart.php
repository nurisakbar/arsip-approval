<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">GRAFIK JUMLAH ARSIP PER TAHUN</h3>
                    </div>
        
        <div class="box-body">
        <!-- <canvas id="myChart"></canvas> -->
        <div id="chart_div"></div>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
          <?php
            if (count($graph)>0) {
                foreach ($graph as $data) {
                    echo "'" .$data->tahun ."',";
                }
            }
          ?>
        ],
        datasets: [{
            label: 'Jumlah Arsip',
            backgroundColor: '#ADD8E6',
            borderColor: '##93C3D2',
            data: [
              <?php
                if (count($graph)>0) {
                    foreach ($graph as $data) {
                        echo $data->jumlah . ", ";
                    }
                }
              ?>
            ]
        }]
    },
});
 
  </script> -->

  <script type="text/javascript">
  google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        ['Nama Kategori', <?php foreach ($kategori as $k) {
                  echo "'".$k->nama_kategori."',";
              }?>],
        <?php
        foreach ($tahun as $t) {
            ?>
        [<?php echo "'Tahun ".$t->tahun."'"; ?>, <?php foreach ($kategori as $k) {
                echo hitung_arsip_by_tahun_by_category($t->tahun, $k->id).",";
            } ?>],
        <?php
        } ?>
      ]);

      var options = {
        title: 'Grafik Arsip Perkategori Pertahun',
        chartArea: {width: '50%'},
        hAxis: {
          title: 'Grafik Arsip Perkategori Pertahun',
          minValue: 0
        },
        vAxis: {
          title: 'Grafik Arsip Perkategori Pertahun'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>