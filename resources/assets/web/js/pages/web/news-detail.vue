<template>
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/#/index">Нүүр</a></li>
                <li class="breadcrumb-item active" aria-current="page">Мэдээ мэдээлэл</li>
            </ol>
            <h6 class="slim-pagetitle">Мэдээ мэдээлэл</h6>
        </div>
        <div class="section-wrapper">
            <label class="section-title">{{medee.type}}</label>
            <p class="mg-b-20 mg-sm-b-40">{{medee.title}}</p>


            <div class="mg-t-20">
                <div class="row">
                    <div style="width: 100%" v-html="medee.body"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
             medee:window.init.medee
            }
        },
        created() {

          //  this.getData();
        },
        methods: {
            getData() {
                this.loading = true;
                axios.get("/getNewsDetail/" + this.$route.params.id).then(({data}) => {
                    this.data = data;
                    this.loading = false;
                });
            },
            customGetDate(d) {
                if(d)
                return d.substring(0, 10);
                return '';
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
