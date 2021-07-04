<template>
    <section class="page page-faq page-sidebar">
        <krud :template="property.template" :property="property" ref="krud">
            <template slot="toolbuttons">

                <Tooltip content="Шинэ амины орон сууц нэмэх">
                <router-link to="/building/barilga/createbarilga/create/0/0">
                    <Button type="ghost" class="pricecreatebuttons" icon="plus">Шинэ амины орон сууц нэмэх</Button>
                </router-link>
                </Tooltip>
                <!--<Tooltip content="Excel-с өгөгдөл оруулах">-->
                <!--<router-link to="/building/barilga/import">-->
                    <!--<Button type="ghost" class="pricecreatebuttons" icon="upload">Импорт</Button>-->
                <!--</router-link>-->

                <!--</Tooltip>-->

                <!--<Tooltip content="Газрын зургын файл татах">-->

                    <!--<Button type="ghost" class="pricecreatebuttons" icon="map"-->
                    <!--@click="downloadKML">KML татах</Button>-->

                <!--</Tooltip>-->

            </template>
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
                dbClickAction:this.showEditForm
            };
        }
    },
    methods: {
        showEditForm(row) {
            // alert('showEditForm');
            this.$router.push(
                "/building/barilga/createapartment/edit/" + row.id+'/'+row.id
            );
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
                .then(({ data }) => {
                     let blob = new Blob([data], { type:"application/vnd.google-earth.kml+xml" })
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
