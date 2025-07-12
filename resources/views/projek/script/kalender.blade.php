
<script>
  const calendarDisplay = document.getElementById('calendarDisplay');
  const calendarPopup = document.getElementById('calendarPopup');
  const nativeCalendar = document.getElementById('nativeCalendar');

  // Set today's date
  const today = new Date().toISOString().split('T')[0];
  nativeCalendar.value = today;
  calendarDisplay.textContent = today;

  // Toggle popup visibility
  calendarDisplay.addEventListener('click', function (e) {
    const rect = calendarDisplay.getBoundingClientRect();
    calendarPopup.style.top = `${rect.bottom + window.scrollY}px`;
    calendarPopup.style.left = `${rect.left + window.scrollX}px`;
    calendarPopup.style.display = 'block';
    e.stopPropagation();
  });

  // Update display on date select
  nativeCalendar.addEventListener('change', function () {
    calendarDisplay.textContent = this.value;
    calendarPopup.style.display = 'none';
  });

  // Close popup on outside click
  document.addEventListener('click', function (e) {
    if (!calendarPopup.contains(e.target) && e.target !== calendarDisplay) {
      calendarPopup.style.display = 'none';
    }
  });
</script>
