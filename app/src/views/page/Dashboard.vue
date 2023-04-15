<template>
  <div>
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <Breadcrumb />
    </div>
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row" v-if="!page.isLoading">
            <div class="col-xxl-4 col-md-6">
              <SalesCard />
            </div>
            <div class="col-xxl-4 col-md-6">
              <RevenueCard />
            </div>
            <div class="col-xxl-4 col-xl-12">
              <CustomerCard />
            </div>
            <div class="col-12">
              <Recents />
            </div>
          </div>
          <div class="row" v-else>
            <div class="card">
              <Preloader />
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { defineComponent, reactive, onMounted } from 'vue';
import Preloader from '@/components/global/Preloader.vue';
import Breadcrumb from '@/components/global/Breadcrumb.vue';
import SalesCard from '@/components/dashboard/SalesCard.vue';
import RevenueCard from '@/components/dashboard/RevenueCard.vue';
import CustomerCard from '@/components/dashboard/CustomerCard.vue';
import Recents from '@/components/dashboard/Recents.vue';

export default defineComponent({
    setup() {
        const page = reactive({ 
            authuser: JSON.parse(localStorage.getItem('authuser')),
            isLoading: true
        });

        onMounted(() => {
            setTimeout(()=>{
              page.isLoading = false;
            }, 1000);
        });

        return {
          page
        }
    },
    components: {
        Preloader,
        Breadcrumb,
        SalesCard,
        RevenueCard,
        CustomerCard,
        Recents
    }
})
</script>