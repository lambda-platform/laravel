<template>
    <section class="page">
        <paper-header class="mini">
            <div slot="left">

            </div>
            <div slot="right">
                <user-control></user-control>
            </div>

            <div slot="nav">
                <ul>
                    <li>
                        <router-link to="/dashboard">
                            <Icon type="ios-analytics"/>
                            <span>Экселээс оруулах</span>
                        </router-link>
                    </li>
                </ul>
            </div>
            <div slot="tool">
            </div>
        </paper-header>
        <section class="page page-dashboard">
            <Row>
                <Col :xs="24" :sm="24" :md="18" :lg="18">
                    <div class="board map-wrapper">
                        <h3>Орон сууцны мэдээлэл</h3>
                        <div class="info-row ivu-row">
                            <div class="ivu-col ivu-col-span-12">
                                <div class="has-text-centered">
                                    <b>Орон сууц импорт</b>
                                </div>
                                <Upload action="mcud/barilga/importOS" :on-success="success">
                                    <Button type="ghost" icon="ios-cloud-upload-outline"></Button>
                                </Upload>
                                <a href="mcud/downloadOSLink">
                                    <span>Экселийн загвар татах /бүтэн/</span>
                                    <span class="icon is-small">
                                                    <fa icon="download"></fa>
                                                </span>
                                    <br/>
                                </a>
                                <a href="mcud/downloadOSSimpleLink">
                                    <span>Экселийн загвар татах /товч/</span>
                                    <span class="icon is-small">
                                                    <fa icon="download"></fa>
                                                </span>
                                </a>
                            </div>

                            <div class="ivu-col ivu-col-span-12">
                                <div class="has-text-centered">
                                    <b>Орон сууцны өрөөний сонголт импорт</b>
                                </div>
                                <Upload action="mcud/barilga/importOSObject" :on-success="success">
                                    <Button type="ghost" icon="ios-cloud-upload-outline"></Button>
                                </Upload>
                                <a class="button is-info animated fadeIn has-margin-right-small"
                                   href="mcud/downloadOSObjectLink">
                                    <span>Экселийн загвар татах</span>
                                    <span class="icon is-small">
                                                    <fa icon="download"></fa>
                                                </span>
                                </a>
                            </div>
                        </div>
                        <!--<div class="box">-->
                            <!--<div class="ivu-col ivu-col-span-12">-->
                                <!--<div class="has-text-centered">-->
                                    <!--<b>Тайлан оруулах</b>-->
                                <!--</div>-->
                                <!--<Upload action="realstate/barilga/importOSReport" :on-success="success">-->
                                    <!--<Button type="ghost" icon="ios-cloud-upload-outline"></Button>-->
                                <!--</Upload>-->
                                <!--<a class="button is-info animated fadeIn has-margin-right-small"-->
                                   <!--href="realstate/downloadOSReportLink">-->
                                    <!--<span>Экселийн загвар татах</span>-->
                                    <!--<span class="icon is-small">-->
                                                    <!--<fa icon="download"></fa>-->
                                                <!--</span>-->
                                <!--</a>-->
                            <!--</div>-->
                            <!--<div class="ivu-col ivu-col-span-12">-->
                                <!--<div class="has-text-centered">-->
                                    <!--<b>Барилгын компани оруулах</b>-->
                                <!--</div>-->
                                <!--<Upload action="realstate/company/import" :on-success="success">-->
                                    <!--<Button type="ghost" icon="ios-cloud-upload-outline"></Button>-->
                                <!--</Upload>-->
                                <!--<a class="button is-info animated fadeIn has-margin-right-small"-->
                                   <!--href="realstate/downloadCompanyLink">-->
                                    <!--<span>Экселийн загвар татах</span>-->
                                    <!--<span class="icon is-small">-->
                                                    <!--<fa icon="download"></fa>-->
                                                <!--</span>-->
                                <!--</a>-->
                            <!--</div>-->
                        <!--</div>-->

                    </div>
                </Col>
            </Row>

            <Row v-if="summary">
                <Col :xs="24" :sm="24" :md="18" :lg="18">
                    <div class="board map-wrapper">
                        <h3>Алдааны мэдээлэл</h3>


                        <span v-if="summary.structureIssues">
                            <span class="panel-icon has-text-danger">
                                <fa icon="times"></fa>
                            </span> Алдааны тоо:&emsp;
                        <span class="has-text-danger">
                                {{ summary.issues }}
                            </span>
                             <Tabs :animated="false" size="small" type="card">

                                    <TabPane
                                        v-for="(issues, category) in summary.structureIssues"
                                        :label="category" :key="category" :id="category">
                                    <ul class="issues has-margin-left-large">
                                                <li v-for="(issue, index) in issues" :key="index">
                                                    <span>
                                                                <b class="has-text-danger">{{ issue }}</b>
                                                            </span>
            </li>
            </ul>
            </TabPane>

            </Tabs>
            </span>
                        <span v-if="summary.successful">
                                <span class="panel-icon has-text-success">
                                    <fa icon="check"></fa>
                                </span> Оруулсан өгөгдлийн тоо:&emsp;
            <span class="has-text-success">
                                    {{ summary.successful }}
                                </span>
            </span>
                    </div>
                </Col>
            </Row>
        </section>
    </section>
</template>

<script>


    export default {

        data() {
            return {
                summary: null,
            }
        },
        methods: {
            success(val) {
                this.summary = val;
            }
        }
    };
</script>
