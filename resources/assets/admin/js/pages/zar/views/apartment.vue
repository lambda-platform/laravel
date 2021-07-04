<template>
    <section class="page page-faq page-sidebar">
        <div class="buildingtab">
            <div class="header">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="ti ti-arrow-left"></i> Жагсаалт руу буцах</a>
                <h3>Зар нэмэх</h3>
            </div>
            <Tabs :animated="false" size="small" :value="tabname" @on-click="tabclicked">
                <TabPane label="ЕРӨНХИЙ МЭДЭЭЛЭЛ" name="tab1">
                    <dataform ref="form1" :schemaID="95" :editMode="actiontype=='edit'" :onSuccess="onSuccess" :onError="onError"></dataform>
                    <!--<krud :template="property1.template" :property="property1"></krud>-->
                </TabPane>
                <TabPane label="ҮНИЙН ДАВТАМЖ" :disabled="actiontype=='create'" name="tab2">
                    <dataform ref="form2" :schemaID="tab2schemaid" :editMode="true" :onSuccess="onSuccess" :onError="onError"></dataform>
                </TabPane>
                <TabPane label="ХАВСРАЛТ ЗУРГАН ФАЙЛ" :disabled="actiontype=='create'" name="tab3">
                    <dataform ref="form3" :schemaID="tab3schemaid" :editMode="true" :onSuccess="onSuccess" :onError="onError"></dataform>
                </TabPane>
            </Tabs>
        </div>
    </section>
</template>

<script>
    export default {
        props:['actiontype','id','barilgaid'],
        data(){
            return{
                iseditmode:false,
                tabname:'',
                tab2:false,
                tab3:false,
                tab2schemaid:false,//82
                tab3schemaid:false,//86
            }
        },
        watch:{
            tabname(newval){
                console.log(newval)
            }
        },
        computed: {
            property1() {
                return {
                    template: 'create',
                    title: "Үндсэн-мэдээлэл",
                    form:54
                };
            }
        },
        mounted() {
            if(this.$props.actiontype=='edit') {
                setTimeout(() => {
                    this.$refs.form1.editModel(this.$props.id);
                }, 500);
            }
        },
        methods:{
          onSuccess(data){
              this.$router.push('/building/barilga/createbarilga/edit/'+this.$props.barilgaid+'/'+this.$props.barilgaid);
          },
            tabclicked(tabid)
            {
                switch(tabid)
                {
                    case "tab2":{
                        if(!this.tab2)
                        {
                            this.tab2=true;
                            this.tab2schemaid=96;
                            //this.$refs.form3.initForm();
                            setTimeout(() => {
                                this.$refs.form2.editModel(this.$props.id);
                            }, 500);

                        }
                        break;

                    }
                    case "tab3":{
                        if(!this.tab3)
                        {
                            this.tab3=true;
                            this.tab3schemaid=97;
                            //this.$refs.form3.initForm();
                            setTimeout(() => {
                                this.$refs.form3.editModel(this.$props.id);
                            }, 500);

                        }
                        break;
                    }
                }

            }
        }
    };
</script>
