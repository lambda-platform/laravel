<template>
    <section class="page page-faq page-sidebar">
        <krud class="material" :template="property.template" :property="property" ref="krud">
            <user-control slot="right"></user-control>
        </krud>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                property: {
                    template: this.$route.params.template,
                    title: this.$route.params.title,
                    grid: this.$route.params.grid,
                    form: this.$route.params.form
                }
        }
        }
    };
</script>
