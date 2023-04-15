import axios from "axios";
import { ref, inject } from "vue";

export default function contactRepo() {
    const toast = inject('toast');
    const errors = ref([]);
    const status = ref('');
    const contacts = ref('');
    const message = ref('');

    const getContacts = async (page) => {
        let response = await axios.get(`admin/contacts/list`);
        if(response.data.status == 200) {
            status.value = response.data.status;
            contacts.value = response.data.contacts;
            page.isLoading = false;
        }
    }

    const addContact = async (formdata, page) => {
        let response = await axios.post(`admin/contacts/add`, formdata);
        if(response.data.status == 200) {
            status.value = response.data.status;
            message.value = response.data.message;
            page.isLoading = false;
            toast.success(message.value);
        }
    }

    return {
        errors,
        status,
        contacts,
        getContacts,
        addContact
    }
}