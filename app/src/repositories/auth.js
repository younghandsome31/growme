import axios from "axios";
import { ref } from "vue";

export default function authRepo() {
    const errors = ref([]);
    const status = ref('');
    const message = ref('');
    const user = ref([]);

    const signOutUser = async (user) => {
        try {
            let response = await axios.post(`admin/auth/logout`, {
                user_id: user.id
            });
            
            if(response.data.status == 200) {
                axios.defaults.headers.common["Authorization"] = null;
                localStorage.removeItem('authuser');
                localStorage.removeItem('token');
                window.location.href = '/admin-login';
            }
        } catch (e) {
            if(e.response.status === 422) {
                errors.value = e.response.data.errors;
                status.value = e.response.status;
            }
        }
    }

    return {
        errors,
        status,
        message,
        user,
        signOutUser
    }
}