<template>
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/#/index">Нүүр</a></li>
                <li class="breadcrumb-item active" aria-current="page">Барилгын зураг төсөл</li>
            </ol>
            <h6 class="slim-pagetitle">Батлагдсан жагсаалт</h6>
        </div>

        <div class="row row-sm">

            <div class="col-md-12 col-lg-12 listings-list">
                Нийт илэрц: {{paginate.total}} амины орон сууцны зураг төсөл байна

                <div class="listings-grid__item" v-if="datas.length>0" v-for="item in datas" :key="item.id">
                    <a :href="`/#/plandetail/${item.id}`" class="media">
                        <div class="pull-left listings-grid__main">
                            <div class="list-thumb"
                                 :style="`background: url(${renderImg(item.image)}); background-position: center`"></div>
                        </div>

                        <div class="media-body">
                            <div class="listings-grid__body">
                                <small>
                                    <i class="ti-notepad"></i>
                                    Гүйцэтгэгч:{{ item.guitsetgegch_comp }}, Захиалагч:{{ item.zahialagch_comp }} {{
                                    item.zahialagch_name }}, Огноо: {{ item.ognoo }}
                                </small>
                                <h5>
                                    {{ item.name }}
                                </h5>
                            </div>

                            <ul class="listings-grid__attrs">
                                <li>
                                    <i class="ti-time"></i>
                                    {{ item.created_at }}
                                </li>
                                <li>
                                    <i class="ti-view-list"></i>
                                    {{item.davhar}} давхар
                                </li>
                                <li>
                                    <i class="ti-view-grid"></i> {{item.uruu_too}} өрөө
                                </li>
                                <li>
                                    <i class="ti-ruler"></i> {{item.mkv}} мкв
                                </li>
                                <li>
                                    <i class="ti-eye"></i> {{item.viewed}}
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
                        :page-size="20"
                        @current-change="filterData">
                    </el-pagination>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "plans",
        data() {
            return {
                loading: true,
                datas: [],
                paginate: {
                    currentPage: 1,
                    paginate: 20,
                    total: 0
                }
            }
        },
        created() {
            this.getPlanData(1);
        },
        methods: {
            getPlanData(page) {
                this.loading = true;
                this.datas = [];
                axios.post("/getplanlist").then(({data}) => {
                    console.log(data);
                    this.datas = data.data;
                    this.paginate.total = data.total;
                    this.paginate.currentPage = data.current_page;
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

