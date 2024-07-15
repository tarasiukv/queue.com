<script setup>
import {onMounted, ref} from "vue";
import useUsers from "../composables/user.js";
import usePay from "../composables/pay.js";
const {user, users, getUsers, storeUser, verifyUser } = useUsers();
const { pay } = usePay();

onMounted(async () => {
    await getUsers();
})
</script>

<template>
    <div>Hello</div>
    <form @submit.prevent="storeUser">
        <div>
            <p>Click below to create user)</p>
            <button class="submit" type="submit">Create user!</button>
        </div>
    </form>
    <table class="styled-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Verified</th>
            <th></th>
            <th>Payed</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td v-if="user.email_verified_at">YES</td>
            <td v-else><button @click="verifyUser(user.id)">verify</button></td>
            <td>{{ user.payments ? user.payments : null }}</td>
            <td><button @click="pay(user.id)">PAY</button></td>
        </tr>
        </tbody>
    </table>
</template>

<style scoped>
</style>
