<template>
    <section class="page page-faq page-sidebar">
        <div class="buildingtab">
            <div class="header">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="ti ti-arrow-left"></i> Жагсаалт руу буцах</a>
                <h3>Барилга нэмэх</h3>
            </div>

            <Tabs :animated="false" size="small" :value="tabname" @on-click="tabclicked">
                <TabPane label="Үндсэн бүртгэл" name="tab1">
                    <dataform ref="form1" class="material-form" :schemaID="179" :editMode="actiontype=='edit'" :onSuccess="onSuccessFirstTab"
                              :onError="onError"></dataform>
                    <!--<krud :template="property1.template" :property="property1"></krud>-->
                </TabPane>
                <TabPane label="Нэмэлт мэдээлэл" :disabled="actiontype=='create'" name="tab2">
                    <dataform ref="form2" class="material-form" :schemaID="tab2schemaid" :editMode="true" :onSuccess="onSuccess"
                              :onError="onError"></dataform>
                </TabPane>
                <!--<TabPane label="ЗУРАГ" :disabled="actiontype=='create'">ЗУРАГ</TabPane>-->
                <TabPane label="Өрөөний сонголт" :disabled="actiontype=='create'" name="tab3">
                    <dataform ref="form3" class="material-form" :schemaID="tab3schemaid" :editMode="true" :onSuccess="onSuccess"
                              :onError="onError"></dataform>
                </TabPane>
                <TabPane label="Үнийн давтамж" :disabled="actiontype=='create'" name="tab4">
                    <dataform ref="form4" class="material-form" :schemaID="tab4schemaid" :editMode="true" :onSuccess="onSuccess"
                              :onError="onError"></dataform>
                </TabPane>
            </Tabs>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['actiontype', 'id', 'barilgaid'],
        data() {
            return {
                iseditmode: false,
                tabname: '',
                tab2: false,
                tab3: false,
                tab4: false,
                tab2schemaid: false,//82
                tab3schemaid: false,//86
                tab4schemaid: false,//88
            }
        },
        watch: {
            tabname(newval) {
                console.log(newval)
            }
        },
        computed: {
            property1() {
                return {
                    template: 'create',
                    title: "Үндсэн-мэдээлэл",
                    form: 54
                };
            }
        },
        mounted() {
            if (this.$props.actiontype == 'edit') {
                setTimeout(() => {
                    this.$refs.form1.editModel(this.$props.id);
                }, 500);
            }
        },
        methods: {
            onSuccessFirstTab($data){
                this.$router.push('/building/barilga/createbarilga/edit/' + $data.id+ '/' + $data.id);
            },
            onSuccess($data) {
                this.$router.push('/building/barilga/createbarilga/edit/'  + $data.id+ '/' + $data.id);
            },
            tabclicked(tabid) {
                switch (tabid) {
                    case "tab2": {
                        if (!this.tab2) {
                            this.tab2 = true;
                            this.tab2schemaid = 182;
                            //this.$refs.form2.initForm();
                            axios.get("/mcud/getbarilgadetail/" + this.$props.barilgaid).then(o => {
                                if (o.data.data == 0) {
                                    console.log('create');
                                }
                                else {
                                    console.log('edit');
                                    this.$refs.form2.editModel(o.data.data);
                                }
                            }).catch(function (error) {

                            });
                        }
                        break;

                    }
                    case "tab3": {
                        if (!this.tab3) {
                            this.tab3 = true;
                            this.tab3schemaid = 186;
                            //this.$refs.form3.initForm();
                            setTimeout(() => {
                                this.$refs.form3.editModel(this.$props.id);
                            }, 500);

                        }
                        break;
                    }
                    case "tab4": {
                        if (!this.tab4) {
                            this.tab4 = true;
                            this.tab4schemaid = 188;
                            //this.$refs.form4.initForm();
                            setTimeout(() => {
                                this.$refs.form4.editModel(this.$props.id);
                            }, 500);
                        }
                        break;
                    }
                }

            }
        }
    };
</script>
