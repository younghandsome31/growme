<template>
  <div>
    <div class="pagetitle">
      <h1>Contacts</h1>
      <Breadcrumb />
    </div>
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div v-if="page.isLoading">
                            <Preloader />
                        </div>
                        <div v-else>
                            <div class="flex-justify table-heading">
                                <div><button class="btn btn-primary btn-md" @click="goTo('/contacts/add')">Add Contact</button></div>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-search"></i></div>
                                        <input type="text" class="form-control" placeholder="Search Contacts" aria-label="Input group example" aria-describedby="btnGroupAddon">
                                    </div>
                                </div>
                            </div>
                            <Datatable
                                :data="contacts"
                                :options="contact_headers"
                                :id="''"
                            >
                                <template v-slot:name="{ row }">
                                    {{ row.first_name + ' ' + row.last_name }}
                                </template>
                                <template v-slot:action="{ row }">
                                    <div :class="`button-actions-${row.id}`">
                                        <button class="btn btn-primary btn-sm">View</button>&nbsp;
                                        <button class="btn btn-success btn-sm">Edit</button>&nbsp;
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </template>
                            </Datatable>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { defineComponent, reactive, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import contactRepo from '@/repositories/contact';
import Datatable from '@/components/tables/Datatable.vue';
import Preloader from '@/components/global/Preloader.vue';
import Breadcrumb from '@/components/global/Breadcrumb.vue';

export default defineComponent({
    setup() {
        const router = useRouter();
        const { contacts, getContacts } = contactRepo();
        const page = reactive({ 
            authuser: JSON.parse(localStorage.getItem('authuser')),
            isLoading: true
        });
        const contact_headers = [
            { key: 'id', label: '#' },
            { key: 'name', label: 'Name' },
            { key: 'email', label: 'Email' },
            { key: 'phone', label: 'Phone' },
            { key: 'address', label: 'Address' },
            { key: 'action', label: 'Action' }
        ]

        onMounted(async () => {
            await getContacts(page);
        });

        const goTo = (path) => {
            router.push(path);
        }

        return {
          page,
          contacts,
          contact_headers,
          goTo
        }
    },
    components: {
        Preloader,
        Breadcrumb,
        Datatable
    }
})
</script>

<style scoped>
.flex-justify {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.table-heading {
    min-height: 55px;
    margin-top: 15px;
}

.table.table-striped tr td > div {
    width: 170px;
    text-align: right;
    display:inline-block;
}
.table.table-striped tr th:nth-last-child(1), 
.table.table-striped tr td:nth-last-child(1) {
    text-align:right;
}
</style>

<style>
.btn-md {
    font-size: 14px;
}
</style>