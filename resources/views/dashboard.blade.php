@extends('layout.admin')
@section('title','Dashboard')
@section('content')
<div class="pcoded-content">

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Probability Settings</h5>
                                </div>
                                
                                <div class="card-block">
                                  <canvas id="probability_settings_chart" width="400" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Actual Rewards</h5>
                                </div>
                                <div class="card-block">
                                    <canvas id="actual_rewards_chart" width="400" height="400"></canvas>
                                </div>
                                <!-- <div class="card-block">
                                    <div id="actual_rewards_chart" style="width: 100%; height: 300px;"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('after-scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script>
    $(document).ready(function() {
        var ctx = document.getElementById("probability_settings_chart");
        var dataValues = <?= json_encode($data->pluck('probability')?->toArray());?>;
        var labels = <?= json_encode($data->pluck('title')?->toArray()); ?>;
        // Generate random colors automatically
        var backgroundColors = labels.map(() => {
            return `hsl(${Math.floor(Math.random() * 360)}, 70%, 60%)`; // Generates a random HSL color
        });
        // Modify labels to include percentages
    var modifiedLabels = labels.map((label, index) => {
        
        let value = parseInt(dataValues[index], 10);
        return `${label} (${value}%)`; // Append percentage
    });

        var data = {
            labels: modifiedLabels,
            datasets: [{
                data: dataValues,
                backgroundColor: backgroundColors, // Apply generated colors
                borderColor: '#fff', // Optional: white border for separation
                borderWidth: 2
            }]
        };
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return labels[tooltipItem.dataIndex]; // Show only label (no value, no percentage)
                            }
                        }
                    }
                }
            }
        });

        var ctx = document.getElementById("probability_settings_chart");
        var dataValues = <?= json_encode($data->pluck('probability')?->toArray());?>;
        var labels = <?= json_encode($data->pluck('title')?->toArray()); ?>;
        // Generate random colors automatically
        var backgroundColors = labels.map(() => {
            return `hsl(${Math.floor(Math.random() * 360)}, 70%, 60%)`; // Generates a random HSL color
        });
        // Modify labels to include percentages
    var modifiedLabels = labels.map((label, index) => {
        
        let value = parseInt(dataValues[index], 10);
        return `${label} (${value}%)`; // Append percentage
    });

        var data = {
            labels: modifiedLabels,
            datasets: [{
                data: dataValues,
                backgroundColor: backgroundColors, // Apply generated colors
                borderColor: '#fff', // Optional: white border for separation
                borderWidth: 2
            }]
        };
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return labels[tooltipItem.dataIndex]; // Show only label (no value, no percentage)
                        }
                    }
                }
            }
        }
    });



    });

    

</script>

@endpush