<template>
    <section>
        <krud class="material" :template="property.template" :property="property" ref="krud">
            <template slot="nav">
                <slot name="nav"></slot>
            </template>

            <template slot="toolbuttons" v-if="$user.role!=36">
                <Tooltip content="Шинэ бүртгэл нэмэх">
                    <router-link to="/building/barilga/createbarilga/create/0/0">
                        <Button type="success" ghost class="btnAdd pricecreatebuttons" icon="md-add">Нэмэх
                        </Button>
                    </router-link>
                </Tooltip>

                <Tooltip content="Excel-с өгөгдөл оруулах">
                    <router-link to="/building/barilga/import">
                        <Button type="info" ghost class=" btnAdd pricecreatebuttons" icon="md-cloud-upload">Excel
                        </Button>
                    </router-link>
                </Tooltip>

                <Tooltip content="Газрын зургын файл татах">
                    <Button type="info" ghost class="btnAdd pricecreatebuttons" icon="md-map"
                            @click="downloadKML">KML
                    </Button>
                </Tooltip>
            </template>
            <user-control slot="right"></user-control>
        </krud>
    </section>
</template>
<script>

    export default {
        data() {
            return {
                property: {
                    template: this.$route.params.template,
                    grid: this.$route.params.grid,
                    form: this.$route.params.form,
                    dbClickAction: this.showEditForm,
                    actions: [
                        {
                            icon: "ti-pencil",
                            label: "Засах",
                            method: this.showEditForm
                        }
                    ],
                }
            }
        },
        created() {
            if (this.$user.role == 36) {
                this.property.custom_condition = [{
                    type: 'equals',
                    field: 'zahialagch_comp_id',
                    field1: null,
                    value: this.$user.company
                }];
            }
        },
        methods: {
            showEditForm(row) {
                // alert('showEditForm');
                this.$router.push(
                    "/building/barilga/createbarilga/edit/" + row.id + '/' + row.id
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
