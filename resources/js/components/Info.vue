<template>
    <div class="container">

       <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">БД по умолчанию</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Вторая БД</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Файл</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table table-striped" id="db-default-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">Сообщение</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="message of defaultDb">
                            <th scope="row">{{message.id}}</th>
                            <td>{{message.name}}</td>
                            <td>{{message.phone}}</td>
                            <td>{{message.message}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table class="table table-striped" id="db-second-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">Сообщение</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="message of secondDb">
                            <th scope="row">{{message.id}}</th>
                            <td>{{message.name}}</td>
                            <td>{{message.phone}}</td>
                            <td>{{message.message}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <table class="table table-striped" id="db-file-storage">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">Сообщение</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="message of fileStorage">
                            <th scope="row">{{message.id}}</th>
                            <td>{{message.name}}</td>
                            <td>{{message.phone}}</td>
                            <td>{{message.message}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Info",
        data () {
            return {
                messages: {},
                resource: null
            }
        },
        computed: {
            defaultDb () {
                return this.messages.defaultDb
            },
            secondDb () {
                return this.messages.secondDb
            },
            fileStorage () {
                return this.messages.fileStorage
            }
        },
        created() {
            this.resource = this.$resource('messages')
            this.resource.get()
                .then(response => response.json())
                .then(messages => this.messages = messages.data)
        },
    }
</script>

<style scoped>

</style>
