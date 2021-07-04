<template>
    <section class="page page-faq page-sidebar" style="max-width:1000px;">
        <krud :template="`create`" :property="property"></krud>
    </section>
</template>

<script>
export default {
    computed: {
        property() {
            return {
                schema: this.$route.params.schema
            };
        }
    }
};
</script>
