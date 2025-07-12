<script>
// Update and format the clock
function updateClock() {
  const now = new Date();
  const hours = now.getHours().toString().padStart(2, '0');
  const minutes = now.getMinutes().toString().padStart(2, '0');
  const seconds = now.getSeconds().toString().padStart(2, '0');
  const clock = document.getElementById("clock");
  clock.textContent = `${hours}:${minutes}:${seconds}`;
}

// Start clock updates
setInterval(updateClock, 1000);
updateClock();

// Toggle calendar on clock click
const clockElement = document.getElementById("clock");
clockElement.style.cursor = "pointer";
clockElement.addEventListener("click", () => {
  const isHidden = calendarInput.style.display === "none";
  calendarInput.style.display = isHidden ? "inline-block" : "none";
  if (isHidden) calendarInput.valueAsDate = new Date();
});

</script>