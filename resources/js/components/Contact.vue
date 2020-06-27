<template>
    <div class="container">
        <div class="panel panel-default mt-3">
            <div class="panel-heading mb-3">Форма отправки сообщения</div>
            <div class="panel-body p-3 rounded">
                <form @submit.prevent="onSubmit()">
                    <div class="form-group">
                        <label for="name">Ваше имя</label>
                        <input
                            type="text"
                            class="form-control"
                            :class="!!getFirstError('name') ? 'is-invalid' : ''"
                            id="name"
                            placeholder="Как к Вам можно обращаться"
                            v-model="formData.name"
                        >
                        <small v-if="!!getFirstError('name')" class="form-text text-danger">
                            {{ getFirstError('name') }}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="phone">Номер телефона</label>
                        <input
                            ref="phone-input"
                            type="tel"
                            class="form-control"
                            :class="!!getFirstError('phone') ? 'is-invalid' : null"
                            id="phone"
                            aria-describedby="phoneHelp"
                            placeholder="+7 888 88888"
                            v-model="formData.phone"
                        >
                        <small v-if="!!getFirstError('phone')" class="form-text text-danger">
                            {{ getFirstError('phone') }}
                        </small>
                        <small id="phoneHelp" class="form-text text-muted">
                            Мы обязуемся не разглашать номер Вашего телефона.
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="message">Ваш вопрос</label>
                        <textarea
                            class="form-control"
                            :class="!!getFirstError('message') ? 'is-invalid' : ''"
                            id="message"
                            v-model="formData.message"
                        >
                        </textarea>
                        <small v-if="!!getFirstError('message')" class="form-text text-danger">
                            {{ getFirstError('message') }}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="storage">Сохранение данных (для тестирования)</label>
                        <select class="form-control" id="storage" v-model="formData.storage">
                            <option
                                v-for="st of storages"
                                :value="st.value"
                                :key="st.id"
                                :selected="st.value === formData.storage"
                            >
                                {{ st.text }}
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-outline-dark">Отправить</button>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Contact",
        data() {
            return {
                formData: {
                    name: null,
                    phone: null,
                    message: null,
                    storage: 'defaultDb',
                },

                storages: [
                    {id: 1, value: 'defaultDb', text: 'Основная БД'},
                    {id: 2, value: 'secondDb', text: 'Вторая БД'},
                    {id: 3, value: 'fileStorage', text: 'Файл'},
                    {id: 4, value: 'emailStorage', text: ' E-mail'},
                ],
                resource: null,
                errors: [],
                modal: false
            }
        },
        methods: {
            onSubmit () {
                this.errors = [];
                this.resource.save({}, this.formData )
                 .then(response => response.json())
                 .then(result => {
                    this.showModal(result.code)
                 })
                 .catch(error => {
                     this.setErrors(error.bodyText)
                 })
            },
            setErrors(errors) {
                let errorsObject = JSON.parse(errors)
                if (errorsObject.hasOwnProperty('errors')) {
                    for (const [key, value] of Object.entries(errorsObject.errors)) {
                        this.errors.push([key, value[0]])
                    }
                }
            },
            getFirstError(key) {
                const err = this.errors.filter(e => {
                    return e[0] === key
                })
                if (err.length) {
                    return err[0][1]
                }
                return null;
            },
            showModal(code) {
                //console.log(code)
            }
        },
        created() {
            this.resource = this.$resource('messages')
        }
    }
</script>

<style scoped>
    .panel-body {
        border: 1px solid #ddd;

    }
    .panel-heading {
        font-weight: bolder;
        text-align: center;
    }
</style>
