<style scoped>

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
                sidebar: [],
            };
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component (Vue 2.x).
             */
            prepareComponent() {
                this.getSidebar();
            },

            /**
             * Get the documentation sidebar
             */
            getSidebar() {
                this.$http.get('/documentation/sidebar')
                        .then(response => {
                            this.sidebar = response.data;
                        });
            },
        }
    }
</script>
