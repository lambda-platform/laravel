<template>
    <div class="slim-header">
        <div class="container">
            <div class="slim-header-left">
                <h2 class="slim-logo">
                    <a href="/">
                        <img src="/assets/mcud/images/logo-full.png" alt="">
                    </a>
                </h2>
            </div>

            <div class="slim-header-right">
                <div class="nav" v-if="menu && menuCount>0">
                    <ul v-for="ind in menuCount" :key="ind">
                        <li>
                            <a :class="`${$route.path==menu[ind*2-2].code?'active' : '' }`" :href="`/#${menu[ind*2-2].code}`">{{menu[ind*2-2].ner}}</a>
                        </li>
                        <li v-if="ind*2<menu.length || ind*2==menu.length">
                            <a :class="`${$route.path==menu[ind*2-1].code?'active' : '' }`" :href="`/#${menu[ind*2-1].code}`">{{menu[ind*2-1].ner}}</a>
                        </li>
                    </ul>
                </div>

                <!--<div class="auth" v-if="$user">-->
                    <!--<div class="dropdown dropdown-c">-->
                        <!--<a href="#" class="logged-user" data-toggle="dropdown">-->
                            <!--<img :src="`${ $user.thumb?$user.thumb:'/images/avatar.jpg' }`" alt="">-->
                            <!--<span>`${ $user.first_name?$user.first_name:$user.login }`</span>-->
                            <!--<i class="fa fa-angle-down"></i>-->
                        <!--</a>-->
                        <!--<div class="dropdown-menu dropdown-menu-right">-->
                            <!--<nav class="nav">-->
                                <!--<a href="/profile" class="nav-link"><i class="icon ion-person"></i>Хувийн мэдээлэл</a>-->
                                <!--<a href="/customer/logout" class="nav-link"><i class="icon ion-forward"></i>Гарах</a>-->
                            <!--</nav>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->

                <div class="auth">
                    <a class="btn btn-outline-primary mg-b-10" href="/auth/login">
                        <i class="ti ti-unlock"></i>
                        Нэвтрэх
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                menu:window.init.menu,
                menuCount:window.init.menu.length
            }
        },
        created(){
            this.menuCount=Math.round(this.menuCount/2);
            //+(this.menucount-(this.menucount/2)*2);
            console.log(this.menuCount);
        }
    }
</script>
