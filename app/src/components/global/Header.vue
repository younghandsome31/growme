<template>
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="/dashboard" class="logo d-flex align-items-center">
        <img src="/src/assets/growme-logo.png" alt="">
        <span class="d-none d-lg-block">Marketing</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search">
          <i class="bi bi-search"></i>
        </button>
      </form>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">1</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header"> You have 1 new notification <a href="#">
                <span class="badge rounded-pill bg-primary p-2 ms-2">View all</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="/src/assets/logo.svg" alt="Profile" class="rounded-circle" height="36" width="36">
            <span class="d-none d-md-block dropdown-toggle ps-2">My Profile</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ page.name }}</h6>
              <span>GrowME</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;" @click="logOutUser">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
import { defineComponent, reactive, onMounted } from 'vue';
import authRepo from '@/repositories/auth';

export default defineComponent({
    setup() {
        const { errors, status, signOutUser } = authRepo();
        const page = reactive({ 
            authuser: JSON.parse(localStorage.getItem('authuser')),
            name: ''
        });
        
        onMounted(() => {
          page.name = page.authuser.name;
        });

        const logOutUser = () => {
          signOutUser(page.authuser);
        }

        return {
          page,
          errors, 
          status,
          logOutUser
        }
    }
})
</script>

<style scoped>
header#header {
    background: #3b3b3b;
}
.logo span, 
.header-nav .nav-profile, 
.header .toggle-sidebar-btn, 
.header-nav .nav-icon {
    color: #ffffff;
}
.header-nav .nav-profile img {
    background: #fff;
}
.logo img {
    max-height: 40px;
}
</style>