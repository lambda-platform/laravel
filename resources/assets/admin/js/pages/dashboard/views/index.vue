<template>
    <section class="page">
        <paper-header class="mini">
            <div slot="left">

            </div>
            <div slot="right">
                <user-control>
                    <a slot="firstPane" href="#" class="ivu-btn ivu-btn-success">
                            {{info.today}}
                    </a>
                </user-control>
            </div>

            <div slot="nav">
                <ul>
                    <li>
                        <router-link to="/dashboard">
                            <Icon type="ios-analytics"/>
                            <span>Мэдээллийн самбар</span>
                        </router-link>
                    </li>

                </ul>

            </div>

        </paper-header>
        <section class="page page-dashboard">
            <Row>
                <Col :xs="24" :sm="24" :md="18" :lg="18">
                    <div class="board map-wrapper">
                        <h3>Улаанбаатар хотод захиалга авч буй орон сууцны тоо, дүүргээр</h3>
                        <div id="map"></div>
                    </div>
                </Col>
                <Col :xs="24" :sm="24" :md="6" :lg="6">
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
                </Col>
            </Row>

            <Row>
                <Col :xs="24" :sm="24" :md="12" :lg="12">
                    <div class="board">
                        <h3 class="no-bg">Улаанбаатар хотод захиалга авч буй орон сууцны тоо, зэрэглэлээр</h3>
                        <div class="board-content">
                            <div id="zereglel" style="height: 400px"></div>
                        </div>
                    </div>
                </Col>

                <Col :xs="24" :sm="24" :md="12" :lg="12">
                    <div class="board">
                        <h3 class="no-bg">Улаанбаатар хотод захиалга авч буй орон сууцны тоо, талбайн хэмжээгээр</h3>
                        <div class="board-content">
                            <div id="area" style="height: 400px"></div>
                        </div>
                    </div>
                </Col>
            </Row>
        </section>
        <Spin fix v-if="loading"></Spin>
    </section>
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
                talbai:{
                    data:[]
                }
            };
        },
        created() {
            this.getInfo();
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
            }
        },

        methods: {
            getInfo() {
                let url='/mcud/report/getSlideInfo';
                if(window.init.role ==27)
                {
                    url='/mcud/report/getSlideInfoByCountry';
                }
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
                    this.talbai.data=[5482,12307,7215,2625,2160,1362,1479];
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
            }
        },
        mounted() {
            this.drawAreaChart();
        }
    };
</script>
