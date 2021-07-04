<template>
    <section class="page page-faq page-sidebar">
        <krud :template="property.template" :property="property"></krud>
    </section>
</template>

<script>
export default {
    computed: {
        property() {
            return {
                template: this.$route.params.template,
                title: this.$route.params.title,
                grid: this.$route.params.grid
            };
        }
    }
};
</script>
