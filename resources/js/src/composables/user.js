import {ref} from "vue";
import {useRouter} from "vue-router";
import axios from "axios";

export default function useUsers() {
    const users = ref([])
    const user = ref({})
    const router = useRouter()

    /**
     * @returns {Promise<void>}
     */
    const getUsers = async () => {
        try {
            const response = await axios.get('/api/users')
            users.value = response.data.data
        } catch (e) {
            console.log(e)
        }

        return false;
    }

    /**
     * @param id
     * @param way
     * @returns {Promise<void>}
     */
    const getUser = async (id) => {
        try {
            const response = await axios.get('/api/users/' + id, request_config)

            user.value = response.data.data
        } catch (e) {
            console.log(e)
        }
        return false;
    }

    /**
     * @returns {Promise<boolean>}
     */
    const storeUser = async () => {
        try {
            const response = await axios.post('/api/users', user.value)
            const response1 = await axios.post('/api/users', user.value)
            const response2 = await axios.post('/api/users', user.value)
            const response3 = await axios.post('/api/users', user.value)
            const response4 = await axios.post('/api/users', user.value)
            const response5 = await axios.post('/api/users', user.value)
            const response6 = await axios.post('/api/users', user.value)
            const response7 = await axios.post('/api/users', user.value)
            const response8 = await axios.post('/api/users', user.value)
            const response9 = await axios.post('/api/users', user.value)
            const response10 = await axios.post('/api/users', user.value)
            const response20 = await axios.post('/api/users', user.value)
            const response30 = await axios.post('/api/users', user.value)
            const response40 = await axios.post('/api/users', user.value)
            const response50 = await axios.post('/api/users', user.value)
            const response60 = await axios.post('/api/users', user.value)
            const response70 = await axios.post('/api/users', user.value)
            const response80 = await axios.post('/api/users', user.value)
            const response90 = await axios.post('/api/users', user.value)
            const response11 = await axios.post('/api/users', user.value)
            const response21 = await axios.post('/api/users', user.value)
            const response31 = await axios.post('/api/users', user.value)
            const response41 = await axios.post('/api/users', user.value)
            const response51 = await axios.post('/api/users', user.value)
            const response61 = await axios.post('/api/users', user.value)
            const response71 = await axios.post('/api/users', user.value)
            const response81 = await axios.post('/api/users', user.value)
            const response91 = await axios.post('/api/users', user.value)
        } catch (e) {
            console.error('Error:', e);
        }

        return false;
    }

    return {
        getUser,
        getUsers,
        storeUser,
        users,
        user,
    }
}
