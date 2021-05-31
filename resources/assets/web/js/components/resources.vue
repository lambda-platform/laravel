<template>
    <div class="widget categories">
        <h5 class="sidebar-title">Манай санд</h5>
        <ul>
            <li
                v-for="item in maincategory" :key="item.id">
                <a :href="item.link">{{item.name}}<span>(12)</span></a>
            </li>

        </ul>
    </div>
</template>

<script>
    export default {
        name: "resources",
        data(){
            return{
                maincategory: window.init.maincategory,
            }
        }
    }
</script>

<style scoped>

</style>
