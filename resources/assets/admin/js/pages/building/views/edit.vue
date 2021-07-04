<template>
    <section class="page page-faq page-sidebar" style="max-width:1000px;">
        <krud :template="`edit`" :property="property"></krud>
    </section>
</template>

<script>
export default {
    computed: {
        property() {
            return {
                schema: this.$route.params.schema,
                id: this.$route.params.id
            };
        }
    }
};
</script>
