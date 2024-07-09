<script setup>
import {onMounted} from "vue";
import useUsers from "../composables/user.js";
const {users, getUsers, storeUser } = useUsers();

onMounted(async () => {
    await getUsers();
    window.Echo.channel('sending_to_user_email_channel')
        .listen('EmailSentEvent', async (e) => {
            const user = users.find(u => u.id === e.user.id);
            if (user) {
                user.emailSent = true;
            }
        })
        .error((err) => {
            console.log(err)
        });
    window.Echo.channel('user.' + user.id)
        .listen('EmailSentEvent', (e) => {
            const user = users.find(u => u.id === e.user.id);
            if (user) {
                user.emailSent = true;
            }
        });
})
</script>

<template>
    <div>Hello</div>
    <form @submit.prevent="storeUser">
    <div>
        <p>Click below to create user)</p>
        <button class="submit btn" type="submit">Create user!</button>
    </div>
    </form>
    <div></div>
    <ul v-for="user in users" :key="user.id">
        <li>{{ user }}</li>
    </ul>
</template>

<style scoped>
.submit {
    background: #3ef073;
}
</style>
