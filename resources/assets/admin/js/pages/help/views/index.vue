<template>
    <section class="page page-help">
        <iframe v-show="role==29"
            src="https://docs.google.com/document/d/e/2PACX-1vSVfFQo3i15BXSopSHXPhiOXq6tJPuYrYlN2wToLsSKreuJroLverArLfr8Uxn5vSolE0XFNu6qPbz7/pub?embedded=true"
            style="background: #fff;width:1000px; height:100%; border-left: solid 1px #dedede; border-right: solid 1px #dedede;" frameborder="0">
        </iframe>
        <iframe v-show="role!=29"
            src="https://docs.google.com/document/d/e/2PACX-1vTSqZ0wXys77_6QpnG0YK8t6QEgjA6QBlNNOwmPIC8_geQIJ1tB9m4x5WFqflhfloRar96eRwTsjo-P/pub?embedded=true"
                style="background: #fff;width:1000px; height:100%; border-left: solid 1px #dedede; border-right: solid 1px #dedede;" frameborder="0"></iframe>
    </section>
</template>
<script>
export default {
    data() {
        return {
            role: window.init.user.role
        };
    },
    mounted(){
        console.log("ROLE",role);
    }
}
</script>
