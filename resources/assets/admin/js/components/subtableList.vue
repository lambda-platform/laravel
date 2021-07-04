<template>
    <div style="border: 1px dashed #eee; padding: 20px" class="mbsubtable">
        <Row>
            <Col span="12">
            {{title}}
            </Col>
            <Col span="12" style="text-align:right">
            <Button type="success" icon="plus" @click="showAgentgivepricemodal(true)">Нэмэх</Button>
            <Button type="warning" icon="close" @click="removeagentprice">Хасах</Button>
            </Col>
        </Row>
        <div class="splitdiv"></div>
        <span class="mblabel" style="">
            {{comment}}</span>
        <br/>
        <br/>
        <i-table ref="subdatagrid" size="small" height="200" :columns="gridcolumns"
                 @on-selection-change="selectrow"
                 :data="basemodel[modelname]"></i-table>

        <modalsubtable
                ajaxurl="/logistic/getagentgivespricefilter"
                :columns="modalgridcolumn"
                title="Агентаас өгсөн үнийн жагсаалт"
                oktext="Нэмэх"
                :datacontainer="basemodel"
                :datacontainername="modelname"
                :modalvisible="modals"
                modalvisiblename="getprices">
        </modalsubtable>
    </div>

</template>
<script>
    import modalsubtable from './subtableModal.vue';
    export default {
        props: ['title','comment','gridcolumns','basemodel','modelname','modalgridcolumn'],//['placeholder','gettername','actionname','model','modelname'],
        components: {
            modalsubtable,
        },
        data() {
            return {
                modals: {
                    getprices: false,
                    },
                selected:[],
                data:[]
            }
            },
        methods:{
            selectrow: function (row) {
                this.selected = row;
            },
            showAgentgivepricemodal(blean) {
                this.modals.getprices = blean;

            },
            removeagentprice() {

                this.$parent.$Message.loading({
                    content: 'Ачаалж байна...',
                    duration: 0
                });
                this.selected.map((s) => {
                    this.basemodel[this.modelname] = this.basemodel[this.modelname].filter((p) => {
                        return p.id != s.id;
                    });
                });
                this.$parent.$Message.destroy();
            },
        }
    };
</script>

<style scoped>
</style>
