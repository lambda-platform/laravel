<template>
    <div class="subform-grid">
        <div class="subform-header">
            <h3>{{ form.name }}</h3>
        </div>
        <table border="1">
            <thead>
            <tr>
                <th v-for="item in form.schema"  :key="item.index">
                    {{ item.label }}
                </th>
                <th class="action">...</th>
            </tr>
            </thead>

            <tbody>
            <!--<grid-form v-for="(item, index) in listData" :key="index" :f="item.form" :model="item.model">-->
                <!--<template slot="action">-->
                    <!--<a href="javscript:void(0)" @click="remove(index)">-->
                        <!--<Icon type="trash-a"></Icon>-->
                    <!--</a>-->
                <!--</template>-->
            <!--</grid-form>-->
            </tbody>
        </table>

        <a class="sub-grid-add" href="javascript:void(0)" @click="add">
            <Icon type="plus"></Icon> Нэмэх
        </a>
    </div>
</template>

<script>
    // import GridForm from "./subtableInlineForm";

    export default {
        props: ["form"],
        components: {
            // "grid-form": GridForm
        },
        data() {
            return {
                listData: []
            };
        },
        created() {
            // this.model.form[this.model.component] = [];
            // if (!this.editMode) {
            //     this.add();
            // }
        },
        methods: {
            element: element,
            checkAddable() {
                return new Promise((resolve, reject) => {
                    let obj = this.listData[this.listData.length - 1];
                    if (obj) {
                        let hasValue = false;
                        let lastModel = obj.model;

                        for (let key in lastModel) {
                            if (
                                typeof lastModel[key] != undefined &&
                                lastModel[key] != null &&
                                lastModel[key] != "" &&
                                lastModel[key] != false
                            ) {
                                hasValue = true;
                            }
                        }
                        hasValue ? resolve(true) : reject(false);
                    } else {
                        resolve(true);
                    }
                });
            },

            addSubForm() {
                let clonedForm = _.cloneDeep(this.form);
                let clonedFormModel = {};
                clonedForm.schema.forEach(item => {
                    if (
                        clonedForm.identity == item.model ||
                        item.formType == null
                    ) {
                        return;
                    }

                    if (
                        clonedForm.timestamp &&
                        (item.model == "created_at" || item.model == "updated_at")
                    ) {
                        return;
                    }

                    clonedFormModel[item.model] = item.defaut;
                });

                let listItem = {
                    form: clonedForm,
                    model: clonedFormModel
                };
                this.model.form[this.model.component].push(clonedFormModel);
                this.listData.push(listItem);
            },

            add() {
                this.checkAddable()
                    .then(o => {
                        setTimeout(() => {
                            this.addSubForm();
                        }, 200);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },

            fillData() {
                this.listData = [];
                setTimeout(() => {
                    this.model.form[this.model.component].forEach(item => {
                        let listItem = {
                            form: _.cloneDeep(this.form),
                            model: item
                        };
                        this.listData.push(listItem);
                    });
                }, 100);
            },

            remove(index) {
                this.model.form[this.form.model].splice(index, 1);
                this.listData.splice(index, 1);
            }
        }
    };
</script>
