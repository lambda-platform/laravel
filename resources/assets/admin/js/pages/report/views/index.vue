<template>
    <section class="page">
        <paper-header class="mini">
            <div slot="left">
            </div>
            <div slot="right">
                <user-control></user-control>
            </div>

            <div slot="nav">
                <ul>
                    <li>
                        <router-link to="/report/analytics">
                            <i class="ti ti-bar-chart"></i>
                            <span>Анализ</span>
                        </router-link>
                    </li>
                    <!--<li>-->
                    <!--<router-link to="/report/house">-->
                    <!--<Icon type="ios-contacts-outline"/>-->
                    <!--<span>Шинэ оронсууц</span>-->
                    <!--</router-link>-->
                    <!--</li>-->
                </ul>
            </div>
        </paper-header>
        <div class="paper-page-body">
            <router-view></router-view>
        </div>
    </section>
</template>

<script>

    export default {
    };
</script>
