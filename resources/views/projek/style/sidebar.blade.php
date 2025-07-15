<style>
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  width: 200px;
  z-index: 1030;
  transition: width 0.3s ease;
  overflow-x: hidden;
}

.sidebar-clock {
  margin-left: 20%;
  display: block;
  width: fit-content; /* or a fixed width */
}


.sidebar-collapsed {
  width: 60px;
}

.sidebar-collapsed .sidebar-text,
.sidebar-collapsed .sidebar-title,
.sidebar-collapsed .sidebar-clock {
  display: none;
}

.sidebar-item {
  cursor: pointer;
  border-left: 4px solid transparent;
  transition: all 0.2s;
  padding: 12px 8px;
}

.sidebar-item:hover {
  background-color: rgba(255, 255, 255, 0.2);
  border-left: 4px solid white;
}

.content-with-sidebar {
  margin-left: 200px;
  transition: margin-left 0.3s ease;
}

.content-collapsed {
  margin-left: 60px;
}
  .card-box {
      color: white;
      border-radius: 0.75rem;
      padding: 1.5rem;
      flex: 1;
      min-width: 200px;
    }

</style>

