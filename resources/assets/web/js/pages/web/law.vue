<template>
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/#/index">Нүүр</a></li>
                <li class="breadcrumb-item active" aria-current="page">Дүрэм журам</li>
            </ol>
            <h6 class="slim-pagetitle">Дүрэм журам</h6>
        </div>
        <div class="section-wrapper">
            <label class="section-title">{{durem.type}}</label>
            <p class="mg-b-20 mg-sm-b-40">{{durem.title}}</p>


            <div class="mg-t-20">
                <div class="row">
                    <div style="width: 100%" v-html="durem.body"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
              durem:window.init.durem
            }
        },

    };
</script>
