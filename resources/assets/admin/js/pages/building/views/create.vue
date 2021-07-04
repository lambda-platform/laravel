<template>
    <section class="page page-content">
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
