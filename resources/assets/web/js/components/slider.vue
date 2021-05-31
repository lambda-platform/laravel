<template>
    <!-- Banner start -->
    <div class="banner" id="banner">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner banner-max-height">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/assets/pubmend/images/slide/1.jpeg" alt="banner">
                    <div class="carousel-caption banner-slider-inner d-flex h-100 text-center">
                        <div class="carousel-content container">
                            <div class="text-center">
                                <div id="typed-strings">
                                    <p>Эрдэм шинжилгээний ажлууд</p>
                                </div>
                                <h1 class="typed-text">&nbsp;
                                    <span id="typed"></span>
                                </h1>
                                <p class="text-p" data-animation="animated fadeInUp delay-10s">
                                    Монголын Анагаах ухаан, эрүүл мэндийн судлаач, эрдэмтэдийн эрдэм шинжилгээ, судалгаа
                                </p>
                                <!--<a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-white">Read More</a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/assets/pubmend/images/slide/2.jpg" alt="banner">
                    <div class="carousel-caption banner-slider-inner d-flex h-100 text-center">
                        <div class="carousel-content container">
                            <div class="text-center">
                                <div id="typed-strings2">
                                    <p>Ном, сэтгүүл болон нийтлэлүүд</p>
                                </div>
                                <h1 class="typed-text">&nbsp;
                                    <span id="typed2"></span>
                                </h1>
                                <p class="text-p" data-animation="animated fadeInUp delay-10s">
                                    Хэвлэгдсэн ном сэтгүүлүүд албан ёсны эрхтэйгээр
                                </p>
                                <!--<a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-white">Read More</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search area start -->
        <div class="search-area d-none d-xl-block d-lg-block" id="search-area-4">
            <div class="container">
                <div class="search-area-inner">
                    <div class="search-contents ">
                        <el-form :model="credentials"
                                 ref="searchForm">
                            <div class="row">
                                <div class="col-6 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <el-select v-model="formData.type" placeholder="Төрөл"
                                                   @change="relateSelectMain" style="width: 100%">
                                            <el-option
                                                v-for="item in maincategory"
                                                :key="item.id"
                                                :label="item.name"
                                                :value="item.id">
                                            </el-option>
                                        </el-select>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <el-select v-model="formData.cat1" placeholder="Үндсэн ангилал"
                                                   @change="relateSelect" style="width: 100%">
                                            <el-option
                                                v-for="item in category"
                                                :key="item.id"
                                                :label="item.ner"
                                                :value="item.id">
                                            </el-option>
                                        </el-select>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <el-select v-model="formData.cat2" placeholder="Дэд ангилал"
                                                   style="width: 100%">
                                            <el-option
                                                v-for="item in subcategory"
                                                :key="item.id"
                                                :label="item.ner"
                                                :value="item.id">
                                            </el-option>
                                        </el-select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-lg-9 col-md-9">
                                    <div class="form-group">
                                        <el-input style="width: 100%" placeholder="Хайх үгээ оруулна уу"
                                                  v-model="formData.search"></el-input>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <el-button @click="handleSearchForm" type="primary" style="width: 100%">Хайлт
                                        </el-button>
                                    </div>
                                </div>
                            </div>
                        </el-form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search area end -->
    </div>
</template>

<script>
    import 'swiper/dist/css/swiper.css'
    import {swiper, swiperSlide} from 'vue-awesome-swiper'

    export default {
        name: "slider",
        components: {swiper, swiperSlide},
        data() {
            return {
                formData: {
                    search: null,
                    type: 1,
                    cat1: null,
                    cat2: null,
                },
                maincategory: window.init.maincategory,
                category: [],
                subcategory: [],
                slides: window.init.slides

            }
        },
        created() {
            this.relateSelectMain();
        },
        mounted() {
            // this.swiper.slideTo(3, 1000, false)
            // Typed string activation
            if ($('#typed-strings').length > 0) {
                var typed = new Typed('#typed', {
                    stringsElement: '#typed-strings',
                    typeSpeed: 100,
                    backSpeed: 0,
                    backDelay: 1000,
                    startDelay: 1000,
                    loop: true
                });
            }

            if ($('#typed-strings2').length > 0) {
                var typed = new Typed('#typed2', {
                    stringsElement: '#typed-strings2',
                    typeSpeed: 100,
                    backSpeed: 0,
                    backDelay: 1000,
                    startDelay: 1000,
                    loop: true
                });
            }

            if ($('#typed-strings3').length > 0) {
                var typed = new Typed('#typed3', {
                    stringsElement: '#typed-strings3',
                    typeSpeed: 100,
                    backSpeed: 0,
                    backDelay: 1000,
                    startDelay: 1000,
                    loop: true
                });
            }
        },
        methods: {
            relateSelectMain() {
                this.subcategory = [];
                axios.get("/getCategory/" + this.formData.type).then(({data}) => {
                    this.category = data;
                });
            },
            relateSelect() {
                this.subcategory = [];
                axios.get("/getSubcategory/" + this.formData.cat1).then(({data}) => {
                    this.subcategory = data;
                });
            },
            isNullOrWhiteSpace(str) {
                return (!str || str.length === 0 || /^\s*$/.test(str))
            },
            handleSearchForm() {
                window.location=this.maincategory.find(f=>f.id==this.formData.type).link+'?cat1='+this.formData.cat1+'&cat2='+this.formData.cat2+'&search='+this.formData.search;
                // if (this.formValidate.search && !this.isNullOrWhiteSpace(this.formValidate.search.length)) {
                //
                // }
                // else {
                //     this.$notify({
                //         title: 'Хайлт хийх боломжгүй',
                //         message: 'This is a warning message',
                //         type: 'warning'
                //     });
                // }
            }
        }
    }
</script>
