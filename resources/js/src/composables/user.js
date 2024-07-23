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

    /**
     * @returns {Promise<boolean>}
     */
    const verifyUser = async (user_id) => {
        try {
             const response = await axios.post(`/api/verify/${user_id}`)
        } catch (e) {
            console.error('Error:', e);
        }

        return false;
    }

    /**
     * @param search_params
     * @returns {Promise<void>}
     */
    const searchUsers = async (search_params) => {
        try {
            const response = await axios.post('/api/users/search', {
                search_text: search_params.search_text,
                email: search_params.email,
                payments: search_params.payments,
            });
            users.value = response.data.data;
        } catch (e) {
            console.error(e);
        }
    };

    return {
        getUser,
        getUsers,
        storeUser,
        verifyUser,
        searchUsers,
        users,
        user,
    }
}
