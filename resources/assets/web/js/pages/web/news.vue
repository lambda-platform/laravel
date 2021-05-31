<template>
    <!-- Blog section start -->
    <div class="blog-section" style="margin-top: 50px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6"
                             v-for="item in datas" :key="item.id">
                            <div class="blog-1">
                                <img :src="item.thumb" alt="blog" class="img-fluid" style="height: 150px; width: 100%; object-fit: cover">
                                <div class="detail">
                                    <!--<div class="date-box">-->
                                        <!--<h5>03</h5>-->
                                        <!--<h5>May</h5>-->
                                    <!--</div>-->
                                    <h3 style="height: 50px; overflow: hidden">
                                        <a  :href="`/#/newsdetail/${item.id}`">{{item.title}}</a>
                                    </h3>
                                    <div class="post-meta">
                                        <span><a href="javascript:void(0)"><i class="fa fa-user"></i>Админ</a></span>
                                        <span><a href="javascript:void(0)"><i class="fa fa-clock-o"></i>{{customGetDate(item.created_at)}}</a></span>
                                    </div>
                                    <p style="height: 80px; overflow: hidden">{{item.description}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="pagination-box hidden-mb-45 text-center">
                                <el-pagination
                                    background
                                    layout="total, prev, pager, next"
                                    :total="paginate.total"
                                    :page-size="12"
                                    @current-change="getData">
                                </el-pagination>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="sidebar mbl">
                        <res></res>
                        <lastevents></lastevents>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog section end -->

</template>

<script>

    import lastevents from "../../components/lastevent";
    import res from "../../components/resources";
    export default {
        components:{lastevents,res},

        data() {
            return {
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

            this.getData(1);
        },
        methods: {
            getData(page) {
                this.loading=true;
                axios.get("/getNewsList?page=" + page).then(({data}) => {
                    this.datas = data.data;
                    this.paginate.total = data.total;
                    this.paginate.currentPage = data.current_page;
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
                this.$router.push('posterdetail/'+item.id);
            }
        }
    };
</script>
