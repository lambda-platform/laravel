<template>
    <div class="paper-theme aside-page">
        <sidebar class="with-text">
            <div slot="brand" class="logo">
                <img :src="$logo" alt="Lambda"/>
            </div>

            <ul>
                <li v-for="(item, index) in menu" :key="index" v-if="can(item)">
                    <router-link
                        :to="`/p/${item.id}`"
                        v-if="item.link_to != 'link' && item.link_to != 'router-link'"
                    >
                        <i v-if="item.icon" :class="item.icon"></i>
                        <span v-html="getTitle(item)"></span>
                    </router-link>

                    <router-link :to="item.url" v-if="item.link_to == 'router-link'">
                        <i v-if="item.icon" :class="item.icon"></i>
                        <span v-html="getTitle(item)"></span>
                    </router-link>

                    <a :href="item.url" v-if="item.link_to == 'link'">
                        <i v-if="item.icon" :class="item.icon"></i>
                        <span v-html="getTitle(item)"></span>
                    </a>
                </li>
            </ul>

            <div slot="aside-bottom">
                <ul>
                    <li v-if="extra.userlist">
                        <router-link :to="`/module/agent`">
                            <i class="ti-user"></i>
                        </router-link>
                    </li>
                    <li>
                        <a @click="logoutModal = true">
                            <i class="ti-power-off"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </sidebar>

        <main>
            <router-view :key="$route.path"></router-view>
        </main>

        <Modal
            v-model="logoutModal"
            :closable="false"
            width="252"
            class="logout-modal">
            <p slot="header" style="display:none;"></p>
            <div style="text-align:center">
                <a @click="logout()">
                    <i class="ti-power-off"></i>
                    Гарах
                </a>
                <a @click="cancel()">
                    <i class="ti-reload"></i>
                    Болих
                </a>
            </div>
            <div slot="footer" style="display:none;">
                <form action="/auth/logout"></form>
            </div>
        </Modal>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";

export default {
    computed: {
        ...mapGetters({
            user: "user",
        }),
    },
    created() {
        console.log(this.$route);
    },
    data() {
        return {
            logoutModal: false,
            menu: window.init.menu,
            cruds: window.init.cruds,
            permissions: window.init.permissions.permissions,
            extra: window.init.permissions.extra,
        };
    },
    methods: {
        can(menu) {
            if (this.permissions[menu.id]) {
                if (this.permissions[menu.id].show) return true;
                else return false;
            } else return true;
        },

        // can_extra() {
        //     console.log(this.extra);
        //
        //     if (this.extra) {
        //         if (this.extra.moqup || this.extra.datasource || this.extra.chart || this.extra.userlist) {
        //             return true
        //         } else return false
        //     } else return false
        // },

        getTitle(item) {
            if (item.link_to == "crud") {
                let crudIndex = this.cruds.findIndex((crud) => crud.id === item.url);
                if (crudIndex >= 0) {
                    return this.cruds[crudIndex].title;
                } else {
                    return "";
                }
            } else {
                return item.title;
            }
        },

        checkActive(url) {
            let checkUrl = url.split("#");
            if (checkUrl.length > 1 && checkUrl[1] === this.$route.path) {
                return "active";
            }
        },

        logout() {
            axios.post("/auth/logout", {}).then((o) => {
                window.location = "/auth/login";
            });
        },

        cancel() {
            this.$data.logoutModal = false;
        },
    },
};
</script>
