// Sample data for appointment schedule
var scheduleData = {
    "mon-9am": "John Doe",
    "tue-10am": "Jane Smith",
    // Add more data for other time slots and days
  };
  
  // Function to populate the schedule with data
  function populateSchedule() {
    for (var slot in scheduleData) {
      var cell = document.getElementById(slot);
      cell.innerText = scheduleData[slot];
    }
  }
  
  // Call the populateSchedule function when the page loads
  window.onload = populateSchedule;






  async function deleteTableOnCancel() {
    try {
      // Get reference to database
      const db = await openDatabase();  
  
      // Click handler for cancel button
      cancelButton.addEventListener('click', async () => {
  
        // Delete all records from table  
        await db.transaction(tx => {
          tx.executeSql(
            `DELETE FROM  appointment`, 
            [],
            () => {
              console.log('Table cleared');
            },
            err => {
              console.log(err);
            }
          );
        });
  
      });
  
    } catch (err) {
      console.log(err);
    }
  }