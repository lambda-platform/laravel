<template>
    <section class="page page-report">
        <div class="report-filter">
            <h4 class="header">Мэдээлэл шүүх /Pivot/</h4>
            <Form>
                <FormItem>
                    <Row>
                        <Col span="11">
                            <DatePicker type="date" v-model="pivotModel.start"
                                        placeholder="Эхлэх огноо"></DatePicker>
                        </Col>
                        <Col span="2" style="text-align: center">-</Col>
                        <Col span="11">
                            <DatePicker type="date" v-model="pivotModel.end"
                                        placeholder="Дуусах огноо"></DatePicker>
                        </Col>
                    </Row>
                </FormItem>

                <FormItem>
                    <Select v-model="pivotModel.aimag" clearable placeholder="Аймаг" :disabled="isUserValid" @on-change="getSum">
                        <Option v-for="item in aimag" :key="item.index" :value="item.id">
                            {{ item.ner }}
                        </Option>
                    </Select>
                </FormItem>

                <FormItem>
                    <Select v-model="pivotModel.sum" clearable placeholder="Сум">
                        <Option v-for="item in sum" :key="item.index" :value="item.id">
                            {{ item.ner }}
                        </Option>
                    </Select>
                </FormItem>

                <div class="divider"></div>
                <FormItem>
                    <Select v-model="pivotModel.zahialgaTuluv" placeholder="Захиалга төлөв">
                        <Option v-for="item in zahialgaTuluv" :key="item.index" :value="item.id">
                            {{ item.ner }}
                        </Option>
                    </Select>
                </FormItem>

                <FormItem>
                    <Select v-model="pivotModel.countType" placeholder="Анализын утга">
                        <Option v-for="item in countType" :key="item.index" :value="item.val">
                            {{ item.label }}
                        </Option>
                    </Select>
                </FormItem>


                <FormItem>
                    <Select v-model="pivotModel.btype" placeholder="Хөрөнгийн төрөл">
                        <Option v-for="item in goalConst" :key="item.index" :value="item.id">
                            {{ item.ner }}
                        </Option>
                    </Select>
                </FormItem>

                <FormItem>
                    <Select v-model="pivotModel.row" clearable placeholder="Мөр">
                        <Option v-for="item in pivotFields" :key="item.index" :value="item.val">
                            {{ item.label }}
                        </Option>
                    </Select>
                </FormItem>

                <FormItem>
                    <Select v-model="pivotModel.col" clearable placeholder="Багана">
                        <Option v-for="item in pivotFieldsCol" :key="item.index" :value="item.val">
                            {{ item.label }}
                        </Option>
                    </Select>
                </FormItem>

                <FormItem>
                    <Select v-model="pivotModel.aggregation" placeholder="Томьёо">
                        <Option v-for="item in aggregations" :key="item.index" :value="item.val">
                            {{ item.label }}
                        </Option>
                    </Select>
                </FormItem>

                <FormItem>
                    <Button type="primary" @click="pivot" long>Шүүх</Button>
                </FormItem>
            </Form>
        </div>
        <div class="report-section">
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
                                <strong>{{ pivotModel.aggregation == 'sum' ? 'Нийлбэр дүн' : 'Дундаж дүн' }}</strong>
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

        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                loading: false,
                isUserValid:0,
                pivotModel: {
                    'aimag': null,
                    'sum': null,
                    'start': null,
                    'end': null,
                    'zahialgaTuluv':null,
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
                zahialgaTuluv:[],

                detail: null,
                chart: {
                    legend: [],
                    data: [],
                    width: 300
                }
            }
        },

        computed: {
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

        created() {
            this.getAimag();
            this.getConst(5);
            this.getZahialgaTuluv(98);
        },

        methods: {
            getAimag() {
                axios.get('/mcud/report/aimag').then(o => {
                    this.aimag = o.data;
                    if(window.init.role==27)
                    {
                        this.isUserValid=1;
                        this.pivotModel.aimag=window.init.user.aimag_id;
                        this.getSum(window.init.user.aimag_id);
                    }
                })
            },

            getSum(id) {
                axios.get('/mcud/report/sum/' + id).then(o => {
                    this.sum = o.data;
                })
            },

            getConst(id) {
                axios.get('/mcud/const/' + id).then(o => {
                    this.goalConst = o.data;
                })
            },

            getZahialgaTuluv(id) {
                axios.get('/mcud/const/' + id).then(o => {
                    this.zahialgaTuluv = o.data;
                })
            },

            pivot() {
                this.loading = true;
                if (this.pivotModel.row == null) {
                    this.$Message.error('Pivot мөрийн утгыг сонгоно уу');
                    return false;
                }

                axios.post('/mcud/report/pivot', this.pivotModel).then(o => {
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
        }
    }
</script>
