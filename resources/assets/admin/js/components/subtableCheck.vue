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

        <i-table ref="selectiontable"  @on-selection-change="selectrow"   size="small" height="200" :columns=columns :data="data"></i-table>
    </Modal>
</template>
<script>
    import axios from 'axios';
    export default {
        props: ['modalvisible','modalvisiblename','title','oktext','columns','datacontainer','datacontainername','data'],//['columns', 'modalvisible','modalvisiblename','ajaxurl','title','oktext','datefilter','datacontainer','datacontainername'],
        data() {
            return {
                selected:[],
            }
        },
        watch: {
            data(val){

                if(val!=[]) {
                    setTimeout(() => {
                        for (let i in this.$refs.selectiontable.objData) {
                            this.datacontainer[this.datacontainername].map((item) => {
                                if (this.$refs.selectiontable.objData[i].id == item.id) {
                                    this.$refs.selectiontable.objData[i]._isChecked = true;
                                }
                            });
                        }
                    }, 0);
                }
            }
        },
        methods: {
            addmethod:function()
            {

                // this.datacontainer[this.datacontainername].map((item)=>{
                //     this.selected=this.selected.filter((f)=>{ return f.id!=item.id});
                // });

                this.datacontainer[this.datacontainername]=this.selected;
                    //[...this.selected, ...this.datacontainer[this.datacontainername]];
                this.$parent.exchangechanged();

            },
            selectrow:function(row){
               this.selected=row;
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
