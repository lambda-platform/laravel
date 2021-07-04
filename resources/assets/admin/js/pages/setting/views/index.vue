<template>
    <section class="page page-faq page-sidebar">
        <div class="sub-page">
            <router-view>
                <nav slot="v-nav">
                    <div class="card">
                        <h3 class="card-header">
                            Тохиргоо
                        </h3>
                        <ul class="card-body">

                            <li>
                                <router-link to="/setting/crud/canvas/Тогтмол-утга/60/61">
                                    <Icon type="ios-arrow-dropright"></Icon>
                                    Тогтмол утга
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/setting/crud/canvas/Системийн-хэрэглэгч/63/62">
                                    <Icon type="ios-arrow-dropright"></Icon>
                                    Системд нэвтрэх хэрэглэгч
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/setting/crud/canvas/Контент/315/314">
                                    <Icon type="ios-arrow-dropright"></Icon>
                                    Контент
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </nav>
            </router-view>
        </div>
    </section>
</template>
<script>
export default {

};
</script>
