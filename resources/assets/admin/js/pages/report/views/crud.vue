<template>
    <section class="page page-faq page-sidebar">
        <crud-template :template="property.template" :property="property"></crud-template>
    </section>
</template>

<script>
export default {
    computed: {
        property() {
            return {
                template: this.$route.params.template,
                title: this.$route.params.title,
                grid: this.$route.params.grid,
                form: this.$route.params.form
            };
        }
    }
};
</script>
