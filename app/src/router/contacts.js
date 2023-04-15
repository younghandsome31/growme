import Contacts from "@/views/page/Contacts.vue";
import AddContact from "@/views/page/subpages/contacts/AddContact.vue";

const routes = [
  {
    path: '/contacts',
    name: 'contacts',
    component: Contacts
  },
  {
    path: '/contacts/add',
    name: 'contacts.add',
    component: AddContact
  }
];

export default routes;
