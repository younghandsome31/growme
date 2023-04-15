<template>
  <div>
    <div class="pagetitle">
      <h1>Add Contact</h1>
      <Breadcrumb />
    </div>
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header head-text-right"><button class="btn btn-primary btn-md" @click="goTo('/contacts')">Back to List</button></div>
                    <div class="card-body">
                        <div class="pt-4">
                            <h5>Basic Information</h5>
                            <div class="pt-4">
                                <form class="row g-3" @submit="submitContact">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingName" placeholder="First Name" v-model="page.form.firstname">
                                            <label for="floatingName">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatinglName" placeholder="Last Name" v-model="page.form.lastname">
                                            <label for="floatinglName">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="floatingEmail" placeholder="Your Email" v-model="page.form.email">
                                            <label for="floatingEmail">Email Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingPhone" placeholder="Phone" v-model="page.form.phone">
                                            <label for="floatingPhone">Phone</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;" v-model="page.form.address"></textarea>
                                            <label for="floatingTextarea">Address</label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" :disabled="page.isLoading">Submit</button>&nbsp;
                                        <button type="reset" class="btn btn-secondary" :disabled="page.isLoading">Reset</button>
                                    </div>
                                </form>
                            </div>
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
import Breadcrumb from '@/components/global/Breadcrumb.vue';
import contactRepo from '@/repositories/contact';

export default defineComponent({
    setup() {
        const router = useRouter();
        const { status, addContact } = contactRepo();
        const page = reactive({ 
            authuser: JSON.parse(localStorage.getItem('authuser')),
            form: {
                firstname: '',
                lastname: '',
                email: '',
                phone: '',
                address: ''
            },
            isLoading: false
        });

        onMounted(async () => {

        });

        const goTo = (path) => {
            router.push(path);
        }

        const submitContact = async (e) => {
            e.preventDefault();
            page.isLoading = true;
            let formData = new FormData;
            formData.append('firstname', page.form.firstname ?? '');
            formData.append('lastname', page.form.lastname ?? '');
            formData.append('email', page.form.email ?? '');
            formData.append('phone', page.form.phone ?? '');
            formData.append('address', page.form.address ?? '');

            await addContact(formData, page);
            if(status.value == 200) {
                goTo('/contacts');
            }
        }

        return {
          page,
          goTo,
          submitContact
        }
    },
    components: {
        Breadcrumb
    }
})
</script>

<style scoped>
.head-text-right {
    text-align: right;
}
</style>