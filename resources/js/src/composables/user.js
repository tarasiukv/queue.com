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
