<style scoped>
.glyphicon { margin-right:10px; }
.panel-body { padding:0px; }
.panel-body table tr td { padding-left: 15px }
.panel-body .table {margin-bottom: 0px; }

a { text-decoration: none;}
</style>

<template>
    <div>
        <div class="col-sm-3 col-md-3">
            <div class="panel-group" id="accordion">
                <template v-for="(menu, index) in sidebar">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" v-bind:href="menu.slug"><i v-bind:class="menu.icon" aria-hidden="true"></i> &nbsp;
                            {{menu.name}}</a>
                            </h4>
                        </div>
                        <div v-bind:id="menu.id" v-bind:class="'panel-collapse collapse'">
                            <div class="panel-body">
                                <table class="table">
                                    <template v-for="item in menu.submenu">
                                        <tr>
                                            <td>
                                                <i v-bind:class="item.icon"></i>&nbsp;<a v-bind:href="item.link">{{item.name}}</a>
                                            </td>
                                        </tr>
                                    </template>
                                </table>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        /*
         * The component's data.
         */
        data() {
            return {
                sidebar: [{
                    id: "basic-training",
                    slug: "#basic-training",
                    name: "Basic Training",
                    icon: "fa fa-user-circle-o",
                    submenu: [{
                        icon: "fa fa-bluetooth",
                        link: "#",
                        name: "Starter",
                    },
                    {
                        icon: "",
                        link: "#",
                        name: "Starter Menu 2",
                    },
                    {
                        icon: "",
                        link: "#",
                        name: "Starter Menu 3",
                    },
                    {
                        icon: "fa fa-comments",
                        link: "#",
                        name: "Starter Menu 4",
                    },
                    ]
                },
                {
                    id: "advanced-training",
                    slug: "#advanced-training",
                    name: "Advanced Training",
                    icon: "fa fa-briefcase",
                    submenu: []
                }],

            };
        },
        methods: {}
    }
</script>
