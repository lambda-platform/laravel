<template>
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/#/index">Нүүр</a></li>
                <li class="breadcrumb-item active" aria-current="page">Инфограф</li>
            </ol>
            <h6 class="slim-pagetitle">Тоон үзүүлэлтээр / {{info.today}} байдлаар</h6>
        </div>
        <div class="row row-sm dashboard">
            <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                <div class="board map-wrapper">
                    <h3>Улаанбаатар хотод захиалга авч буй орон сууцны тоо, дүүргээр</h3>
                    <div id="map"></div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                <div>
                    <div class="statistic">

                        <div class="parent purple">
                            <h1>
                                {{ info.niitOronSuutsniiTusul }}
                            </h1>
                            <small>Нийтийн орон сууцны төсөл хэрэгжиж байна</small>
                        </div>
                        <div class="parent-children">
                                <span class="cyan">
                                    <small>Ашиглалтанд орсон <h1>{{ info.niitOronSuutsniiTusulAOrson }}</h1> айлын орон сууц</small>
                                </span>
                            <span class="gold">
                                    <small>Ашиглалтанд ороогүй<h1>{{ info.niitOronSuutsniiTusulAOroogui }}</h1> айлын орон сууц</small>
                                </span>
                        </div>
                        <div class="next">
                            <span>Эдгээрээс борлогдоогүй</span>

                            <a href="javascript:void(0)" class="arrow-container">
                                <div class="arrow"></div>
                                <div class="arrow"></div>
                                <div class="arrow"></div>
                            </a>
                        </div>
                        <div class="parent-children">
                                <span class="cyan">
                                    <small>Ашиглалтанд орсон <h1>{{ info.niitOronSuutsniiTusulAOrsonBorlogdoogui }}</h1> айлын орон сууц</small>
                                </span>
                            <span class="gold">
                                    <small>Ашиглалтанд ороогүй<h1>{{ info.niitOronSuutsniiTusulAOrooguiBorlogdoogui }}</h1> айлын орон сууц</small>
                                </span>
                        </div>
                        <div class="parent purple">
                            <h1>
                                {{ info.niitOronSuutsniiNiiluulelt }}
                            </h1>
                            <small>Нийт орон сууцны нийлүүлэлт</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-sm dashboard">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="board">
                    <h3 class="no-bg">Улаанбаатар хотод захиалга авч буй орон сууцны тоо, зэрэглэлээр</h3>
                    <div class="board-content">
                        <div id="zereglel" style="height: 400px"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="board">
                    <h3 class="no-bg">Улаанбаатар хотод захиалга авч буй орон сууцны тоо, талбайн хэмжээгээр</h3>
                    <div class="board-content">
                        <div id="area" style="height: 400px"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">

            </ol>
            <h6 class="slim-pagetitle">Мэдээлэл шүүх /Pivot/</h6>
        </div>
        <section class="page page-report">
            <div class="row row-sm">
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div class="report-filter">
                        <h4 class="header">Шүүж харна уу</h4>
                        <el-form id="filterFrm" :model="pivotModel" label-position="top">
                            <el-form-item>

                                        <el-date-picker
                                            v-model="pivotModel.start"
                                            type="date"
                                            placeholder="Эхлэх огноо">
                                        </el-date-picker>


                                        <el-date-picker
                                            v-model="pivotModel.end"
                                            type="date"
                                            placeholder="Дуусах огноо">
                                        </el-date-picker>

                            </el-form-item>

                            <el-form-item>
                                <el-select clearable v-model="pivotModel.aimag" placeholder="Аймаг/Нийслэл"
                                           @change="getSum">
                                    <el-option
                                        v-for="item in aimag"
                                        :label="item.ner"
                                        :value="item.id"
                                        :key="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>

                            <el-form-item>
                                <el-select clearable v-model="pivotModel.sum" placeholder="Сум/Дүүрэг">
                                    <el-option
                                        v-for="item in sum"
                                        :label="item.ner"
                                        :value="item.id"
                                        :key="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>

                            <div class="divider"></div>
                            <el-form-item>
                                <el-select clearable v-model="pivotModel.zahialgaTuluv" placeholder="Захиалга төлөв">
                                    <el-option
                                        v-for="item in zahialgaTuluv"
                                        :label="item.ner"
                                        :value="item.id"
                                        :key="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>

                            <el-form-item>
                                <el-select clearable v-model="pivotModel.countType" placeholder="Сонгоно уу">
                                    <el-option
                                        v-for="item in countType"
                                        :label="item.label"
                                        :value="item.val"
                                        :key="item.val">
                                    </el-option>
                                </el-select>
                            </el-form-item>


                            <el-form-item>
                                <el-select clearable v-model="pivotModel.btype" placeholder="Хөрөнгийн төрөл">
                                    <el-option
                                        v-for="item in goalConst"
                                        :label="item.ner"
                                        :value="item.id"
                                        :key="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>

                            <el-form-item>
                                <el-select clearable v-model="pivotModel.row" placeholder="Мөр">
                                    <el-option
                                        v-for="item in pivotFields"
                                        :label="item.label"
                                        :value="item.val"
                                        :key="item.val">
                                    </el-option>
                                </el-select>
                            </el-form-item>

                            <el-form-item>
                                <el-select clearable v-model="pivotModel.col" placeholder="Багана">
                                    <el-option
                                        v-for="item in pivotFieldsCol"
                                        :label="item.label"
                                        :value="item.val"
                                        :key="item.val">
                                    </el-option>
                                </el-select>
                            </el-form-item>

                            <el-form-item>
                                <el-select clearable v-model="pivotModel.aggregation" placeholder="Томьёо">
                                    <el-option
                                        v-for="item in aggregations"
                                        :label="item.label"
                                        :value="item.val"
                                        :key="item.val">
                                    </el-option>
                                </el-select>
                            </el-form-item>

                            <el-form-item>
                                <el-button type="primary" icon="el-icon-search"
                                           @click="pivot"
                                >ШҮҮХ</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
                <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12 report-section">
                    <div class="card" :style="{width: chart.width}">
                        <div class="card-header">
                            <h3 class="title">График мэдээлэл</h3>
                        </div>
                        <div class="card-body">
                            <Spin fix v-if="loading"></Spin>
                            <div class="data-layer-holder" v-if="dataList.length == 0">
                                <p style="margin-top: -120px !important;">Мэдээллээ шүүж харна уу</p>
                            </div>
                            <div id="chart" style="height: 400px"></div>
                        </div>
                    </div>

                    <div class="pivot-table">
                        <div class="table-header">
                            <h3 class="title">Хүснэгтэн мэдээлэл</h3>
                            <div class="tool">
                                <a href="javascript:void(0)"><i class="ti ti-download"></i> Excel-р татах</a>
                                <span></span>
                                <a href="javascript:void(0)"><i class="ti ti-printer"></i>Хэвлэх</a>
                            </div>
                        </div>
                        <div class="table-wrap">
                            <Spin fix v-if="loading"></Spin>
                            <div class="data-layer-holder" v-if="dataList.length == 0">
                                Мэдээллээ шүүж харна уу
                            </div>
                            <table cellspacing="0" cellpadding="0">
                                <thead v-if="header.length > 1">
                                <th v-for="item in header" :key="item.index">
                                    {{ item }}
                                </th>
                                </thead>
                                <thead v-else>
                                <th colspan="2" v-for="item in header" :key="item.index">
                                    {{ item }}
                                </th>
                                </thead>
                                <tbody>

                                <tr v-for="item in dataList" :key="item.index">
                                    <td v-for="col in item" :key="col.index">
                                        {{ col }}
                                    </td>
                                </tr>

                                <tr v-if="dataList.length > 0">
                                    <td>
                                        <strong>{{ pivotModel.aggregation == 'sum' ? 'Нийлбэр дүн' : 'Дундаж дүн'
                                            }}</strong>
                                    </td>
                                    <td v-for="item in aggVals" :key="item.index">
                                        <strong v-if="pivotModel.aggregation == 'sum'">{{ item }}</strong>
                                        <strong v-else>{{ parseFloat(item/(dataList.length)).toFixed(2) }}</strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--<div class="table-footer">-->
                        <!--Үр дүн-->
                        <!--</div>-->
                    </div>
                </div>
            </div>

        </section>
    </div>
</template>

<script>
    import 'amcharts3/amcharts/amcharts'
    import 'amcharts3/amcharts/serial'
    import 'ammap3'
    import 'ammap3/ammap/maps/js/mongoliaLow'

    export default {

        data() {
            return {
                loading: true,
                info: {},
                images: [],
                title: '',
                zereglel: {
                    data: [],
                    legend: []
                },
                talbai: {
                    data: []
                },

                //pivot
                isUserValid: 0,
                pivotModel: {
                    'aimag': null,
                    'sum': null,
                    'start': null,
                    'end': null,
                    'zahialgaTuluv': null,
                    'countType': 0,
                    'btype': 4,
                    'col': null,
                    'row': null,
                    'aggregation': 'sum'
                },
                aggVals: [],
                info: {
                    total: 0,
                    currenPage: 1,
                    paginate: 50,
                },
                countType: [
                    {
                        label: 'Айлын тоогоор',
                        val: 0
                    },
                    {
                        label: 'Төслийн тоогоор',
                        val: 1
                    }
                ],
                aggregations: [
                    {
                        label: 'Нийлбэр харуулах',
                        val: 'sum'
                    },
                    {
                        label: 'Дунджаар харуулах',
                        val: 'avg'
                    },
                ],
                pivotFields: [
                    {
                        label: 'Өрөөний тоо',
                        val: 'room'
                    },
                    {
                        label: 'Зэрэглэл',
                        val: 'zereglel'
                    },
                    {
                        label: 'Хийц',
                        val: 'hiits'
                    }
                ],
                pivotFieldsCol: [
                    {
                        label: 'Зэрэглэл',
                        val: 'zereglel'
                    },
                    {
                        label: 'Хийц',
                        val: 'hiits'
                    }
                ],
                dataList: [],
                header: [],
                barChartHeader: [],
                barChartData: [],
                aimag: [],
                sum: [],
                goalConst: [],
                zahialgaTuluv: [],

                detail: null,
                chart: {
                    legend: [],
                    data: [],
                    width: 300
                }
            };
        },
        created() {
            this.getInfo();
            this.getAimag();
            this.getConst(5);
            this.getZahialgaTuluv(98);
        },

        computed: {
            duuregData() {
                return this.info.duureg;
            },
            zereglelData() {
                return {
                    title: "",
                    tooltip: {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    legend: {
                        top: 10,
                        left: 'center',
                        data: this.zereglel.legend,
                    },
                    series: [
                        {
                            name: 'Орон сууцны зэрэглэл',
                            type: 'pie',
                            radius: '55%',
                            center: ['50%', '60%'],
                            data: this.zereglel.data,
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }
                    ]
                };
            },

            areaData() {
                return {
                    title: "",
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        }
                    },
                    legend: {
                        data: ['Талбайн хэмжээ']
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis: {
                        type: 'value',
                        boundaryGap: [0, 0.01]
                    },
                    yAxis: {
                        type: 'category',
                        data: ['40 мкв хүртэл', '41-60 ', '61-80 мкв', '81-100 мкв', '101-120 мкв', '121-150 мкв', '150 мкв-с дээш']
                    },
                    series: [
                        {
                            name: '',
                            type: 'bar',
                            data: this.talbai.data
                        }
                    ]
                }
            },

            pieChartOption() {
                return {
                    toolbox: {
                        feature: {
                            restore: {show: true},
                            saveAsImage: {show: true}
                        }
                    },
                    tooltip: {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    legend: {
                        type: 'scroll',
                        orient: 'horizontal',
                        data: this.chart.legend,
                        bottom: 'bottom'
                    },
                    series: [
                        {
                            name: this.header,
                            type: 'pie',
                            data: this.chart.data,
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }
                    ]
                };

            },

            barChartOption() {
                return {
                    toolbox: {
                        feature: {
                            magicType: {show: true, type: ['line', 'bar']},
                            restore: {show: true},
                            saveAsImage: {show: true}
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        }
                    },
                    legend: {
                        bottom: 'bottom',
                        type: 'scroll',
                        orient: 'horizontal',
                        data: this.chart.legend
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '10%',
                        containLabel: true
                    },
                    xAxis: [
                        {
                            type: 'category',
                            data: this.barChartHeader,
                            axisLabel: {
                                interval: 0,
                                rotate: 70
                            },
                            drawTicks: true
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value'
                        }
                    ],
                    series: this.chart.data
                };
            }
        },

        methods: {
            getInfo() {
                let url = '/report/getSlideInfo';
                axios.get(url).then(o => {
                    this.info = o.data;
                    this.init();

                    o.data.niitOronSuutsniiTusulZereglelBorlogdoogui.forEach(item => {
                        if (item.ner != null) {
                            this.zereglel.legend.push(item.ner);

                            this.zereglel.data.push({
                                value: item.borlogdoogui,
                                name: item.ner
                            })
                        }
                    });

                    //this.talbai.data=[4.53,4.12,6.62,8.04,22.11,37.72,16.80];
                    this.talbai.data = [5482, 12307, 7215, 2625, 2160, 1362, 1479];
                    // ['40 мкв хүртэл', '41-60 ', '61-80 мкв', '81-100 мкв', '101-120 мкв', '121-150 мкв', '150 мкв-с дээш']
                    // o.data.niitOronSuutsniiTusulTalbaiBorlogdoogui.forEach(item => {
                    //
                    //         switch (true) {
                    //             case(parseFloat(item.talbai)<40):
                    //                 this.talbai.data[0]=this.talbai.data[0]+item.borlogdoogui;
                    //                 break;
                    //             case(parseFloat(item.talbai)>40 && parseFloat(item.talbai)<61):
                    //                 this.talbai.data[1]=this.talbai.data[1]+item.borlogdoogui;
                    //                 break;
                    //             case(parseFloat(item.talbai)>60 && parseFloat(item.talbai)<81):
                    //                 this.talbai.data[2]=this.talbai.data[2]+item.borlogdoogui;
                    //                 break;
                    //             case(parseFloat(item.talbai)>80 && parseFloat(item.talbai)<101):
                    //                 this.talbai.data[3]=this.talbai.data[3]+item.borlogdoogui;
                    //                 break;
                    //             case(parseFloat(item.talbai)>100 && parseFloat(item.talbai)<121):
                    //                 this.talbai.data[4]=this.talbai.data[4]+item.borlogdoogui;
                    //                 break;
                    //             case(parseFloat(item.talbai)>120 && parseFloat(item.talbai)<151):
                    //                 this.talbai.data[5]=this.talbai.data[5]+item.borlogdoogui;
                    //                 break;
                    //             case(parseFloat(item.talbai)>150):
                    //                 this.talbai.data[6]=this.talbai.data[6]+item.borlogdoogui;
                    //                 break
                    //
                    //         }
                    // });

                    this.drawZereglelChart();
                    this.drawAreaChart();

                    this.loading = false;
                })
            },

            init() {
                window.AmCharts.makeChart('map', {
                    type: "map",
                    // theme: "light",
                    export: {
                        enabled: false
                    },
                    zoomOnDoubleClick: false,
                    dataProvider: {
                        mapURL: "/assets/mcud/images/mongolia.svg",
                        getAreasFromMap: true,
                        images: this.duuregData,
                        lines: [
                            {
                                "latitudes": [48, 51.5],
                                "longitudes": [107, 106]
                            },
                            //bagahangai    
                            {
                                "latitudes": [48, 51.5],
                                "longitudes": [107, 111]
                            },
                            {
                                "latitudes": [48, 51.5],
                                "longitudes": [107, 116]
                            }, {
                                "latitudes": [48, 42.5],
                                "longitudes": [107, 90]
                            }, {
                                "latitudes": [48, 42.5],
                                "longitudes": [107, 95]
                            }, {
                                "latitudes": [48, 42.5],
                                "longitudes": [107, 100]
                            }, {
                                "latitudes": [48, 42.5],
                                "longitudes": [107, 107]
                            }, {
                                "latitudes": [48, 42.5],
                                "longitudes": [107, 112]
                            }, {
                                "latitudes": [48, 42.5],
                                "longitudes": [107, 117]
                            }
                        ],
                        areas: [
                            {
                                id: "011",
                                color: "#2f3542"
                            },
                            {
                                id: "01111",
                                color: "#8AD542"
                            },
                            {
                                id: "01110",
                                color: "#8AD542"
                            },
                            {
                                id: "01119",
                                color: "#8AD542"
                            },
                            {
                                id: "01125",
                                color: "#8AD542"
                            },
                            {
                                id: "01101",
                                color: "#8AD542"
                            },
                            {
                                id: "01107",
                                color: "#8AD542"
                            },
                            {
                                id: "01122",
                                color: "#8AD542"
                            },
                            {
                                id: "01116",
                                color: "#8AD542"
                            },
                        ],
                    },
                    linesSettings: {
                        color: "#8AD542",
                        alpha: 1,
                        dashLength: 3,
                        thickness: 1,
                        arc: -0.2
                    },
                    areasSettings: {
                        autoZoom: false,
                        color: "#747d8c",
                        rollOverOutlineColor: "#FFFFFF",
                    },
                    zoomControl: {
                        homeButtonEnable: true,
                        panControlEnabled: false,
                        zoomControlEnabled: true,
                        top: 0,
                        right: 0
                    },
                    imagesSettings: {
                        labelColor: "#fff",
                        labelPosition: "middle"
                    },
                });

                setTimeout(() => {
                    document.querySelector('[title="Interactive JavaScript maps"]').remove();
                }, 500)
            },

            drawZereglelChart() {
                let dom = document.getElementById("zereglel");
                let chart = echarts.init(dom, 'macarons');
                if (this.zereglelData && typeof this.zereglelData === "object") {
                    chart.setOption(this.zereglelData, true);
                }
            },

            drawAreaChart() {
                let dom = document.getElementById("area");
                let chart = echarts.init(dom, 'macarons');
                if (this.areaData && typeof this.areaData === "object") {
                    chart.setOption(this.areaData, true);
                }
            },
            //pivot
            getAimag() {
                axios.get('/report/aimag').then(o => {
                    this.aimag = o.data;
                    if (window.init.role == 27) {
                        this.isUserValid = 1;
                        this.pivotModel.aimag = window.init.user.aimag_id;
                        this.getSum(window.init.user.aimag_id);
                    }
                })
            },

            getSum(id) {
                axios.get('/report/sum/' + id).then(o => {
                    this.sum = o.data;
                })
            },

            getConst(id) {
                axios.get('/const/' + id).then(o => {
                    this.goalConst = o.data;
                })
            },

            getZahialgaTuluv(id) {
                axios.get('/const/' + id).then(o => {
                    this.zahialgaTuluv = o.data;
                })
            },

            pivot() {
                this.loading = true;
                if (this.pivotModel.row == null) {
                    this.$Message.error('Pivot мөрийн утгыг сонгоно уу');
                    return false;
                }

                axios.post('/report/pivot', this.pivotModel).then(o => {
                    this.dataList = o.data.data;
                    this.header = o.data.header;

                    if (this.pivotModel.col == null) {
                        this.drawPieChart(o.data.data);
                    } else {
                        this.drawBarChart(o.data.data, o.data.header);
                    }
                    this.setAggVals();

                    this.loading = false;
                })
            },

            setAggVals() {
                this.aggVals = [];
                this.dataList.forEach(item => {
                    for (let i = 1; i < item.length; i++) {
                        if (this.aggVals[i - 1] == undefined) {
                            this.aggVals[i - 1] = parseInt(item[i]);
                        } else {
                            this.aggVals[i - 1] += parseInt(item[i]);
                        }
                    }
                })
            },

            drawBarChart(data, header) {
                this.chart = {
                    legend: [],
                    data: []
                };
                this.barChartHeader = [];

                for (let i = 1; i < (header.length - 1); i++) {
                    this.barChartHeader.push(header[i]);
                }

                data.forEach(item => {
                    let name = item[0];
                    this.chart.legend.push(name);
                    let d = [];

                    for (let i = 1; i < (item.length - 1); i++) {
                        d.push(item[i]);
                    }

                    let chartItem = {
                        name: name,
                        type: 'bar',
                        data: d
                    };
                    this.chart.data.push(chartItem);
                });

                let dom = document.getElementById("chart");
                let chart = echarts.init(dom, 'macarons');
                if (this.barChartOption && typeof this.barChartOption === "object") {
                    chart.setOption(this.barChartOption, true);
                }
            },

            drawPieChart(data) {
                if (this.header.length > 10) {
                    this.chart.width = 500;
                }

                this.chart = {
                    legend: [],
                    data: []
                };

                data.forEach(item => {
                    this.chart.legend.push(item[0]);
                    this.chart.data.push({value: item[1], name: item[0]});
                });

                let dom = document.getElementById("chart");
                let chart = echarts.init(dom, 'macarons');
                if (this.pieChartOption && typeof this.pieChartOption === "object") {
                    chart.setOption(this.pieChartOption, true);
                }
            }
        },
        mounted() {
            this.drawAreaChart();
        }
    };
</script>
