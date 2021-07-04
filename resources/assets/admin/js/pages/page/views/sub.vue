<template>
    <div :class="pageType == 'iframe' ? '' : ''">
        <krud v-if="pageType == 'crud'" :template="property.template" :property="property" class="material">
            <template slot="nav">
                <slot name="nav"></slot>
            </template>

            <template slot="v-nav">
                <slot name="v-nav"></slot>
            </template>
        </krud>
        <div class="material" v-if="pageType == 'iframe'">
            <section class="offcanvas-template">
                <div class="crud-page">
                    <div class="crud-page-header">
                        <h3></h3>
                    </div>
                    <div class="crud-page-body">
                        <div class="v-nav">
                            <slot name="v-nav"></slot>
                        </div>
                        <div class="dg-flex">
                            <div class="iframe-page">
                                <iframe v-if="pageType == 'iframe'" :src="iframeUrl"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pageType: '',
                menu: window.init.menu,
                cruds: window.init.cruds,
                permissions: window.init.permissions.permissions,
                property: {
                    template: "canvas",
                    title: "",
                    grid: null,
                    form: null,
                    form_width: null,
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
            };
        },
        methods: {


            getPage() {
                let parentIndex = this.menu.findIndex(menu => menu.id == this.$route.params.menu_id);

                if (parentIndex >= 0) {
                    let pageIndex = this.menu[parentIndex].children.findIndex(menu => menu.id == this.$route.params.sub_menu_id);

                    if (pageIndex >= 0) {
                        let page = this.menu[parentIndex].children[pageIndex];

                        this.pageType = page.link_to;
                        if (this.pageType == 'crud') {


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
                        } else if (this.pageType == 'iframe') {
                            this.iframeUrl = page.url;
                        }
                    }
                }

            }
        },
        mounted() {
            this.getPage();

        }
    };
</script>
