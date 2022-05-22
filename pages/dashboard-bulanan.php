<?php
session_start();
$conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

// cek koneksi database
if (!$conn) {
?>
    <script>
        alert('<?php echo mysqli_connect_error(); ?>')
    </script>
<?php
} else {
    $monthquery = "
    SELECT 
                            SUM(IF(month(transaksi.created_at) = 1, total_harga, 0)) as januari,
                            SUM(IF(month(transaksi.created_at) = 2, total_harga, 0)) as februari,
                            SUM(IF(month(transaksi.created_at) = 3, total_harga, 0)) as maret,
                            SUM(IF(month(transaksi.created_at) = 4, total_harga, 0)) as april,
                            SUM(IF(month(transaksi.created_at) = 5, total_harga, 0)) as mei,
                            SUM(IF(month(transaksi.created_at) = 6, total_harga, 0)) as juni,
                            SUM(IF(month(transaksi.created_at) = 7, total_harga, 0)) as juli,
                            SUM(IF(month(transaksi.created_at) = 8, total_harga, 0)) as agustus,
                            SUM(IF(month(transaksi.created_at) = 9, total_harga, 0)) as september,
                            SUM(IF(month(transaksi.created_at) = 10, total_harga, 0)) as oktober,
                            SUM(IF(month(transaksi.created_at) = 11, total_harga, 0)) as november,
                            SUM(IF(month(transaksi.created_at) = 12, total_harga, 0)) as desember,
                            SUM(total_harga) as total
                        FROM transaksi
                        WHERE YEAR(transaksi.created_at) = YEAR(CURRENT_DATE) AND transaksi.status = 'selesai'";

    $terjualquery = "
                        SELECT 
                                                SUM(IF(month(transaksi.created_at) = 1, total_jumlah_pesanan, 0)) as januari,
                                                SUM(IF(month(transaksi.created_at) = 2, total_jumlah_pesanan, 0)) as februari,
                                                SUM(IF(month(transaksi.created_at) = 3, total_jumlah_pesanan, 0)) as maret,
                                                SUM(IF(month(transaksi.created_at) = 4, total_jumlah_pesanan, 0)) as april,
                                                SUM(IF(month(transaksi.created_at) = 5, total_jumlah_pesanan, 0)) as mei,
                                                SUM(IF(month(transaksi.created_at) = 6, total_jumlah_pesanan, 0)) as juni,
                                                SUM(IF(month(transaksi.created_at) = 7, total_jumlah_pesanan, 0)) as juli,
                                                SUM(IF(month(transaksi.created_at) = 8, total_jumlah_pesanan, 0)) as agustus,
                                                SUM(IF(month(transaksi.created_at) = 9, total_jumlah_pesanan, 0)) as september,
                                                SUM(IF(month(transaksi.created_at) = 10, total_jumlah_pesanan, 0)) as oktober,
                                                SUM(IF(month(transaksi.created_at) = 11, total_jumlah_pesanan, 0)) as november,
                                                SUM(IF(month(transaksi.created_at) = 12, total_jumlah_pesanan, 0)) as desember,
                                                SUM(total_jumlah_pesanan) as total
                                            FROM transaksi
                                            WHERE YEAR(transaksi.created_at) = YEAR(CURRENT_DATE) AND transaksi.status = 'selesai'";

    $monthresult = mysqli_query($conn, $monthquery);
    $terjualresult = mysqli_query($conn, $terjualquery);
    $monthrow = mysqli_fetch_assoc($monthresult);
    $terjualrow = mysqli_fetch_assoc($terjualresult);

    $terjual_total = array(
        'januari' => $terjualrow['januari'],
        'februari' => $terjualrow['februari'],
        'maret' => $terjualrow['maret'],
        'april' => $terjualrow['april'],
        'mei' => $terjualrow['mei'],
        'juni' => $terjualrow['juni'],
        'juli' => $terjualrow['juli'],
        'agustus' => $terjualrow['agustus'],
        'september' => $terjualrow['september'],
        'oktober' => $terjualrow['oktober'],
        'november' => $terjualrow['november'],
        'desember' => $terjualrow['desember'],
    );

    $month_harga = array(
        'januari' => $monthrow['januari'],
        'februari' => $monthrow['februari'],
        'maret' => $monthrow['maret'],
        'april' => $monthrow['april'],
        'mei' => $monthrow['mei'],
        'juni' => $monthrow['juni'],
        'juli' => $monthrow['juli'],
        'agustus' => $monthrow['agustus'],
        'september' => $monthrow['september'],
        'oktober' => $monthrow['oktober'],
        'november' => $monthrow['november'],
        'desember' => $monthrow['desember'],
    );

    $valonly_month = array_values($month_harga);
    $valonly_terjual = array_values($terjual_total);
}


?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading d-flex justify-content-between">
                        <h5 class="">Laporan Pendapatan Tahun Ini</h5>
                        <button class="btn btn-sm btn-primary">
                            Download
                        </button>
                    </div>

                    <div class="widget-content">
                        <div id="revenueMonthly"></div>
                    </div>
                </div>
            </div>


            <div class="col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Laporan Penjualan Tahun Ini</h5>
                    </div>

                    <div class="widget-content">
                        <div id="revenueMonthly2"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    var options1 = {
        chart: {
            fontFamily: 'Nunito, sans-serif',
            height: 365,
            type: 'area',
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: true,
                opacity: 0.2,
                blur: 10,
                left: -7,
                top: 22
            },
            toolbar: {
                show: false
            },
            events: {
                mounted: function(ctx, config) {
                    const highest1 = ctx.getHighestValueInSeries(0);
                    const highest2 = ctx.getHighestValueInSeries(1);

                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
                        y: highest1,
                        label: {
                            style: {
                                cssClass: 'd-none'
                            }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#1b55e2" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })

                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
                        y: highest2,
                        label: {
                            style: {
                                cssClass: 'd-none'
                            }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#e7515a" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })
                },
            }
        },
        colors: ['#1b55e2', '#e7515a'],
        dataLabels: {
            enabled: false
        },
        markers: {
            discrete: [{
                seriesIndex: 0,
                dataPointIndex: 7,
                fillColor: '#000',
                strokeColor: '#000',
                size: 5
            }, {
                seriesIndex: 2,
                dataPointIndex: 11,
                fillColor: '#000',
                strokeColor: '#000',
                size: 4
            }]
        },
        subtitle: {
            text: formatRupiah('<?= $monthrow["total"] ?>'),
            align: 'left',
            margin: 0,
            offsetX: 95,
            offsetY: 0,
            floating: false,
            style: {
                fontSize: '18px',
                color: '#4361ee'
            }
        },
        title: {
            text: 'Total',
            align: 'left',
            margin: 0,
            offsetX: -10,
            offsetY: 0,
            floating: false,
            style: {
                fontSize: '18px',
                color: '#0e1726'
            },
        },
        stroke: {
            show: true,
            curve: 'smooth',
            width: 2,
            lineCap: 'square'
        },
        series: [{
            name: 'Uang Masuk',
            data: [<?php echo implode(',', $valonly_month); ?>]
        }],
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        xaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                show: true
            },
            labels: {
                offsetX: 0,
                offsetY: 5,
                style: {
                    fontSize: '12px',
                    fontFamily: 'Nunito, sans-serif',
                    cssClass: 'apexcharts-xaxis-title',
                },
            }
        },
        yaxis: {
            labels: {
                formatter: function(value, index) {
                    return (value / 1000) + 'K'
                },
                offsetX: -22,
                offsetY: 0,
                style: {
                    fontSize: '12px',
                    fontFamily: 'Nunito, sans-serif',
                    cssClass: 'apexcharts-yaxis-title',
                },
            }
        },
        grid: {
            borderColor: '#e0e6ed',
            strokeDashArray: 5,
            xaxis: {
                lines: {
                    show: true
                }
            },
            yaxis: {
                lines: {
                    show: false,
                }
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: -10
            },
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            offsetY: -50,
            fontSize: '16px',
            fontFamily: 'Nunito, sans-serif',
            markers: {
                width: 10,
                height: 10,
                strokeWidth: 0,
                strokeColor: '#fff',
                fillColors: undefined,
                radius: 12,
                onClick: undefined,
                offsetX: 0,
                offsetY: 0
            },
            itemMargin: {
                horizontal: 0,
                vertical: 20
            }
        },
        tooltip: {
            theme: 'dark',
            marker: {
                show: true,
            },
            x: {
                show: false,
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                type: "vertical",
                shadeIntensity: 1,
                inverseColors: !1,
                opacityFrom: .28,
                opacityTo: .05,
                stops: [45, 100]
            }
        },
        responsive: [{
            breakpoint: 575,
            options: {
                legend: {
                    offsetY: -30,
                },
            },
        }]
    }

    var options2 = {
        chart: {
            fontFamily: 'Nunito, sans-serif',
            height: 365,
            type: 'area',
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: true,
                opacity: 0.2,
                blur: 10,
                left: -7,
                top: 22
            },
            toolbar: {
                show: false
            },
            events: {
                mounted: function(ctx, config) {
                    const highest1 = ctx.getHighestValueInSeries(0);
                    const highest2 = ctx.getHighestValueInSeries(1);

                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
                        y: highest1,
                        label: {
                            style: {
                                cssClass: 'd-none'
                            }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#1b55e2" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })

                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
                        y: highest2,
                        label: {
                            style: {
                                cssClass: 'd-none'
                            }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#e7515a" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })
                },
            }
        },
        colors: ['#1b55e2', '#e7515a'],
        dataLabels: {
            enabled: false
        },
        markers: {
            discrete: [{
                seriesIndex: 0,
                dataPointIndex: 7,
                fillColor: '#000',
                strokeColor: '#000',
                size: 5
            }, {
                seriesIndex: 2,
                dataPointIndex: 11,
                fillColor: '#000',
                strokeColor: '#000',
                size: 4
            }]
        },
        subtitle: {
            text: formatRupiah('<?= $terjualrow["total"] ?>'),
            align: 'left',
            margin: 0,
            offsetX: 95,
            offsetY: 0,
            floating: false,
            style: {
                fontSize: '18px',
                color: '#4361ee'
            }
        },
        title: {
            text: 'Total',
            align: 'left',
            margin: 0,
            offsetX: -10,
            offsetY: 0,
            floating: false,
            style: {
                fontSize: '18px',
                color: '#0e1726'
            },
        },
        stroke: {
            show: true,
            curve: 'smooth',
            width: 2,
            lineCap: 'square'
        },
        series: [{
            name: 'Menu Terjual',
            data: [<?php echo implode(',', $valonly_terjual); ?>]
        }],
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        xaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                show: true
            },
            labels: {
                offsetX: 0,
                offsetY: 5,
                style: {
                    fontSize: '12px',
                    fontFamily: 'Nunito, sans-serif',
                    cssClass: 'apexcharts-xaxis-title',
                },
            }
        },
        yaxis: {
            labels: {
                formatter: function(value, index) {
                    return (value)
                },
                offsetX: -22,
                offsetY: 0,
                style: {
                    fontSize: '12px',
                    fontFamily: 'Nunito, sans-serif',
                    cssClass: 'apexcharts-yaxis-title',
                },
            }
        },
        grid: {
            borderColor: '#e0e6ed',
            strokeDashArray: 5,
            xaxis: {
                lines: {
                    show: true
                }
            },
            yaxis: {
                lines: {
                    show: false,
                }
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: -10
            },
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            offsetY: -50,
            fontSize: '16px',
            fontFamily: 'Nunito, sans-serif',
            markers: {
                width: 10,
                height: 10,
                strokeWidth: 0,
                strokeColor: '#fff',
                fillColors: undefined,
                radius: 12,
                onClick: undefined,
                offsetX: 0,
                offsetY: 0
            },
            itemMargin: {
                horizontal: 0,
                vertical: 20
            }
        },
        tooltip: {
            theme: 'dark',
            marker: {
                show: true,
            },
            x: {
                show: false,
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                type: "vertical",
                shadeIntensity: 1,
                inverseColors: !1,
                opacityFrom: .28,
                opacityTo: .05,
                stops: [45, 100]
            }
        },
        responsive: [{
            breakpoint: 575,
            options: {
                legend: {
                    offsetY: -30,
                },
            },
        }]
    }

    var chart1 = new ApexCharts(
        document.querySelector("#revenueMonthly"),
        options1
    );

    var chart2 = new ApexCharts(
        document.querySelector("#revenueMonthly2"),
        options2
    );

    chart1.render();
    chart2.render();
</script>