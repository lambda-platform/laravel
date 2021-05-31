<template>
    <div class="slim-mainpanel">
        <div class="container">
            <div class="slim-pageheader">
                <ol class="breadcrumb slim-breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Нүүр</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Түрээсийн орон сууц</li>
                </ol>
                <h6 class="slim-pagetitle">Түрээсийн орон сууцны жагсаалт</h6>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12">

                    <div class="auth" v-if="!$user">
                        <button class="btn btn-outline-primary mg-b-10" data-toggle="modal" data-target="#loginModal">
                            <i class="ti ti-unlock"></i>
                            Нэвтрэх
                        </button>

                        <!--<a href="/#/toskregister" class="btn btn-outline-primary mg-b-10">-->
                        <a href="javascript:void(0)" class="btn btn-outline-primary mg-b-10">
                            <i class="ti ti-user"></i>
                            Бүртгүүлэх
                        </a>
                    </div>
                    <div class="alert alert-warning" v-if="!$user">
                        Түрээсийн орон сууцны хүсэлт илгээхийн тулд системд бүртгүүлэн бүртгүүлсэн эрхээрээ нэвтэрч орно уу
                    </div>

                    <div class="card card-table">
                        <div class="table-responsive">
                            <table class="table mg-b-0 tx-13">
                                <thead>
                                <tr class="tx-10">
                                    <th class="wd-10p pd-y-5">&nbsp;</th>
                                    <th class="pd-y-5">Барилгын мэдээлэл</th>
                                    <th class="pd-y-5 tx-center">Хүсэлт авах тоо</th>

                                    <th v-if="$user" class="pd-y-5 tx-center">...</th>

                                </tr>
                                </thead>
                                <tbody>

                                <tr v-for="item in properties" :key="item.id">
                                    <td class="pd-l-20">
                                        <img :src="`${item.image?item.image:'http://via.placeholder.com/800x533' }`"
                                             class="wd-55"
                                             alt="Image">
                                    </td>
                                    <td>
                                        <a href="" class="tx-inverse tx-14 tx-medium d-block">
                                            {{ item.title }}
                                        </a>
                                        <span class="tx-11 d-block" style="margin-top: 5px;">
                                                        <span class="square-8 bg-danger mg-r-5 rounded-circle"></span>
                                                        {{ item.address }}
                                                    </span>
                                    </td>
                                    <td class="valign-middle tx-center" style="width: 200px;">
                                        {{ item.hit_count }} хүсэлт авна
                                    </td>

                                    <td v-if="$user" class="valign-middle tx-center" style="width: 150px;">
                                        <a href="`/send/${ item.id }`" class="btn btn-oblong btn-teal">
                                            Хүсэлт өгөх
                                        </a>
                                    </td>

                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- container -->
    </div>

</template>

<script>
    export default {
        name: "tosk",
        data(){
            return {
                properties:window.init.properties
            }
        }
    }
</script>

<style scoped>

</style>
