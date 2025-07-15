<style>
  .calendar {
    background: #fff;
    border-radius: 1rem;
    padding: 1rem;
    max-width: 400px;
    margin: auto;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
  }
  .calendar .month {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
    color: #8e44ad;
    font-size: 1.5rem;
    margin-bottom: 1rem;
  }
  .calendar .weekdays,
  .calendar .days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
  }
  .calendar .weekdays div {
    color: #4cc9f0;
    font-weight: 600;
    padding-bottom: 10px;
  }
  .calendar .days div {
    padding: 10px 0;
    border-radius: 50%;
    transition: all 0.3s ease;
  }
  .calendar .days div:hover {
    background: #eee;
    cursor: pointer;
  }
  .calendar .days .today {
    background: #00cec9;
    color: white;
  }
  .calendar .days .range {
    background: #00cec9;
    color: white;
    border-radius: 10px;
  }
</style>
