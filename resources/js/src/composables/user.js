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
            let request_config = {
                headers: {
                    'authorization': 'Bearer ' + localStorage.getItem('access_token')
                }
            }
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
            let request_config = {}
            user.value.user_role_id = 2;

            const response = await axios.post('/api/users', user.value, request_config)
        } catch (e) {
            if (e.response && e.response.status === 422) {
                if (e.response.data.errors.password) {
                    alert(e.response.data.errors.password);
                }
                e.value = e.response.data.errors;
            } else {
                console.error('Error:', e);
            }
            console.log(e)
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
