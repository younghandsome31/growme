<template>
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <!-- <a class="nav-link " href="/dashboard">
          <i class="bi bi-pie-chart-fill"></i>
          <span>Dashboard</span>
        </a> -->
        <router-link class="nav-link" :to="{ name: 'dashboard' }">
          <i class="bi bi-pie-chart-fill"></i>
          <span>Dashboard</span>
        </router-link>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-lines-fill"></i>
          <span>Contacts</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <router-link :to="{ name: 'contacts' }">
              <i class="bi bi-circle"></i>
              <span>Contact List</span>
            </router-link>
          </li>
          <li>
            <a href="#">
              <i class="bi bi-circle"></i>
              <span>Companies</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-graph-up-arrow"></i>
          <span>Marketing</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="#">
              <i class="bi bi-circle"></i>
              <span>Landing Pages</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="bi bi-circle"></i>
              <span>OMS</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-columns-gap"></i>
          <span>CRM</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="#">
              <i class="bi bi-circle"></i>
              <span>Deals</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="bi bi-circle"></i>
              <span>Sales</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </aside>
</template>

<script></script>

<style scoped>
.sidebar {
  background-color: #e5e2e2;
}
.sidebar-nav .nav-content {
    background: #fff6f6;
}
</style>