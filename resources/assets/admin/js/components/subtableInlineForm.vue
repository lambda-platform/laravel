<template>
    <tr>
        <td v-for="item in f.schema" v-if="item.formType !== null && item.model && !item.hidden" :key="item.index">
            <component :is="element(item.formType)" :model="{form: model, component: item.model}" size="small" :meta="setMeta(item)">
            </component>
        </td>

        <td class="action">
            <slot name="action"></slot>
        </td>
    </tr>
</template>

<script>
import { element } from "../index";
import { getRule } from "../../rule";

export default {
    props: ["f", "model"],

    created() {

        this.f.data = {};
        this.f.schema.forEach(item => {
            if (this.f.identity == item.model || item.formType == null) {
                return;
            }

            if (
                this.f.timestamp &&
                (item.model == "created_at" || item.model == "updated_at")
            ) {
                return;
            }

            this.setModel(item.model, item.default, item.formType);
        });
    },

    methods: {
        element: element,
        setModel(name, value, type) {
            this.f.data[name] = value;
        },
        setMeta(item) {

            delete item["table"];
            delete item["rules"];
            delete item["label"];
            delete item["span"];
            delete item["default"];
            // item.schemaId = this.$route.params.id;
            item.schemaId = this.$route.params.form;
            // item.schemaId = this.$props.schemaId;
            return item;
        }
    }
};
</script>

