<template>
    <Select :on-change="selectchanged" v-model="model[modelname]"  :placeholder=placeholder filterable>
        <Option v-for="item in datalist"  :value=item.id :key=item.id>{{item.name}}
        </Option>
    </Select>
</template>
<script>
    export default {
        props: ['placeholder','gettername','actionname','model','modelname','selectchanged'],

        created(){
            this.$store.dispatch(this.actionname);
            this.getternamelocal=this.gettername;
            //console.log('DATA in Select:',this.model);
        },
        mounted() {
        },
        watch(){
            this.$parent.data.formValidate(val,old)
            {
                console.log(val);
            }
        },
        computed:{
            datalist(){
                return this.$store.getters[this.getternamelocal];
            },
        }
    };
</script>

<style scoped>

</style>
