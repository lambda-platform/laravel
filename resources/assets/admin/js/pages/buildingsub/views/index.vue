<template>
    <section class="page">
        <router-view>
            <nav class="krud-nav" slot="nav">
                <ul>
                    <li class="has-sub">
                        <span>
                            Барилгын бүртгэл жагсаалт
                        </span>
                        <!--<div>-->
                            <!--<router-link to="/building/crud/list/Ашиглагдаж-буй/104">-->
                                <!--Идэвхтэй-->
                            <!--</router-link>-->
                            <!--<router-link to="/building/crud/list/Нураасан/160">-->
                                <!--Нураасан-->
                            <!--</router-link>-->
                            <!--<router-link to="/building/crud/list/Төлөвлөгдсөн/161">-->
                                <!--Төлөвлөгдсөн-->
                            <!--</router-link>-->
                        <!--</div>-->
                    </li>
                    <!--<li class="has-sub">-->
                        <!--<span>-->
                            <!--Амины орон сууц-->
                        <!--</span>-->
                        <!--<div>-->
                            <!--<router-link to="/building/crud/list/Ашиглагдаж-буй/106">-->
                                <!--Ашиглагдаж буй-->
                            <!--</router-link>-->
                            <!--<router-link to="/building/crud/list/Ашиглалтад-ороогүй/107">-->
                                <!--Ашиглалтад ороогүй-->
                            <!--</router-link>-->
                        <!--</div>-->
                    <!--</li>-->
                </ul>
            </nav>
        </router-view>
    </section>
</template>
<style scoped>

</style>
<script>
    export default {

        data() {
            return {
                menutheme: 'light',
                active_name:"1"
            }
        },
        methods:{
            menuselect(data)
            {
                switch(data){
                    case "1-1":{ this.$router.push("/building/crud/list/Ашиглагдаж-буй/104");  break;}
                    case "1-2":{ this.$router.push("/building/crud/list/Ашиглалтад-ороогүй/105");  break;}
                    case "1-3":{ this.$router.push("/building/crud/list/Ашиглалтад-ороогүй/57");  break;}
                    case "2-1":{ this.$router.push("/building/crud/list/Ашиглагдаж-буй/106");  break;}
                    case "2-2":{ this.$router.push("/building/crud/list/Ашиглалтад-ороогүй/107");  break;}
                }
            }
        }
    };
</script>
