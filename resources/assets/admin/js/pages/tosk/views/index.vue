<template>
    <section class="page page-faq page-sidebar">
        <div class="sub-page">
            <router-view>
                <nav slot="v-nav">
                    <div class="card">
                        <h3 class="card-header">
                            Тоск бүртгэл
                        </h3>
                        <ul class="card-body">

                            <li>
                                <router-link to="/tosk/crud/canvas/Барилга/266/208">
                                    <Icon type="ios-arrow-dropright"></Icon>
                                    Барилга бүртгэл
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/tosk/crud/canvas/Хүсэлт/206/205">
                                    <Icon type="ios-arrow-dropright"></Icon>
                                    Хүсэлт
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/tosk/crud/canvas/Бүртгүүлэгч/305/306">
                                    <Icon type="ios-arrow-dropright"></Icon>
                                    Бүртгүүлэгч
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </nav>
            </router-view>
        </div>
    </section>
</template>
<script>
export default {
    data: {
        return() {
            options: {
                height: "500px";
            }
        }
    }
};
</script>
