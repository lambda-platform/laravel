<template>
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/#/index">Нүүр</a></li>
                <li class="breadcrumb-item active" aria-current="page">Барилгын жагсаалт</li>
            </ol>
            <h6 class="slim-pagetitle">Барилгын мэдээлэл жагсаалт</h6>
        </div>

        <div class="row row-sm">
            <div class="col-md-4 col-lg-3">
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

                            <el-divider></el-divider>
                            <el-form-item label="Огноо">
                                <el-select disabled v-model="filter.year" placeholder="Сонгоно уу">
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
                                           @click="filterData(1)"
                                >ШҮҮХ
                                </el-button>
                            </el-form-item>
                        </div>
                    </el-form>
                </div>
            </div>

            <div class="col-md-8 col-lg-9 listings-list">
                Нийт илэрц: {{paginate.total}} барилга /Ашиглалтад орсон, захиалга авч буй/
                <div v-if="loading">
                    <div style="text-align: center; height: 300px; padding-top: 140px">
                        Түр хүлээнэ үү ...
                    </div>
                </div>
                <div v-else-if="!loading && datas.length==0">

                    <div style="text-align: center; height: 300px; padding-top: 140px">
                        Үр дүн олдсонгүй
                    </div>
                </div>
                <div
                    v-else-if="datas.length>0"
                    class="listings-grid__item" v-for="item in datas" :key="item.id">
                    <a
                        :href="`/#/apartmentdetail/${item.id}`" class="media">
                        <div class="pull-left listings-grid__main">
                            <div class="list-thumb"
                                 :style="renderImg(item.bimage)"></div>
                        </div>

                        <div class="media-body">
                            <div class="listings-grid__body">
                                <small>
                                    <i class="ti-location-pin"></i>
                                    {{ item.aimag }}, {{ item.soum }}, {{ item.bag }}
                                </small>
                                <h5>
                                    {{ item.hothonner }} - {{ item.ner }}
                                </h5>
                            </div>

                            <ul class="listings-grid__attrs">
                                <li>
                                    <i class="ti-time"></i>
                                    {{ item.updated_at }}
                                </li>
                                <li>
                                    <i class="ti-view-grid"></i>
                                    {{item.ail_too}} айл
                                </li>
                                <li>
                                    <i class="ti-ruler"></i>  {{item.davhar_too}} давхар
                                </li>
                            </ul>
                        </div>
                    </a>

                </div>

                <div style="text-align: center">
                    <el-pagination
                        background
                        layout="total, prev, pager, next"
                        :total="paginate.total"
                        :page-size="12"
                        @current-change="filterData">
                    </el-pagination>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "apartments",
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
                    year: 2020
                },
                data: window.init.data,
                sumlist: window.init.data.sum,
                loading: true,
                datas: [],
                paginate: {
                    currentPage: 1,
                    paginate: 12,
                    total: 0
                }
            }
        },
        created() {
            this.filterData(1);
        },
        methods: {
            filterData(page) {
                this.loading = true;
                this.datas = [];
                axios.post("/getoslist?page=" + page, this.filter).then(({data}) => {
                    console.log(data);
                    this.datas = data.data;
                    this.paginate.total = data.total;
                    this.paginate.currentPage = data.current_page;
                    this.loading = false;
                });

            },
            aimagChanges(val) {
                this.sumlist = [];
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
            renderImg(path) {
                if(path ==null)
                    return {'background-image':'url("/assets/zipcode/images/unnamed.png")'};
                return {'background': 'url("' + path.replace(/\\/g, '/') + '")'};
            }
        }
    }
</script>

