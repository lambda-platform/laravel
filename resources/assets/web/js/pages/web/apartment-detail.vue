<template>
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/#/index">Нүүр</a></li>
                <li class="breadcrumb-item active" aria-current="page">Барилгын дэлгэрэнгүй</li>
            </ol>
            <h6 class="slim-pagetitle" v-if="data">{{ data.hothonner }} - {{ data.ner }}</h6>
        </div>
        <div v-if="loading">
            <div style="text-align: center; height: 300px; padding-top: 140px">
                Түр хүлээнэ үү ...
            </div>
        </div>
        <div v-else class="row row-sm">
            <div class="col-md-8">
                <div class="card">
                    <div class="detail-media">
                        <section class="barilga-detail">
                                <el-carousel indicator-position="outside">
                                    <el-carousel-item v-for="item in imgs" :key="item.id" v-if="imgs.length>0">
                                        <div class="img-item">
                                            <img :src="item.path?item.path:'/assets/mcud/images/unnamed.png'" alt="">
                                            <h3>{{item.desc}}</h3>
                                        </div>
                                    </el-carousel-item>
                                    <el-carousel-item v-else>
                                        <div class="img-item">
                                            <img src="/assets/mcud/images/unnamed.png" alt="">
                                            <h3>Зураг олдсонгүй</h3>
                                        </div>
                                    </el-carousel-item>
                                </el-carousel>
                        </section>
                    </div>

                    <div class="detail-info">
                        <div class="zar-detail">
                            <small>{{ data.aimag }}, {{ data.soum }}, {{ data.bag?data.bag:''}}</small><br/>
                            <small>{{ data.delgerengui }}</small>
                            <br/>
                            <small>Холбоо барих:{{ data.borluulaltBagUtas }}, {{data.borluulatiinBagEmail}}</small>
                        </div>

                        <div class="info-row clearfix">
                            <div class="row">
                                <div class="col-md-8 col-sm-12 info-section">
                                    <h4>Үндсэн мэдээлэл</h4>

                                    <table class="table table-small table-striped">
                                        <tbody>
                                        <tr>
                                            <td>Хотхон</td>
                                            <td>{{ data.hothonner }}</td>
                                        </tr>

                                        <tr>
                                            <td>Нэр</td>
                                            <td>{{ data.ner }}</td>
                                        </tr>
                                        <tr>
                                            <td>Зэрэглэл</td>
                                            <td>{{ data.zereglel }}</td>
                                        </tr>
                                        <tr>
                                            <td>Барилгын хийц</td>
                                            <td>{{ data.hiits_id }}</td>
                                        </tr>
                                        <tr>
                                            <td>Захиалагч</td>
                                            <td>{{ data.zahialach_ner }}</td>
                                        </tr>
                                        <tr>
                                            <td>Гүйцэтгэгч</td>
                                            <td>{{ data.guitsetgegch }}</td>
                                        </tr>
                                        <tr>
                                            <td>Хотын төвөөс</td>
                                            <td>{{ data.fromCityCenter }} км</td>
                                        </tr>
                                        <tr>
                                            <td>Сургууль зай</td>
                                            <td>{{ data.fromSchool }} км</td>
                                        </tr>
                                        <tr>
                                            <td>Цэцэрлэг зай</td>
                                            <td>{{ data.fromKindergarden }} км</td>
                                        </tr>
                                        <tr>
                                            <td>Дэлгүүр зай</td>
                                            <td>{{ data.fromShop }} км</td>
                                        </tr>
                                        <tr>
                                            <td>Тээврийн үйлчилгээ зай</td>
                                            <td>{{ data.fromBus }} км</td>
                                        </tr>
                                        <tr>
                                            <td>Худалдааны төв зай</td>
                                            <td>{{ data.fromShopingCenter }} км</td>
                                        </tr>
                                        <tr>
                                            <td>Нийт айлын тоо</td>
                                            <td>{{ data.ail_too }}</td>
                                        </tr>
                                        <tr>
                                            <td>Давхар</td>
                                            <td>{{ data.davhar_too }}</td>
                                        </tr>
                                        <tr>
                                            <td>1 өрөө</td>
                                            <td>{{ data.uruu_1?data.uruu_1:0 }}</td>
                                        </tr>
                                        <tr>
                                            <td>2 өрөө</td>
                                            <td>{{ data.uruu_2?data.uruu_2:0 }}</td>
                                        </tr>
                                        <tr>
                                            <td>3 өрөө</td>
                                            <td>{{ data.uruu_3?data.uruu_3:0 }}</td>
                                        </tr>
                                        <tr>
                                            <td>4 өрөө</td>
                                            <td>{{ data.uruu_4?data.uruu_4:0 }}</td>
                                        </tr>
                                        <tr>
                                            <td>5 өрөө</td>
                                            <td>{{ data.uruu_5?data.uruu_5:0 }}</td>
                                        </tr>
                                        <tr>
                                            <td>6,7 өрөө</td>
                                            <td>{{ data.uruu_6_7?data.uruu_6_7:0 }}</td>
                                        </tr>
                                        <tr>
                                            <td>Дуплекс</td>
                                            <td>{{ data.duplex?data.duplex:0 }}</td>
                                        </tr>
                                        <tr>
                                            <td>Дулаан зогссол</td>
                                            <td>{{ data.dulaanz_too}}</td>
                                        </tr>
                                        <tr>
                                            <td>Гаднах зогсоол</td>
                                            <td>{{ data.gadnaz_too}}</td>
                                        </tr>
                                        <tr>
                                            <td>Агаарын бохирдол</td>
                                            <td>{{ data.airPolution }}</td>
                                        </tr>
                                        <tr>
                                            <td>Газар хөдлөлтын бүс</td>
                                            <td>{{ data.earthQuick}} балл</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-4 col-sm-12 info-section" style="padding-right: 20px">
                                    <h4>Нэмэлт мэдээлэл</h4>
                                    <table class="table table-small table-striped full" v-if="detail !== null">
                                        <tbody>
                                        <tr>
                                            <td>Камержуулалттай эсэх</td>
                                            <td>
                                                <i v-if="detail.is_camera === 1"
                                                   class="ti-check text-success"></i>
                                                <i v-else class="ti-close text-danger"></i></td>
                                        </tr>
                                        <tr>
                                            <td>24 цаг нэвтрэх боломжтой эсэх</td>
                                            <td>
                                                <i v-if="data.is_24 == 1"
                                                   class="ti-check text-success"></i>
                                                <i v-else class="ti-close text-danger"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Нэгдсэн ресепшинтэй эсэх</td>
                                            <td>
                                                <i v-if="data.is_reception == 1"
                                                   class="ti-check text-success"></i>
                                                <i v-else class="ti-close text-danger"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Нэгдсэн цэвэрлэгээтэй эсэх</td>
                                            <td>
                                                <i v-if="data.is_tseverlegee == 1"
                                                   class="ti-check text-success"></i>
                                                <i v-else class="ti-close text-danger"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Дулаан гаражтай эсэх</td>
                                            <td>
                                                <i v-if="data.is_garage == 1"
                                                   class="ti-check text-success"></i>
                                                <i v-else class="ti-close text-danger"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Тоглоомын талбайтай эсэх</td>
                                            <td>
                                                <i v-if="data.is_togloom == 1"
                                                   class="ti-check text-success"></i>
                                                <i v-else class="ti-close text-danger"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Ашиглалтын шаардлага хангахгүй болсон</td>
                                            <td>
                                                <i v-if="data.is_shaard_hangahgui == 1"
                                                   class="ti-check text-success"></i>
                                                <i v-else class="ti-close text-danger"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Хурлын өрөө</td>
                                            <td>
                                                <i v-if="data.is_hural_uruu == 1"
                                                   class="ti-check text-success"></i>
                                                <i v-else class="ti-close text-danger"></i></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <p v-else> Барилгын нэмэлт мэдээлэл ороогүй байна</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="listings-list listings-list similar-list">
                    <div class="listings-grid__item"
                         v-if="related.length>0"
                         v-for="item in related">
                        <a :href="`/#/apartmentdetail/${item.id}`" class="media">
                            <div class="pull-left listings-grid__main">
                                <div class="list-thumb"
                                     :style="renderImg(item.bimage)"></div>
                            </div>

                            <div class="media-body">
                                <div class="listings-grid__body" style="padding:10px 5px 5px 5px!important;">
                                    <h5 style="height: 16px;overflow: hidden">
                                        {{ item.hothonner }} - {{ item.ner }}
                                    </h5>
                                    <small>
                                        <i class="ti-location-pin"></i>
                                        {{ item.aimag }},<br/> {{ item.soum }}, {{ item.bag }}
                                    </small>

                                </div>

                                <div class="listings-grid__attrs" style="padding: 10px">
                                    <small>
                                        <i class="ti-view-grid"></i>
                                        {{item.ail_too}} айл
                                    </small>
                                    <small>
                                        <i class="ti-ruler"></i> {{item.davhar_too}} давхар
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "apartment-detail",
        data() {
            return {
                loading: true,
                data: null,
                detail: null,
                related: [],
                imgs:[]
            }
        },
        created() {
            this.getData();
        },
        methods: {
            getData() {
                this.loading = true;
                this.data = null;
                this.related = [];
                this.imgs = [];
                this.detail = null;
                axios.post("/getosdetail/" + this.$route.params.id).then(({data}) => {
                    this.data = data.barilga;
                    this.related = data.related;
                    this.imgs = data.imgs;
                    this.detail = data.detail;
                    this.loading = false;
                });

            },
            renderImg(path) {
                if (path == null)
                    return {'background-image': 'url("/assets/mcud/images/unnamed.png")'};
                return {'background': 'url("' + path.replace(/\\/g, '/') + '")'};
            }
        }
    }
</script>