@extends('layouts.header')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="row ">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15">Assets</h5>
                      <h2 class="mb-3 font-18">{{count($inventories)}}</h2>
                      <p class="mb-0">as of <span class="col-green">{{(date('F d, Y'))}}</span> </p>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="assets/img/banner/1.png" alt="">
                    </div>
                  </div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15"> Available Assets</h5>
                      <h2 class="mb-3 font-18">{{count($active_inventories)}}</h2>
                      <p class="mb-0"><span class="col-orange"></span> </p>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="assets/img/banner/2.png" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15">Deployed Assets</h5>
                      <h2 class="mb-3 font-18">{{count($deployed_inventories)}}</h2>
                      <p class="mb-0"><span class="col-green">18%</span></p>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="assets/img/banner/3.png" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-6">
          <div class="card">
            <div class="card-header">
              <h4>Asset per Category</h4>
            </div>
            <div class="card-body">
              <div class="recent-report__chart">
                <div id="barChart"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  {{-- <script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js') }}"></script> --}}
  <script type="text/javascript">
   
   var categories = {!! json_encode($categories->toArray()) !!};

    // console.log(categories);

  
   function barChart() 
   {
  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end



  var chart = am4core.create("barChart", am4charts.XYChart);
  chart.scrollbarX = new am4core.Scrollbar();

  for(var i=0;i<categories.length;i++)
  {
      var dataChart = {};
      var invetories = categories[i].inventories;
      // console.log(invetories);
      dataChart.category = categories[i].category_name;
      dataChart.count = invetories.length;
      chart.data[i] = dataChart;
  }

  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "category";
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.minGridDistance = 30;
  categoryAxis.renderer.labels.template.horizontalCenter = "right";
  categoryAxis.renderer.labels.template.verticalCenter = "middle";
  categoryAxis.renderer.labels.template.rotation = 270;
  categoryAxis.tooltip.disabled = true;
  categoryAxis.renderer.minHeight = 110;
  categoryAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.minWidth = 50;
  valueAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

  // Create series
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.sequencedInterpolation = true;
  series.dataFields.valueY = "count";
  series.dataFields.categoryX = "category";
  series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
  series.columns.template.strokeWidth = 0;


  series.tooltip.pointerOrientation = "vertical";

  series.columns.template.column.cornerRadiusTopLeft = 10;
  series.columns.template.column.cornerRadiusTopRight = 10;
  series.columns.template.column.fillOpacity = 0.8;

  // on hover, make corner radiuses bigger
  let hoverState = series.columns.template.column.states.create("hover");
  hoverState.properties.cornerRadiusTopLeft = 0;
  hoverState.properties.cornerRadiusTopRight = 0;
  hoverState.properties.fillOpacity = 1;

  series.columns.template.adapter.add("fill", (fill, target) => {
    return chart.colors.getIndex(target.dataItem.index);
  })

  // Cursor
  chart.cursor = new am4charts.XYCursor();
}
  </script>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/amcharts4/core.js') }}"></script>
    <script src="{{ asset('assets/bundles/amcharts4/charts.js') }}"></script>
    <script src="{{ asset('assets/bundles/amcharts4/animated.js') }}"></script>
    <script src="{{ asset('assets/bundles/amcharts4/worldLow.js') }}"></script>
    <script src="{{ asset('assets/bundles/amcharts4/maps.js') }}"></script>
      <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/chart-amchart.js') }}"></script>
  
@endsection
