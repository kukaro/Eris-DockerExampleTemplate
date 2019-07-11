<template lang='pug'>
div.management-main-container
    span.name {{ $t('management.project.title') }}
    div.project-info
        span.sub-name {{ $t('management.project.info.title') }}
        div.info-container
            div.info
                span.info-name {{ $t('management.project.info.project_name') }}
                div.button(@click="saveProjectPackageName($event, `project`)") {{ $t('common.save2') }}
                input.select(v-model = "project_name" name="project_name" v-validate="{required: true}"
                :class="{ 'is-invalid': submitted && errors.has('project_name') }")
            div.info
                span.info-name {{ $t('management.project.info.package_name') }}
                div.button(@click="saveProjectPackageName($event, `package`)") {{ $t('common.save2') }}
                input.select(v-model = "package_name" name="package_name" v-validate="{required: true}"
                :class="{ 'is-invalid': submitted && errors.has('package_name') }")
            div.info
                span.info-name {{ $t('management.project.info.key') }}
                div.button(@click="copyProjectKey($event)") {{ $t('management.project.info.copy') }}
                input.select(v-model = "project_key" disabled)
            //- 중간 기획 변경에 따른 구조 변경 x

    div.project-mem
        span.sub-name {{ $t('management.project.member.title') }}
        div.mem-container
            b-table.mem-table(:hover="false", :items="memItems", :fields="memLists")
                template(slot="id" slot-scope="data")
                    | {{ data.index + 1 }}



</template>
<script>
    export default {

        data () {
            return {
                app : this.$root.app,
                project_name : '',
                package_name : '',
                project_key : '',
                submitted : false,
                memLists : [
                    {key:'id', label : this.$t('management.project.member.list'), headerTitle : 'management.project.member.list'},
                    {key:'email', label : this.$t('common.email'), headerTitle : 'common.email'},
                    {key:'nickname', label : this.$t('management.project.member.name'), headerTitle : 'management.project.member.name'},
                    {key:'level', label : this.$t('management.project.member.auth'), headerTitle : 'management.project.member.auth'},
                    // {key:'id', label : '목록'},
                    // {key:'email', label : '이메일'},
                    // {key:'nickname', label : '이름'},
                    // {key:'level', label : '권한'},
                ],
                memItems : [],
            }
        },
        watch : {
            'app.isInitDone'() {
                if( ! this.app.isInitDone ) {
                    return
                }
                this.fetch()
            },
            'app.cookie_lang': {
                handler(v, ov) {
                    if (!this.app.isInitDone) {
                        return
                    }
                    var vm = this;

                    $(".b-table th").each(function() {
                        $(this).html(vm.$t($(this).attr('title')))
                    });
                },
                deep: true
            }
        },

        methods: {
            fetch(){
                this.memItems = []

                $.get(`/api/project/${this.app.project_id}`).then((res) => {

                    this.project_name = res.project_name
                    this.package_name = res.package_name
                    this.project_key = res.project_key

                    res.member.forEach((v, i) => {
                        this.memItems.push({
                            'email' : v.email,
                            'nickname' : v.nickname,
                            'level' : v.level,
                        })
                    })

                })
            },
            saveProjectPackageName(event, type){
                //project, package 공통 Api
                this.submitted = true;

                let validateString = type == 'project' ? `project_name` : `package_name`
                let validateObject = type == 'project' ? this.project_name : this.package_name

                let query = {
                    project_name : this.project_name,
                    package_name : this.package_name,
                }

                if(type == 'project'){
                    delete query.package_name
                }else{
                    delete query.project_name
                }

                this.$validator.validate(validateString, validateObject).then(valid => {
                    if(valid){
                        this.$http.put(`/api/project/${this.app.project_id}`, JSON.stringify(query)).then((res)=>{
                            // alert('변경 되었습니다.')
                            alert(this.$t('management.success'))
                        }, (res)=> {
                            // alert('문제가 발생되었습니다.')
                            alert(this.$t('management.fail'))
                        })

                    }
                })


            },
            copyProjectKey(event){

                var self = this
                this.$copyText(this.project_key).then(function (e) {
                    alert(`Copied : ${self.project_key}`)
                }, function (e) {
                    alert('Can not copy')
                })
            },

        },
        mounted(){
            this.$validator.attach('project_name', 'required');
            this.$validator.attach('package_name', 'required');
        }

    }
</script>

<style lang='sass'>
    .management-main-container{
        margin : 0 auto;
        max-width : 1400px;
        height : 100%;

        .name{
            font-family: Roboto, NotoSansCJKkrs;
            display : block;
            margin : 32px 0;
            font-size : 20px;
            font-weight : bold;
    }
        .sub-name{
            display : block;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
    }
        .project-info{
            margin : 0 auto;
            .info-container{
                margin : 16px 0 0 0;
                padding : 24px 28px 24px 20px;
                height: 176px;
                border-radius: 8px;
                border: solid 1px #e7ebf8;
                background-color: #f5f6fa;

                .info{
                    width : 100%;
                    height : 32px;
                    margin : 0 0 16px 0;


                    .info-name{
                        font-family: NotoSansCJKkrs;
                        display : inline-block;
                        line-height : 32px;
                        float : left;
                        font-size: 12px;
                }
                    .no-select{
                        padding : 10px;
                        float : right;
                        width : calc(100% - 181px);
                        height: 32px;
                        border-radius: 7px;
                        background-color: #ffffff;
                        border : 1px solid #bbbecc;
                }
                    .select{
                        padding : 10px;
                        float : right;
                        width : calc(1400px - 236px);
                        height : 32px;
                        border-radius: 8px;
                        background-color: #ffffff;
                        border : 1px solid #bbbecc;
                        margin : 0 10px 0 0;

                }
                    .is-invalid{
                        border : 1px solid #ff6464 !important;
                }
                    .button{
                        float : right;
                        line-height : 32px;
                        text-align : center;
                        width: 79px;
                        height: 32px;
                        border-radius: 20px;
                        background-color: #3960e7;
                        color : white;
                        font-size : 12px;
                        font-weight : bold;

                        &:hover{
                            cursor : pointer;
                    }
                }
            }
        }
    }

        .project-mem{
            margin : 40px 0 0 0;

            .mem-container{
                margin-top: 14px;

                .mem-table{
                    margin :  0 auto;
                    text-align : center;

                    th{
                        border-top : solid 2px #bababa !important;
                        border-bottom : solid 2px #bababa !important;
                        font-size: 13px;
                        font-weight: bold;
                        color: #000000;
                }
                    thead tr th{
                        text-align : center;
                }
                    tbody tr{
                        font-size: 13px;
                        color: #000000;

                        td{
                            border-bottom : 1px solid #e4e4e4;
                            line-height : 1.95 !important;
                    }
                }
            }
        }
    }
    }

</style>
