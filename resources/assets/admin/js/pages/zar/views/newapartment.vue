<template>
    <section class="page page-faq page-sidebar">
        <div class="buildingtab">
            <Tabs :animated="false" size="small" type="card" :value="tabname" @on-click="tabclicked">
                <TabPane label="ЕРӨНХИЙ МЭДЭЭЛЭЛ" name="tab1">
                    <dataform ref="form1" :schemaID="99" :editMode="actiontype=='edit'" :onSuccess="onSuccess" :onError="onError"></dataform>
                </TabPane>
                <TabPane label="ҮНИЙН ДАВТАМЖ" :disabled="actiontype=='create'" name="tab2">
                    <dataform ref="form2" :schemaID="tab2schemaid" :editMode="true" :onSuccess="onSuccess" :onError="onError"></dataform>
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
                            this.tab2schemaid=100;
                            //this.$refs.form3.initForm();
                            setTimeout(() => {
                                this.$refs.form2.editModel(this.$props.id);
                            }, 500);

                        }
                        break;

                    }

                }

            }
        }
    };
</script>
