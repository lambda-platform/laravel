<template>
    <section class="page page-faq page-sidebar" style="max-width:800px;">
        <krud :template="property.template" :property="property"></krud>
    </section>
</template>

<script>
export default {
    computed: {
        property() {
            return {
                template: "edit",
                schema: this.$route.params.schema,
                id: this.$route.params.id
            };
        }
    }
};
</script>
