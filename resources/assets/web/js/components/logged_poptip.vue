<template>
    <el-popover
        placement="bottom"
        width="200"
        trigger="click"
        popper-class="client-profile-popup"
    >
        <ul>
            <li>
                <a href="/#/profile">
                    <i class="flaticon-user"></i> Хувийн мэдээлэл
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" @click="logout()">
                    <i class="flaticon-logout"></i> Системээс гарах
                </a>
            </li>
        </ul>
        <a slot="reference" href="javascript:void(0)" class="sign-in client-profile-youth">
            <i class="fa fa-user-circle-o"/> {{user.login}}
        </a>
    </el-popover>
    <!--<a href="javascript:void(0)" class="sign-in client-profile-youth">-->
        <!--&lt;!&ndash;{{user.login}}&ndash;&gt;-->
        <!--<Poptip placement="bottom-end">-->
            <!--<a href="javascript:void(0)">-->
                <!--<i class="fa fa-user-circle-o"/> {{user.login}}-->
            <!--</a>-->

            <!--<div class="header-profile" slot="content" style="width: 200px">-->
                <!--<div class="header-profile-info" style="height: 45px">-->
                    <!--&lt;!&ndash;<img :src="`${user.profile}`" alt="avatar" class="avatar">&ndash;&gt;-->
                    <!--<div class="avatar-container">-->
                        <!--<img src="/images/avatar.png" alt="avatar" class="avatar">-->
                    <!--</div>-->
                    <!--<div class="name-container">-->
                        <!--<h3>{{user.login}}</h3>-->
                        <!--<small v-if="user.role==36">Байгууллага</small>-->
                        <!--<small v-if="user.role==35">СД ажилтан</small>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<ul>-->
                    <!--<li v-if="user.role==35">-->
                        <!--<a href="/#/myprofile">-->
                            <!--<span>Хувийн мэдээлэл</span>-->
                        <!--</a>-->
                    <!--</li>-->
                    <!--<li v-if="user.role==35">-->
                        <!--<a href="/#/myvolunteerworks">-->
                            <!--<span>Сайн дурын ажлууд</span>-->
                        <!--</a>-->
                    <!--</li>-->
                    <!--&lt;!&ndash;<li v-if="user.role==35">&ndash;&gt;-->
                    <!--&lt;!&ndash;<a href="/#/myoldvolunteerworks">&ndash;&gt;-->
                    <!--&lt;!&ndash;<span>Өмнөх ажлууд</span>&ndash;&gt;-->
                    <!--&lt;!&ndash;</a>&ndash;&gt;-->
                    <!--&lt;!&ndash;</li>&ndash;&gt;-->
                    <!--<li v-if="user.role==36">-->
                        <!--<a href="/#/profile">-->
                            <!--<span>Профайл мэдээлэл</span>-->
                        <!--</a>-->
                    <!--</li>-->
                    <!--<li v-if="user.role==36">-->
                        <!--<a href="/#/requests">-->
                            <!--<span>Хүсэлтүүд</span>-->
                        <!--</a>-->
                    <!--</li>-->
                    <!--<li>-->
                        <!--<a href="javascript:void(0)" @click="logout()">-->
                            <!--<span>Системээс гарах</span>-->
                        <!--</a>-->
                    <!--</li>-->
                <!--</ul>-->
            <!--</div>-->
        <!--</Poptip>-->
    <!--</a>-->
</template>

<script>
    export default {
        props: ['user'],
        name: "logged_poptip",
        methods: {
            logout() {
                axios.post("/auth/logout", {}).then(o => {
                    window.location = "/";
                });
            },
        }
    }
</script>

