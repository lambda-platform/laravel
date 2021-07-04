<template>
    <section class="page page-faq page-sidebar">
        <krud class="material" :template="property.template" :property="property" ref="krud">
            <template slot="toolbuttons">
                <Tooltip v-show="$route.params.grid==98" content="Орон сууц нэмэх">
                    <router-link to="/zar/apartment/create/create/0/0">
                        <Button type="success" ghost icon="md-add">Орон сууц нэмэх</Button>
                    </router-link>
                </Tooltip>
                <Tooltip v-show="$route.params.grid==92" content="Шинэ орон сууц нэмэх">
                    <router-link to="/zar/newapartment/create/create/0/0">
                        <Button type="success" ghost class="btnAdd pricecreatebuttons" icon="md-add">Шинэ орон сууц нэмэх</Button>
                    </router-link>
                </Tooltip>
            </template>
            <template slot="v-nav">
                <slot name="v-nav"></slot>
            </template>
            <user-control slot="right"></user-control>
        </krud>
    </section>
</template>

<script>

    export default {

        computed: {
            property() {
                return {
                    template: this.$route.params.template,
                    title: this.$route.params.title,
                    grid: this.$route.params.grid,
                    form: this.$route.params.form,
                    actions: [{
                        icon: "edit",
                        method: this.showEditForm
                    }],
                    dbClickAction: this.showEditForm
                };
            }
        },
        methods: {
            showEditForm(row) {
                if (this.$route.params.grid == 98) {
                    this.$router.push(
                        "/zar/apartment/create/edit/" + row.id + '/' + row.id
                    );
                } else if (this.$route.params.grid == 92) {
                    this.$router.push(
                        "/zar/newapartment/create/edit/" + row.id + '/' + row.id
                    );
                }
            },
            downloadKML() {

                let url = `/mcud/barilga/map/${this.$refs.krud.$children[0].$refs.grid.schemaID}`;
                let filters = Object.keys(this.$refs.krud.$children[0].$refs.grid.filterModel)
                    .filter(e => this.$refs.krud.$children[0].$refs.grid.filterModel[e] !== null)
                    .reduce((o, e) => {
                        o[e] = this.$refs.krud.$children[0].$refs.grid.filterModel[e];
                        return o;
                    }, {});

                //if header filter has some data
                if (typeof this.$refs.krud.$children[0].$refs.grid.colfilter !== "undefined" && this.$refs.krud.$children[0].$refs.grid.colfilter) {
                    filters = this.$refs.krud.$children[0].$refs.grid.colfilter;
                }

                axios
                    .post(url, filters)
                    .then(({data}) => {
                        let blob = new Blob([data], {type: "application/vnd.google-earth.kml+xml"})
                        let link = document.createElement('a')
                        link.href = window.URL.createObjectURL(blob)
                        link.download = 'Barilga.kml'
                        link.click()
                        link.remove();
                    })
                    .catch(e => {
                        console.log(e.message);
                    });
            },
        }
    };
</script>
