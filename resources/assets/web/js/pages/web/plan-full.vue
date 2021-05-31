<template>
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/">Нүүр</a></li>
                <li class="breadcrumb-item active" aria-current="page">Амины орон сууцны зураг төсөл</li>
            </ol>
            <!--<h6 class="slim-pagetitle">{{ plan.name }}</h6>-->
        </div>

        <div class="row row-sm">
            <div class="col-md-8">
                <div class="card">
                    <div class="detail-media">
                        <img :src="plan.image?plan.image:'/assets/mcud/images/no-image.jpg'" width="100%"/>
                    </div>

                    <div class="detail-info">
                        <div class="zar-detail">
                            {{ plan.name }}
                            <br>

                            <h4 v-if="plan.file_type==3">
                                <a :href="plan.file_link" target="_blank">Энд дарж татаж авна уу</a>
                            </h4>
                            <h4 v-else>
                                <a :href="plan.file" download>Энд дарж татна уу</a>
                            </h4>
                            <small>Татагдсан тоо:{{ plan.downloaded}}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="listings-list listings-list similar-list">
                    <div class="listings-grid__item"
                         v-if="related.length>0"
                         v-for="item in related">
                        <a :href="`/#/plandetail/${item.id}`" class="media">
                            <div class="pull-left listings-grid__main">
                                <div class="list-thumb"
                                     :style="renderImg(item.image)"></div>
                            </div>

                            <div class="media-body">
                                <div class="listings-grid__body" style="padding:10px 5px 5px 5px!important;">
                                    <h5 style="height: 45px; overflow: hidden">
                                        {{ item.name}}
                                    </h5>
                                </div>

                                <ul class="listings-grid__attrs" style="padding: 10px">
                                    <li>
                                        <i class="ti-view-list"></i>
                                        {{item.davhar}} давхар
                                    </li>
                                    <li>
                                        <i class="ti-ruler"></i> {{item.mkv}} мкв
                                    </li>
                                </ul>
                                <!--<ul class="listings-grid__attrs" style="padding: 10px">-->

                                <!--<li>-->
                                <!--<i class="ti-view-grid"></i> {{item.uruu_too}} өрөө-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--<i class="ti-eye"></i> {{item.viewed}}-->
                                <!--</li>-->
                                <!--</ul>-->
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
        data() {
            return {
                plan: {},
                related: []
            }
        },
        created() {
            this.getData();
        },
        methods: {
            getData() {
                this.loading = true;
                axios.post("/getplandownload/" + this.$route.params.id).then(({data}) => {
                    this.plan = data.plan;
                    this.related = data.related;
                    this.loading = false;
                });
            },
            customGetDate(d) {
                return d.substring(0, 10);
            }
            ,
            renderImg(path) {
                return 'background-image' + ':' + 'url("' + path.replace(/\\/g, '/') + '")';
            },
            choosePoster(item) {
                this.$router.push('posterdetail/' + item.id);
            }
        }
    };
</script>
