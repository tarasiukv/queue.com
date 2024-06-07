<script setup>
import {onMounted} from "vue";
import useUsers from "../composables/user.js";
const {user, getUsers } = useUsers();

onMounted(async () => {
    window.Echo.channel('sending_to_user_email_channel')
        .listen('EmailSentEvent', async (e) => {
            await getUsers();
        })
        .error((err) => {
            console.log(err)
        });
    window.Echo.channel('user.' + this.userId)
        .listen('EmailSentEvent', (event) => {
            const user = this.users.find(u => u.id === event.user.id);
            if (user) {
                user.emailSent = true;
            }
        });
})
</script>

<template>
    <div>Hello</div>
</template>

<style scoped>

</style>
