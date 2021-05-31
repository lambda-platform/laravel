<template>
    <div>
        <div class="top-line"></div>
        <Header></Header>
        <div class="slim-mainpanel">
            <router-view :key="$route.path"></router-view>
        </div>
        <Footer></Footer>
    </div>
</template>

<script>
import Header from "./components/header";
import Footer from "./components/footer";

export default {
    components: {Header, Footer},
};
</script>