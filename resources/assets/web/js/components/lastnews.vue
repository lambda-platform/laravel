<template>
    <div class="widget recent-posts">
        <h5 class="sidebar-title">Сүүлд нэмэгдсэн мэдээ</h5>
        <div class="media mb-4" v-for="item in news" :key="news.id">
            <a :href="`/#/newsdetail/${item.id}`">
                <img :src="item.thumb" alt="sub-property" style="height: 75px; object-fit: cover">
            </a>
            <div class="media-body align-self-center">
                <h5 style="height: 30px;overflow: hidden; font-size: 14px">
                    <a style="font-size: 14px" :href="`/#/newsdetail/${item.id}`">{{item.title}}</a>
                </h5>
                <p>{{customGetDate(item.created_at)}}</p>
                <p><strong>Admin</strong></p>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "lastnews",
        data(){
            return {
                news:window.init.lastnews
            }
        },
        methods: {
            customGetDate(d) {
                return d.substring(0, 10);
            }

        }
    }
</script>

<style scoped>

</style>
