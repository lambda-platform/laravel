<template>
    <subheader>
        <div slot="left">
            <h3 class="title">
                {{ title }}
            </h3>
        </div>
        <div slot="right">
            <ul>
                <li>
                    <Badge dot>
                        <a href="#" class="demo-badge">
                            <Icon type="ios-bell-outline"></Icon>
                        </a>
                    </Badge>
                </li>

                <li>
                    <Poptip placement="bottom-end">
                        <a href="javascript:void(0)">
                            <Icon type="ios-keypad"></Icon>
                        </a>
                        <div class="header-apps" slot="content">
                            <Tabs value="apps" size="small">
                                <TabPane label="Програмууд" name="apps">
                                    <Row>
                                        <Col span="8">
                                        <a href="/logistic">
                                            <img src="/images/apps/github.png" alt="">
                                            <span>CMS</span>
                                        </a>
                                        </Col>
                                        <Col span="8">
                                        <a href="/logistic">
                                            <img src="/images/apps/slack.png" alt="">
                                            <span>HR</span>
                                        </a>
                                        </Col>
                                        <Col span="8">
                                        <a href="/logistic">
                                            <img src="/images/apps/bitbucket.png" alt="">
                                            <span>CRM</span>
                                        </a>
                                        </Col>

                                        <Col span="8">
                                        <a href="/logistic">
                                            <img src="/images/apps/dribbble.png" alt="">
                                            <span>Ложистик</span>
                                        </a>
                                        </Col>
                                        <Col span="8">
                                        <a href="/logistic">
                                            <img src="/images/apps/mail_chimp.png" alt="">
                                            <span>Захидал</span>
                                        </a>
                                        </Col>
                                        <Col span="8">
                                        <a href="/logistic">
                                            <img src="/images/apps/dropbox.png" alt="">
                                            <span>Файлын сан</span>
                                        </a>
                                        </Col>
                                    </Row>
                                </TabPane>
                                <TabPane label="Нэмэлтүүд" name="plugins">
                                    <Row>
                                        <Col span="8">
                                        <a href="/lambda/vb">
                                            <img src="/images/apps/github.png" alt="">
                                            <span>UI builder</span>
                                        </a>
                                        </Col>
                                        <Col span="8">
                                        <a href="/logistic">
                                            <img src="/images/apps/mail_chimp.png" alt="">
                                            <span>Form</span>
                                        </a>
                                        </Col>
                                    </Row>
                                </TabPane>
                            </Tabs>
                        </div>
                    </Poptip>
                </li>

                <li class="avatar-item">
                    <Poptip placement="bottom-end">
                        <a href="javascript:void(0)" class="avatar">
                            <img src="/images/avatar.png" alt="avatar" class="avatar">
                        </a>
                        <div class="header-profile" slot="content">
                            <div class="header-profile-info">
                                <h3>Admin</h3>
                                <small>system administrator</small>
                            </div>
                            <ul>
                                <li>
                                    <a href="#">
                                        <Icon type="ios-color-filter-outline"></Icon>
                                        <span>Хувийн мэдээлэл</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <Icon type="ios-gear-outline"></Icon>
                                        <span>Тохиргоо</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <Icon type="ios-locked-outline"></Icon>
                                        <span>Системээс гарах</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </Poptip>
                </li>
            </ul>
        </div>
    </subheader>
</template>
<script>
    export default {
        props: ["title"]
    };
</script>

