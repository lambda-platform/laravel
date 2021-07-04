<template>
    <div class="box">
        <div class="info-row ivu-row">
            <div class="ivu-col ivu-col-span-6">
                <div class="has-text-centered">
                    <b>Орон сууц импорт</b>
                </div>
                <Upload action="mcud/barilga/importOS" :on-success="success">
                    <Button type="ghost" icon="ios-cloud-upload-outline"> </Button>
                </Upload>
                <a href="mcud/downloadOSLink">
                    <span>Экселийн загвар татах</span>
                    <span class="icon is-small">
                                                    <fa icon="download"></fa>
                                                </span>
                </a>
            </div>
    
            <div class="ivu-col ivu-col-span-6">
                <div class="has-text-centered">
                    <b>Орон сууцны өрөөний сонголт импорт</b>
                </div>
                <Upload action="mcudv/barilga/importOSObject" :on-success="success">
                    <Button type="ghost" icon="ios-cloud-upload-outline"> </Button>
                </Upload>
                <a class="button is-info animated fadeIn has-margin-right-small" href="mcud/downloadOSObjectLink">
                    <span>Экселийн загвар татах</span>
                    <span class="icon is-small">
                                                    <fa icon="download"></fa>
                                                </span>
                </a>
            </div>
        </div>
        <div v-if="summary">
    
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
    </div>
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
