<template>
    <Modal
            :value=modalvisible[modalvisiblename]
            :title=title
            :okText=oktext
            cancelText="Цуцлах"
            width="800"
            @on-visible-change="visiblechange"
            @on-ok="addmethod"
            @on-cancel="" class="mbsubtable">

        <Form :model="datacontainer" :label-width="150">
            <FormItem label="Бүртгэсэн огноо">
                <DatePicker type="date" placeholder="Бүртгэсэн огноог сонгоно уу"
                            v-model="modalformValidate.date"></DatePicker>
                <Button type="primary" @click="filterdata()">Шүүх</Button>
            </FormItem>
        </Form>
        <i-table ref="selectiontable"  @on-selection-change="selectrow"   size="small" height="200" :columns=columns :data="griddata"></i-table>
    </Modal>
</template>
<script>
    import axios from 'axios';
    export default {
        props: ['modalvisible','modalvisiblename','title','oktext','columns','datacontainer','datacontainername','ajaxurl'],//['columns', 'modalvisible','modalvisiblename','ajaxurl','title','oktext','datefilter','datacontainer','datacontainername'],
        data() {
            return {
                griddata: [],
                selected:[],
                modalformValidate: {
                    date: new Date()
                },
            }
        },
        // mounted() {
        //      let today=new Date(this.modalformValidate.date);
        //      this.ajaxreq(today.getFullYear()+'-'+(parseInt(today.getMonth())+1)+'-'+today.getDay());
        // },
        methods: {
            addmethod:function()
            {
                let tempselected=this.selected; this.datacontainer[this.datacontainername].map((item)=>{
                    this.selected=this.selected.filter((f)=>{ return f.id!=item.id});
                });

                this.datacontainer[this.datacontainername]=[...this.selected, ...this.datacontainer[this.datacontainername]];
            },
            selectrow:function(row){
               this.selected=row;
            },
            ajaxreq:function(sdate){
                this.$parent.$parent.$Message.loading({
                    content: 'Ачаалж байна...',
                    duration: 0
                });
                axios.get(this.ajaxurl+'/'+sdate).then(o => {
                    this.griddata=o.data;
                    this.$parent.$parent.$Message.destroy();
                    setTimeout(()=>{
                        for(let i in this.$refs.selectiontable.objData)
                        {
                            this.datacontainer[this.datacontainername].map((item)=>{
                                if(this.$refs.selectiontable.objData[i].id==item.id){
                                    this.$refs.selectiontable.objData[i]._isChecked=true;
                                }
                            });
                        }
                    },500);
                });
            },
            filterdata:function(){
                let today=new Date(this.modalformValidate.date);
                this.ajaxreq(today.getFullYear()+'-'+(parseInt(today.getMonth())+1)+'-'+today.getDate());
            },
            visiblechange: function(tt) {
                if(tt==false)
                {
                    this.modalvisible[this.modalvisiblename]=tt;
                }

            }
        }
    };
</script>

<style scoped>

</style>
