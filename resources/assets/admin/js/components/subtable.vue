<template>
    <div style="border: 1px dashed #eee; padding: 20px" class="mbsubtable">
        <Row>
            <Col span="12">
            {{title}}
            </Col>
            <Col span="12" style="text-align:right">
            <!--<Button type="success" icon="plus" @click="showAgentgivepricemodal(true)">Нэмэх</Button>-->
            <!--<Button type="warning" icon="close" @click="removeagentprice">Хасах</Button>-->
            </Col>
        </Row>
        <div class="splitdiv"></div>
        <span class="mblabel" style="">
                    Маршрутын мэдээлэл зөв гаргахын тулд агентуудыг нэмэхдээ дээрээс нь доошоо хаанаас хаа хүртэл гэдгээ оруулна уу</span>
        <br/>
        <br/>
        <!--<Table size="small" :columns="columns8" :data="data7" ></Table>-->
        <!--<i-table size="small" height="200" :columns="columnsagentprice" @on-selection-change="selectrow"-->
                 <!--:data="formValidate.agentprice"></i-table>-->
    </div>
</template>
<script>
    export default {
        props: ['title'],//['placeholder','gettername','actionname','model','modelname'],

        created(){

        },
        mounted() {

        },
        watch(){

        },
        computed:{

        },
    };
</script>

<style scoped>

</style>
