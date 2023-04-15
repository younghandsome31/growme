<template>
  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item" v-for="bc in page.route_arr" :key="bc">{{ capitalizeFirstLetter(bc) }}</li>
    </ol>
    </nav>
</template>
<script>
import { defineComponent, onMounted, reactive } from 'vue';
import { useRouter } from 'vue-router'

export default defineComponent({
    setup() {
        const router = useRouter();
        const page = reactive({
            route_arr: []
        });

        onMounted(()=>{
            page.route_arr = router.currentRoute.value.fullPath.split('/').filter(n => n);
        });

        return {
            page
        }
    },
    methods: {
        capitalizeFirstLetter: (string) => {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    }
})
</script>

<style scoped>

</style>