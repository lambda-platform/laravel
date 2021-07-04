<template>

    <div class="container pd-t-20">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
            </ol>
            <h6 class="slim-pagetitle" style="font-weight: 400;">Монгол улсын шинэ орон сууцны статистик</h6>
        </div>

        <div class="row no-gutters dashboard-chart-one">
            <div class="col-md col-lg-4">
                <div class="card card-revenue">
                    <h6 class="chart-title">Сүүлийн сарын мэдээ</h6>
                    <p>Шинэ орон сууцны мкв-н үнийн статистик </p>
                    <h1>{{ currencyFormat(data.lastMonthAvg)}}₮
                        <span class="tx-success {!! data.monthPercent > 0 ? 'up' : 'down' !!}">
                            {{ data.monthPercent.toFixed(1) }}%
                            <i class="ti-arrow-up" v-if="data.monthPercent > 0"></i>
                            <i class="ti-arrow-down" v-else></i>
                        </span>
                    </h1>
                    <div id="rs3" class="ht-50 ht-sm-70 mg-r--1"></div>
                    <label>Өнгөрсөн сард: <span>{{ currencyFormat(data.previousMonthAvg)}}₮</span></label>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="card card-total">
                    <div>
                        <h1>{{ formatNumber(data.all) }}</h1>
                        <p>Захиалга авч буй нийт төсөл</p>
                    </div>

                    <div>
                        <div class="tx-15 mg-b-10 tx-center op-5">
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-400"></i>
                            <i class="ti ti-package tx-gray-400"></i>
                        </div>
                        <label>Улаанбаатарт ({{ formatNumber(data.allUb) }})</label>
                        <div class="progress mg-b-10">
                            <div
                                :class="`progress-bar bg-primary progress-bar-xs wd-${Math.round(data.allUb*100/data.all)}p`"
                                role="progressbar"
                                :aria-valuenow="`${Math.round(data.allUb*100/data.all)}`" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <label>Орон нутагт ({{ formatNumber(data.allCountry) }})</label>
                        <div class="progress">
                            <div
                                :class="`progress-bar bg-danger progress-bar-xs wd-${Math.round(data.allCountry*100/data.all)}p`"
                                role="progressbar"
                                aria-valuenow="5" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="card card-total">
                    <div>
                        <h1>{{formatNumber(data.niitiin) }}</h1>
                        <p>Үүнээс нийтийн оронсууц</p>
                    </div>
                    <div>
                        <div class="tx-14 mg-b-15 tx-center op-5">
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-400"></i>
                            <i class="ti ti-package tx-gray-400"></i>
                        </div>
                        <label>Улаанбаатарт ({{ formatNumber(data.niitiinUb) }})</label>
                        <div class="progress mg-b-10">
                            <div
                                :class="`progress-bar bg-success progress-bar-xs wd-${Math.round(data.niitiinUb*100/data.niitiin)}p`"
                                role="progressbar"
                                aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <label>Орон нутагт ({{ formatNumber(data.niitiinCountry) }})</label>
                        <div class="progress">
                            <div
                                :class="`progress-bar bg-warning progress-bar-xs wd-${Math.round(data.niitiinCountry*100/data.niitiin)}p`"
                                role="progressbar"
                                aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="card card-total">
                    <div>
                        <h1>{{ formatNumber(data.aminii) }}</h1>
                        <p>Үүнээс амины оронсууц</p>
                    </div>
                    <div>
                        <div class="tx-14 mg-b-10 tx-center op-5">
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-600"></i>
                            <i class="ti ti-package tx-gray-400"></i>
                            <i class="ti ti-package tx-gray-400"></i>
                        </div>

                        <label>Улаанбаатарт ({{ formatNumber(data.aminiiUb) }})</label>
                        <div class="progress mg-b-10">

                            <div v-if="data.aminii>0"
                                 :class="`progress-bar bg-purple progress-bar-xs wd-${Math.round(data.aminiiUb*100/data.aminii)}p`"
                                 role="progressbar"
                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            </div>

                            <div v-else
                                 class="progress-bar bg-purple progress-bar-xs wd-0p" role="progressbar"
                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>

                        </div>

                        <label>Орон нутагт ({{ formatNumber(data.aminiiCountry) }})</label>
                        <div class="progress">

                            <div
                                v-if="data.aminii>0"
                                :class="`progress-bar bg-pink progress-bar-xs wd-${Math.round(data.aminiiCountry*100/data.aminii)}p`"
                                role="progressbar"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                            <div
                                v-else
                                class="progress-bar bg-pink progress-bar-xs wd-0p" role="progressbar"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-statistics mg-b-30">
            <div class="col-md-12 mg-t-20 mg-md-t-0 col-off">
                <div class="card bd pd-l-20 pd-y-30 pd-r-30">
                    <h3 class="chart-title">Орон сууцны дундаж үнэ - Сүүлийн жилд</h3>
                    <canvas id="chartBar2" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <hr>

        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <!--{{<li class="breadcrumb-item"><a href="#">2018 оны статистик мэдээлэл</a></li}}-->
            </ol>
            <h6 class="slim-pagetitle" style="font-weight: 400;">Засаг захиргааны нэгжээр</h6>
        </div>
        <div class="row no-gutters dashboard-chart-one">
            <div class="col-md-3">
                <div class="filter">
                    <el-form id="filterFrm" :model="filter" ref="ruleForm" label-position="top">
                        <div class="card card-body pd-10 mg-t-10">
                            <el-form-item label="Аймаг/Нийслэл сонгох">
                                <el-select v-model="filter.aimag" placeholder="Сонгоно уу"
                                           @change="aimagChanges">
                                    <el-option
                                        v-for="item in data.aimag"
                                        :label="item.ner"
                                        :value="item.id"
                                        :key="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item label="Сум/Дүүрэг сонгох">
                                <el-select v-model="filter.sum" placeholder="Сонгоно уу">
                                    <el-option
                                        v-for="item in sumlist"
                                        :label="item.ner"
                                        :value="item.id"
                                        :key="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item label="Зэрэглэл сонгох">
                                <el-select v-model="filter.zereglel" placeholder="Сонгоно уу">
                                    <el-option
                                        v-for="item in data.zereglel"
                                        :label="item.ner"
                                        :value="item.id"
                                        :key="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <el-divider></el-divider>
                            <el-form-item label="Дундаж үнэ огноогоор шүүх">
                                <el-select v-model="filter.year" placeholder="Сонгоно уу">
                                    <el-option
                                        v-for="item in data.year"
                                        :label="item.ner"
                                        :value="item.ner"
                                        :key="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <br/>
                            <el-form-item class="sbm-btn">
                                <el-button type="primary" icon="el-icon-search"
                                @click="filterData"
                                >ШҮҮХ</el-button>
                            </el-form-item>
                        </div>
                    </el-form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-total">
                            <div>
                                <h1 style="font-size: 44px"
                                    id="totalProjects">0</h1>
                                <p>Нийт барилга</p>
                            </div>

                            <div>
                                <div class="tx-16 mg-b-10 tx-center op-5">
                                    <i class="ti ti-server tx-gray-600"></i>
                                    <i class="ti ti-server tx-gray-600"></i>
                                    <i class="ti ti-server tx-gray-600"></i>
                                    <i class="ti ti-server tx-gray-600"></i>
                                    <i class="ti ti-server tx-gray-600"></i>
                                    <i class="ti ti-server tx-gray-600"></i>
                                    <i class="ti ti-server tx-gray-400"></i>
                                    <i class="ti ti-server tx-gray-400"></i>
                                    <i class="ti ti-server tx-gray-400"></i>
                                    <i class="ti ti-server tx-gray-400"></i>
                                </div>
                                <label>Айлын тоо (<span id="totalObjects">0</span>)</label>
                                <div class="progress mg-b-10">
                                    <div class="progress-bar bg-primary progress-bar-xs wd-100p" role="progressbar"
                                         aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <label id="totalObjectsInActive">Үүнээс захиалга авч буй (0)</label>
                                <div class="progress">
                                    <div id="totalObjectsProggressBar" class="progress-bar bg-success progress-bar-xs"
                                         role="progressbar"
                                         aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-total">
                            <div>
                                <h1 style="font-size: 44px" id="niitiin">0</h1>
                                <p>Нийтийн барилга</p>
                            </div>
                            <div>
                                <div class="tx-16 mg-b-15 tx-center op-5">
                                    <i class="ti ti-package tx-gray-600"></i>
                                    <i class="ti ti-package tx-gray-600"></i>
                                    <i class="ti ti-package tx-gray-600"></i>
                                    <i class="ti ti-package tx-gray-600"></i>
                                    <i class="ti ti-package tx-gray-600"></i>
                                    <i class="ti ti-package tx-gray-600"></i>
                                    <i class="ti ti-package tx-gray-600"></i>
                                    <i class="ti ti-package tx-gray-600"></i>
                                    <i class="ti ti-package tx-gray-400"></i>
                                    <i class="ti ti-package tx-gray-400"></i>
                                </div>
                                <label>Айлын тоо (<span id="niitiinObject">0</span>)</label>
                                <div class="progress mg-b-10">
                                    <div class="progress-bar bg-primary progress-bar-xs wd-100p" role="progressbar"
                                         aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <label id="niitiinObjectInActive">Үүнээс захиалга авч буй (0)</label>
                                <div class="progress">
                                    <div id="niitiinObjectProggressBar"
                                         class="progress-bar bg-success progress-bar-xs wd-0p" role="progressbar"
                                         aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div><!-- card -->
                    </div>

                    <div class="col-md-4">
                        <div class="card card-total">
                            <div>
                                <h1 style="font-size: 44px" id="aminii">0</h1>
                                <p>Амины барилга</p>
                            </div>

                            <div>
                                <div class="tx-16 mg-b-10 tx-center op-5">
                                    <i class="ti ti-server tx-gray-600"></i>
                                    <i class="ti ti-server tx-gray-600"></i>
                                    <i class="ti ti-server tx-gray-600"></i>
                                    <i class="ti ti-server tx-gray-600"></i>
                                    <i class="ti ti-server tx-gray-600"></i>
                                    <i class="ti ti-server tx-gray-600"></i>
                                    <i class="ti ti-server tx-gray-400"></i>
                                    <i class="ti ti-server tx-gray-400"></i>
                                    <i class="ti ti-server tx-gray-400"></i>
                                    <i class="ti ti-server tx-gray-400"></i>
                                </div>

                                <label>Айлын тоо (<span id="aminiiObject">0</span>)</label>
                                <div class="progress mg-b-10">
                                    <div class="progress-bar bg-primary progress-bar-xs wd-100p" role="progressbar"
                                         aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <label id="aminiiObjectInActive">Үүнээс захиалга авч буй (0)</label>
                                <div class="progress">
                                    <div id="aminiiObjectProggressBar"
                                         class="progress-bar bg-success progress-bar-xs wd-0p" role="progressbar"
                                         aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <div class="col-xl-12 mg-t-20 mg-b-20 mg-xl-t-0">
                        <div class="card bd pd-l-20 pd-y-30 pd-r-30">
                            <h3 class="chart-title">Орон сууцны дундаж үнэ</h3>
                            <canvas id="chartBar3" style="max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    let chartData = [];
    let chartLabel = [];
    let ctx2 = null;
    let ctx3 = null;
    let monthChart = null;
    let monthChart1 = null;

    export default {
        data() {
            return {
                filter: {
                    aimag: 22,
                    sum: null,
                    zereglel: null,
                    area: null,
                    room: null,
                    price: null,
                    type: null,
                    year: 2018
                },
                sumlist:window.init.data.sum,
                baglist:[],
                data: window.init.data,
                // duuregData: [parseFloat(window.init.data.duureg['137'] ? window.init.data.duureg['137'] : 0).toFixed(0),
                // parseFloat(window.init.data.duureg['335'] ? window.init.data.duureg['335'] : 0).toFixed(0),
                // parseFloat(window.init.data.duureg['337'] ? window.init.data.duureg['337'] : 0).toFixed(0),
                // parseFloat(window.init.data.duureg['334'] ? window.init.data.duureg['334'] : 0).toFixed(0),
                // parseFloat(window.init.data.duureg['336'] ? window.init.data.duureg['336'] : 0).toFixed(0),
                // parseFloat(window.init.data.duureg['138']? window.init.data.duureg['138'] : 0).toFixed(0),
                // parseFloat(window.init.data.duureg['136'] ? window.init.data.duureg['136'] : 0).toFixed(0),
                // parseFloat(window.init.data.duureg['135'] ? window.init.data.duureg['135'] : 0).toFixed(0),
                // parseFloat(window.init.data.duureg['157'] ? window.init.data.duureg['157'] : 0).toFixed(0)]
            }
        },
        mounted() {
            this.$nextTick(() => {
                let rs3 = new Rickshaw.Graph({
                    element: document.querySelector('#rs3'),
                    renderer: 'line',
                    series: [{
                        data: [
                            {x: 0, y: 5},
                            {x: 1, y: 7},
                            {x: 2, y: 10},
                            {x: 3, y: 11},
                            {x: 4, y: 12},
                            {x: 5, y: 10},
                            {x: 6, y: 9},
                            {x: 7, y: 7},
                            {x: 8, y: 6},
                            {x: 9, y: 8},
                            {x: 10, y: 9},
                            {x: 11, y: 10},
                            {x: 12, y: 7},
                            {x: 13, y: 10}
                        ],
                        color: '#1B84E7',
                    }]
                });

                rs3.render();

                // Responsive Mode
                new ResizeSensor($('.slim-mainpanel'), function () {
                    rs3.configure({
                        width: $('#rs3').width(),
                        height: $('#rs3').height()
                    });
                    rs3.render();
                });

                this.init();
            });
        },
        methods: {
            init() {
                ctx2 = document.getElementById('chartBar2').getContext('2d');
                ctx3 = document.getElementById('chartBar3').getContext('2d');
                monthChart = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: [{
                            label: ' ₮',
                            data: [],
                            borderColor: '#2ecc71',
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false,
                            labels: {
                                display: false
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: false,
                                    fontSize: 10,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    beginAtZero: false,
                                    fontSize: 11
                                }
                            }]
                        }
                    }
                });
                monthChart1 = new Chart(ctx3, {
                    type: 'line',
                    data: {
                        labels: ['1 сар', '2 сар', '3 сар', '4 сар', '5 сар', '6 сар', '7 сар', '8 сар', '9 сар', '10 сар', '11 сар', '12 сар'],
                        datasets: [{
                            label: ' ₮',
                            data: [],
                            borderColor: '#2ecc71',
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false,
                            labels: {
                                display: false
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: false,
                                    fontSize: 10,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    beginAtZero: false,
                                    fontSize: 11
                                }
                            }]
                        }
                    }
                });

                chartData = [];
                chartLabel = [];
                this.data.monthly.forEach(item => {
                    if (item !== null) {
                        chartData.push(item.avg_une.toFixed(0));
                        chartLabel.push(item.month + ' сар')
                    }
                });
                this.updateMonthlyChart(chartData, chartLabel);
                this.filterData();
            },
            updateMonthlyChart(data, labels) {
                monthChart.data.datasets[0].data = data;
                monthChart.data.labels = labels;
                monthChart.update()
            },
            updateMonthlyChart1(data) {
                monthChart1.data.datasets[0].data = data;
                monthChart1.update()
            },
            filterData() {

                axios.post("/filter", this.filter).then((o) => {
                    $('#totalProjects').text(o.data.all);
                    $('#totalObjects').text(o.data.allObject);
                    $('#totalObjectsInActive').text('Үүнээс захиалга авч буй (' + o.data.niitiinObjectInActivePercent + '%)');
                    $('#totalObjectsProggressBar')[0].className = '';
                    $('#totalObjectsProggressBar')[0].className = 'progress-bar bg-success progress-bar-xs wd-' + (parseInt(o.data.niitiinObjectInActivePercent / 5) * 5) + 'p';

                    $('#aminii').text(o.data.aminii);
                    $('#aminiiObject').text(o.data.aminiiObject);
                    $('#aminiiObjectInActive').text('Үүнээс захиалга авч буй (' + o.data.aminiiObjectInActivePercent + '%)');
                    $('#aminiiObjectProggressBar')[0].className = 'progress-bar bg-success progress-bar-xs wd-' + (parseInt(o.data.niitiinObjectInActivePercent / 5) * 5) + 'p';

                    $('#niitiin').text(o.data.niitiin);
                    $('#niitiinObject').text(o.data.niitiinObject);
                    $('#niitiinObjectInActive').text('Үүнээс захиалга авч буй (' + o.data.niitiinObjectInActivePercent + '%)');
                    $('#niitiinObjectProggressBar')[0].className = 'progress-bar bg-success progress-bar-xs wd-' + (parseInt(o.data.niitiinObjectInActivePercent / 5) * 5) + 'p';

                    let chartData1 = [];
                    o.data.monthly.forEach(item => {
                        if (item !== null) {
                            chartData1.push(item.avg_une.toFixed(0));
                        }
                    });
                    this.updateMonthlyChart1(chartData1);
                });

            },
            formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            },
            currencyFormat(num) {
                return num.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            },
            customGetDate(d) {
                return d.substring(0, 10);
            },
            renderImg(path) {
                return 'background-image' + ':' + 'url("' + path.replace(/\\/g, '/') + '")';
            },
            choosePoster(item) {
                this.$router.push('posterdetail/' + item.id);
            },
            relateSelect() {
                this.subcategory = [];
                axios.get("/getSubcategory/" + this.formData.cat1).then(({data}) => {
                    this.subcategory = data;
                });
            },
            aimagChanges(val) {
                this.sumlist=[];
                axios.get('/sumlist/' + val).then(o => {
                    this.sumlist = o.data;
                }).catch(e => {
                    console.log(e.message);
                });
            },
            sumChanges(val) {
                axios.get('/getbaghoroo/' + val).then(o => {
                    this.baglist = o.data;
                }).catch(e => {
                    console.log(e.message);
                });
            },
        }
    };
</script>
