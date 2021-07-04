<template>
    <section class="page page-faq page-sidebar">
        <div class="sub-page">
            <router-view>
                <nav slot="v-nav">
                    <div class="card">
                        <h3 class="card-header">
                            Лавлах мэдээлэл
                        </h3>
                        <ul class="card-body">
                            <li>
                                <router-link to="/faq/crud/canvas/Компани/39/49">
                                    <Icon type="ios-arrow-dropright"/>
                                    Компани
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/faq/crud/canvas/Сөх/311/312">
                                    <Icon type="ios-arrow-dropright"/>
                                    СӨХ
                                </router-link>
                            </li>

                            <li>
                                <router-link to="/faq/crud/canvas/Хороолол/38/48">
                                    <Icon type="ios-arrow-dropright"/>
                                    Хороолол
                                </router-link>
                            </li>

                            <li>
                                <router-link to="/faq/crud/canvas/Хотхон/37/47">
                                    <Icon type="ios-arrow-dropright"/>
                                    Хотхон
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/faq/crud/canvas/Баг-хороо/36/46">
                                    <Icon type="ios-arrow-dropright"/>
                                    Баг хороо
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/faq/crud/canvas/Төслүүд/157/158">
                                    <Icon type="ios-arrow-dropright"/>
                                    Төслүүд
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
        data: {
            return() {
                options: {
                    height: "500px";
                }
            }
        }
    };
</script>
