<template>
    <div class="user-control">
        <ul>
            <li>
                <slot name="firstPane"></slot>
            </li>
            <li> &nbsp;&nbsp;&nbsp; </li>
            <li>
                <Badge dot>
                    <a href="#" class="demo-badge">
                        <Icon type="md-notifications-outline"/>
                    </a>
                </Badge>
            </li>

            <li class="avatar-item">
                <Poptip placement="bottom-end" popper-class="no-animation">
                    <a href="javascript:void(0)" class="avatar">
                        <img src="/images/avatar.png" alt="avatar" class="avatar">
                    </a>
                    <div class="header-profile" slot="content">
                        <div class="header-profile-info">
                            <h3>{{ $user.login }}</h3>
                            <small>system administrator</small>
                        </div>
                        <ul>
                            <li>
                                <a href="javascript:void(0)">
                                    <Icon type="ios-contact-outline"/>
                                    <span>Хувийн мэдээлэл</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <Icon type="ios-settings-outline"/>
                                    <span>Тохиргоо</span>
                                </a>
                            </li>
                            <li>
                                <a @click="logoutModal = true">
                                    <Icon type="ios-log-out"/>
                                    <span>Системээс гарах</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </Poptip>
            </li>
        </ul>

        <Modal v-model="logoutModal" :closable="false" width="252" class="logout-modal">
            <p slot="header" style="display:none;"></p>
            <div style="text-align:center">
                <a @click="logout()">
                    <Icon type="md-log-out"/>
                    Гарах
                </a>
                <a @click="cancel()">
                    <Icon type="md-refresh"/>
                    Болих
                </a>
            </div>
            <div slot="footer" style="display:none;">
                <form action="/auth/logout"></form>
            </div>
        </Modal>
    </div>
</template>

<script>
    export default {
        name: "UserControl",
        data() {
            return {
                logoutModal: false,
                poptipOption: {
                    animation: 'none',
                    modifiers: {
                        computeStyle: {
                            gpuAcceleration: false,
                        },
                        preventOverflow: {
                            boundariesElement: 'window'
                        }
                    }
                }
            };
        },
        methods: {
            logout() {
                axios.post("/auth/logout", {}).then(o => {
                    window.location = "/auth/login";
                });
            },
            cancel() {
                this.$data.logoutModal = false;
            }
        }
    }
</script>

<style lang="scss">
    $primary: #007AE5;
    $text-color: #001E35;
    .no-animation {
        transition: all 0s !important;
        .ivu-poptip-popper {
            transition: all 0s !important;
        }
    }

    .user-control {
        ul {
            list-style: none;
            &.transparent {
                margin-right: 4px;
                li {
                    margin-right: 6px;
                    a {
                        background-color: hsla(0, 0%, 100%, .7) !important;
                        max-height: 32px;
                        min-width: 32px;
                        border-radius: 3px;
                        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .3);
                        &:hover {
                            background: #ffffff;
                            color: $primary;
                        }
                        &.avatar {
                            padding-right: 6px;
                            padding-left: 2px;
                            background: transparent;
                            img {
                                height: 28px;
                                width: auto;
                                margin-right: 5px;
                            }
                            span {
                                color: $text-color;
                                font-size: 10px;
                                font-weight: 500;
                                text-transform: uppercase;
                            }
                        }
                        i {
                            font-size: 18px;
                        }
                    }
                    .ivu-badge {
                        position: relative;
                        a {
                            display: block;
                            max-height: 32px;
                            width: 32px;;
                            font-size: 11px;
                            cursor: pointer;
                            font-weight: 500;
                            transition: all .2s ease-in-out;
                            text-align: center;
                            padding: 0;
                            i,
                            span {
                                color: $text-color;
                                line-height: 32px;
                            }
                            &:hover {
                                i {
                                    color: $primary;
                                }
                            }
                        }
                        sup {
                            top: 5px;
                            right: 5px;
                            box-shadow: none;
                        }
                    }
                }
            }
            > li {
                position: relative;
                float: left;
                > a,
                .ivu-poptip-rel > a,
                .ivu-badge > a {
                    height: 42px;
                    min-width: 42px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    text-align: center;
                    &.transparent {
                        background: rgba(#ffffff, .7);
                        margin-right: 5px !important;
                    }
                    i {
                        color: $text-color;
                        line-height: 42px;
                        font-size: 22px;
                    }
                    &:hover {
                        i,
                        span {
                            color: $primary;
                        }
                    }
                    &.avatar {
                        padding: 0;
                        img {
                            max-height: 32px;
                            max-width: 32px;;
                            border-radius: 50%;
                            margin: 0 auto;
                        }
                        span {
                            color: $text-color;
                            font-size: 12px;
                            font-weight: 500;
                        }
                    }
                }
                &:last-child {
                    border-right: 0;
                }
                .ivu-badge {
                    a {
                        display: inline-block;
                        position: relative;
                        height: 42px;
                        min-width: 32px;
                        font-size: 14px;
                        cursor: pointer;
                        font-weight: 500;
                        transition: all .2s ease-in-out;
                        text-transform: uppercase;
                        i,
                        span {
                            color: $text-color;
                            line-height: 42px;
                        }
                        &:hover {
                            i {
                                color: $primary;
                            }
                        }
                    }
                    sup {
                        top: 10px;
                        right: 10px;
                        box-shadow: none;
                    }
                }
                .header-apps {
                    width: 230px;
                    padding: 0 0 10px 0;
                    .ivu-col {
                        padding: 10px 0;
                        a {
                            display: flex;
                            flex-direction: column;
                            border-radius: 3px;
                            height: 90px;
                            width: 75px;
                            color: #737373;
                            align-items: center;
                            justify-content: center;
                            border: 1px solid transparent;
                            &:hover {
                                border: 1px solid #eeeeee;
                            }
                            img {
                                height: 35px;
                                max-height: 35px;
                                max-width: 35px;
                                margin-bottom: 8px;
                            }
                            span {
                                display: block;
                                overflow: hidden;
                                text-overflow: ellipsis;
                                white-space: nowrap;
                                font-size: 12px;
                                color: #555555;
                            }
                        }
                    }
                }
                &.avatar-item {
                    .ivu-poptip-content {
                        padding: 0;
                        .ivu-poptip-arrow {
                            border-bottom-color: $primary;
                            &:after {
                                border-bottom-color: $primary;
                            }
                        }
                        .ivu-poptip-body {
                            padding: 0 !important;
                            width: 200px;
                            .header-profile {
                                padding: 0 0 5px;
                                &-info {
                                    background: $primary;
                                    padding: 8px 16px;
                                    border-top-left-radius: 3px;
                                    border-top-right-radius: 3px;
                                    color: #ffffff;
                                    margin-bottom: 10px;
                                    h3 {
                                        font-size: 18px;
                                    }
                                    small {
                                        font-size: 11px;
                                    }
                                }
                                ul {
                                    li {
                                        a {
                                            display: flex;
                                            align-items: center;
                                            padding: 0 16px;
                                            color: #555555;
                                            width: 200px;
                                            justify-content: left;
                                            cursor: pointer;
                                            i {
                                                width: 20px;
                                                margin-right: 8px;
                                            }
                                            &:hover {
                                                background: #f4f5f6;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
</style>
