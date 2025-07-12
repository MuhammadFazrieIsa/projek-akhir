<script>
  const toggleBtn = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');
  const content = document.querySelector('.content-with-sidebar');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('sidebar-collapsed');
    content.classList.toggle('content-collapsed');
  });
</script>