<template>
    <section>

        <agent-form v-if="$route.params.module == 'profile'" type="profile">
            <user-control slot="user-control"></user-control>
        </agent-form>

        <agent-form v-if="$route.params.module == 'password'" type="password">
            <user-control slot="user-control"></user-control>
        </agent-form>
    </section>
</template>

<script>

    export default {

    };
</script>
