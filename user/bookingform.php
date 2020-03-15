<form method="POST" action="user_dashboard.php">
   <h3>Book a Seat</h3>
  <select name="type">
    <option disabled selected hidden>Type</option>
    <option>Leaving Campus</option>
    <option>Returning to Campus</option>
  </select>

  <select name="day">
    <option disabled selected hidden>Select Day</option>
    <option>Friday</option>
    <option>Saturday</option>
    <option>Sunday</option>
  </select>

  <select name="time">
    <option disabled selected hidden>Select Time</option>
    <option>1pm</option>
    <option>2pm</option>
    <option>2pm</option>
  </select>

  <select name="payment_method">
    <option disabled selected hidden>Payment Method</option>
    <option>MoMo</option>
    <option>Cash</option>
  </select>

  <button type="submit" name="book">book</button>
</form>