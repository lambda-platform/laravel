<template>
    <section class="page">
        <router-view v-if="showSub" :key="$route.path">
            <nav slot="v-nav" v-if="showSub">
                <div class="card sub-nav-list">
                    <h3 class="card-header">{{pageTitle}}</h3>
                    <ul class="card-body">
                        <li v-for="(item, index) in subMenu" :key="index" v-if="can(item)">
                            <router-link :to="`/p/${$route.params.menu_id}/${item.id}`" v-if="item.link_to != 'link'">
                                <!-- <Badge count="3"></Badge> -->
                                <i v-if="item.icon" :class="item.icon"></i>
                                <span v-html="getTitle(item)"></span>
                            </router-link>
                            <a :href="item.url" v-if="item.link_to == 'link'" target="_blank">
                                <i v-if="item.icon" :class="item.icon"></i>
                                <span v-html="getTitle(item)"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </router-view>

        <div v-if="!showSub" :class="pageType == 'iframe' ? 'iframe-page' :'sub-page'">
            <krud v-if="pageType == 'crud'" :template="property.template" :property="property" class="material">
                <user-control slot="right"></user-control>
            </krud>
            <iframe v-if="pageType == 'iframe'" :src="iframeUrl"></iframe>
        </div>
    </section>
</template>

<script>

    export default {

        data() {
            return {
                options: {
                    height: "1000px"
                },
                pageType: '',
                property: {
                    template: "canvas",
                    title: "",
                    grid: null,
                    form: null,
                    form_width: 800,
                    view_url: null,
                    actions: [],
                    user_condition: null,
                    permissions: {
                        c: false,
                        r: false,
                        u: false,
                        d: false,
                    },
                },
                iframeUrl: '',
                submenu: [],
                showSub: false,
                menu: window.init.menu,
                cruds: window.init.cruds,
                permissions: window.init.permissions.permissions,
                pageTitle: ''
            };
        },
        methods: {
            checkSub() {
                console.log("checkSub");
                let menuIndex = this.menu.findIndex(menu => menu.id == this.$route.params.menu_id);
                if (menuIndex >= 0) {
                    if (this.menu[menuIndex].children.length >= 1) {
                        this.pageTitle = this.getTitle(this.menu[menuIndex]);
                        if (this.$route.matched.length <= 1) {
                            let first = this.getShowAbleChild(this.menu[menuIndex].children);
                            if (first) {
                                this.$router.push(`/p/${this.$route.params.menu_id}/${first.id}`);
                            }else{
                                this.showSub = false;
                                this.getPage();
                            }
                        } else {
                            this.subMenu = this.menu[menuIndex].children;
                            this.showSub = true;
                        }

                    } else {
                        this.showSub = false;
                        this.getPage();
                    }
                }
            },

            getShowAbleChild(children) {
                let showIndex = children.findIndex(child => this.can(child));

                if (showIndex >= 0) {
                    return children[showIndex]
                } else
                    return null
            },

            can(menu) {
                if (this.permissions[menu.id]) {
                    if (this.permissions[menu.id].show) {
                        return true
                    } else {
                        return false
                    }
                } else {
                    return true;
                }
            },

            getTitle(item) {
                if (item.link_to == 'crud') {
                    let crudIndex = this.cruds.findIndex(crud => crud.id == item.url);
                    if (crudIndex >= 0)
                        return this.cruds[crudIndex].title
                    else
                        return ''
                } else
                    return item.title;
            },

            getPage() {
                console.log("getPage");
                let parentIndex = this.menu.findIndex(menu => menu.id == this.$route.params.menu_id);
                if (parentIndex >= 0) {
                    let page = this.menu[parentIndex];
                    this.pageType = page.link_to;
                    switch (this.pageType) {
                        case 'crud':
                            let crudIndex = this.cruds.findIndex(crud => crud.id == page.url);
                            if (crudIndex >= 0) {
                                // this.property. = 'canvas'
                                this.property.title = this.cruds[crudIndex].title;
                                this.property.grid = this.cruds[crudIndex].grid;
                                this.property.form = this.cruds[crudIndex].form;

                                this.property.form_width = this.cruds[crudIndex].form_width ? this.cruds[crudIndex].form_width : null;
                                this.property.view_url = this.cruds[crudIndex].view_url;
                                this.property.permissions.c = this.permissions[page.id].c;
                                this.property.permissions.r = this.permissions[page.id].r;
                                this.property.permissions.u = this.permissions[page.id].u;
                                this.property.permissions.d = this.permissions[page.id].d;
                                let user_condition = {};

                                if (this.permissions[page.id].formCondition) {
                                    user_condition.formCondition = this.permissions[page.id].formCondition
                                }
                                if (this.permissions[page.id].gridCondition) {
                                    user_condition.gridCondition = this.permissions[page.id].gridCondition
                                }

                                if (user_condition) {
                                    this.property.user_condition = user_condition;
                                }
                            }
                            break;
                        case 'link':
                            window.location = this.menu[parentIndex]['url'];
                            break;
                        case 'router-link':
                            // console.log(this.menu[parentIndex]['url']);
                            this.$router.push(this.menu[parentIndex]['url']);
                            break;
                        case 'iframe':
                            this.iframeUrl = page.url;
                            break;
                        default:
                            break;
                    }
                }
            }
        },
        mounted() {
            this.checkSub();
        }
    };
</script>
