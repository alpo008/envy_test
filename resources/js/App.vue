<template>
    <div class="main">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">
                Envy test
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav justify-content-end">
                    <router-link
                        tag="li"
                        class="nav-item"
                        exact-active-class="active"
                        v-for="link of this.links"
                        :key="link.title"
                        :to="link.url"
                    >
                        <a class="nav-link">{{ link.title}}</a>
                    </router-link>
                </ul>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        props: {
            source: String,
        },
        name: "App",
        data: () => {
            return {
                links: [
                    {title: 'Главная', url: '/'},
                    {title: 'Контакт', url: '/contact'},
                    {title: 'Информация', url: '/info'}
                ]
            }
        }
    }
</script>

<style scoped>

</style>
