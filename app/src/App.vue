<template>
  <div v-if="token">
    <TopHeader />
    <Sidebar />
    <main id="main" class="main">
      <router-view />
    </main>
    <BotFooter />
  </div>
  <div v-else>
    <main>
      <router-view />
    </main>
  </div>
</template>

<script>
import store from "@/store";
import TopHeader from "@/components/global/Header.vue";
import Sidebar from "@/components/global/Sidebar.vue";
import BotFooter from "@/components/global/Footer.vue";

export default {
    setup() {
        const token = store.getters["auth/authenticated"];

        return {
            token
        }
    },
    components: {
      TopHeader,
      Sidebar,
      BotFooter
    }
}
</script>
