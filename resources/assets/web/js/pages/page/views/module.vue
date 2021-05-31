<template>
    <section>
        <agent v-if="$route.params.module == 'agent'">
            <user-control slot="user-control"></user-control>
        </agent>

        <agent-form v-if="$route.params.module == 'profile'">
            <user-control slot="user-control"></user-control>
        </agent-form>

        <agent-form v-if="$route.params.module == 'quizbank'">
            <quizbank-list slot="user-control"></quizbank-list>
        </agent-form>

    </section>
</template>

<script>
    import UserControl from "../../../components/UserControl"

    export default {
        components: {
            UserControl
        }
    };
</script>
