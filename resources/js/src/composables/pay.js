import axios from "axios";

export default function usePay() {
    /**
     * @returns {Promise<boolean>}
     */
    const pay = async (user_id) => {
        try {
             const response = await axios.post('/api/pays', {
                 user_id: user_id
             })
        } catch (e) {
            console.error('Error:', e);
        }

        return false;
    }

    return {
        pay
    }
}
