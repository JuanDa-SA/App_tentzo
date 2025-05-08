const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  todayBtn = document.querySelector(".today-btn"),
  gotoBtn = document.querySelector(".goto-btn"),
  dateInput = document.querySelector(".date-input"),
  eventDay = document.querySelector(".event-day"),
  eventDate = document.querySelector(".event-date"),
  eventsContainer = document.querySelector(".events"),
  addEventBtn = document.querySelector(".add-event"),
  addEventWrapper = document.querySelector(".add-event-wrapper "),
  addEventCloseBtn = document.querySelector(".close "),
  addEventTitle = document.querySelector(".event-name "),
  addEventMotivo = document.querySelector(".event-motivo"),
  addEventNombre = document.querySelector(".event-dueno"),
  addEventMail = document.querySelector(".event-mail"),
  addEventTelefono = document.querySelector(".event-telefono"),
  addEventFrom = document.querySelector(".event-time-from"),
  addEventTo = document.querySelector(".event-time-to"),
  addEventSubmit = document.querySelector(".add-event-btn");
console.log(addEventFrom);
console.log(addEventTo);
console.log(document.querySelector(".event-time-from"));
console.log(document.querySelector(".event-time-to"));
let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();

const months = [
  "Enero",
  "Febrero",
  "Marzo",
  "Abril",
  "Mayo",
  "Junio",
  "Julio",
  "Agosto",
  "Septiembre",
  "Octubre",
  "Noviembre",
  "Diciembre",
];



const eventsArr = [];
document.addEventListener("DOMContentLoaded", () => {
  const timeFromInput = document.querySelector(".event-time-from");
    const timeToInput = document.querySelector(".event-time-to");

    timeFromInput.addEventListener("change", function() {
      timeToInput.min = timeFromInput.value;
    });

    timeToInput.addEventListener("change", function() {
      timeFromInput.max = timeToInput.value;
    });
    getEvents(); // Cargar eventos desde la base de datos
  });
  
console.log(eventsArr);

//function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
function getEvents() {
    fetch('includes/get_events.php')
      .then(response => response.json())
      .then(data => {
        if (data.length > 0) {
          data.forEach(event => {
            eventsArr.push(event);
          });
        }
        initCalendar(); // Inicializa el calendario después de cargar los eventos
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  }
  
  // Asegúrate de que initCalendar y updateEvents manejan correctamente los datos
  function initCalendar() {
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const prevLastDay = new Date(year, month, 0);
    const prevDays = prevLastDay.getDate();
    const lastDate = lastDay.getDate();
    const day = firstDay.getDay();
    const nextDays = 7 - lastDay.getDay() - 1;
  
    date.innerHTML = months[month] + " " + year;
  
    let days = "";
  
    for (let x = day; x > 0; x--) {
      days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
    }
  
    for (let i = 1; i <= lastDate; i++) {
      //check if event is present on that day
      let event = false;
      eventsArr.forEach((eventObj) => {
        if (
          eventObj.day == i &&  // Usa "==" para comparación con strings y números
          eventObj.month == month + 1 &&
          eventObj.year == year
        ) {
          event = true;
        }
      });
      if (
        i === new Date().getDate() &&
        year === new Date().getFullYear() &&
        month === new Date().getMonth()
      ) {
        activeDay = i;
        getActiveDay(i);
        updateEvents(i);
        if (event) {
          days += `<div class="day today active event">${i}</div>`;
        } else {
          days += `<div class="day today active">${i}</div>`;
        }
      } else {
        if (event) {
          days += `<div class="day event">${i}</div>`;
        } else {
          days += `<div class="day ">${i}</div>`;
        }
      }
    }
  
    for (let j = 1; j <= nextDays; j++) {
      days += `<div class="day next-date">${j}</div>`;
    }
    daysContainer.innerHTML = days;
    addListner();
  }
  
  function updateEvents(date) {
    let events = "";
    eventsArr.forEach((event) => {
      if (
        date == event.day &&  // Usa "==" para comparación con strings y números
        month + 1 == event.month &&
        year == event.year
      ) {
        event.events.forEach((event) => {
          events += `<div class="event">
              <div class="title">
                <i class="fas fa-circle"></i>
                <h3 class="event-title">${event.title}</h3>
              </div>
              <div class="event-time">
                <span class="event-time">${convertTime(event.time_i)} a ${convertTime(event.time_f)}</span>
              </div>
          </div>`;
        });
      }
    });
    if (events === "") {
      events = `<div class="no-event">
              <h3>No Events</h3>
          </div>`;
    }
    eventsContainer.innerHTML = events;
  }
  

  

//function to add month and year on prev and next button
function prevMonth() {
  month--;
  if (month < 0) {
    month = 11;
    year--;
  }
  initCalendar();
}

function nextMonth() {
  month++;
  if (month > 11) {
    month = 0;
    year++;
  }
  initCalendar();
}

prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

initCalendar();

//function to add active on day
function addListner() {
  const days = document.querySelectorAll(".day");
  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      getActiveDay(e.target.innerHTML);
      updateEvents(Number(e.target.innerHTML));
      activeDay = Number(e.target.innerHTML);
      //remove active
      days.forEach((day) => {
        day.classList.remove("active");
      });
      //if clicked prev-date or next-date switch to that month
      if (e.target.classList.contains("prev-date")) {
        prevMonth();
        //add active to clicked day afte month is change
        setTimeout(() => {
          //add active where no prev-date or next-date
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("prev-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else if (e.target.classList.contains("next-date")) {
        nextMonth();
        //add active to clicked day afte month is changed
        setTimeout(() => {
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("next-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else {
        e.target.classList.add("active");
      }
    });
  });
}

todayBtn.addEventListener("click", () => {
  today = new Date();
  month = today.getMonth();
  year = today.getFullYear();
  initCalendar();
});

dateInput.addEventListener("input", (e) => {
  dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
  if (dateInput.value.length === 2) {
    dateInput.value += "/";
  }
  if (dateInput.value.length > 7) {
    dateInput.value = dateInput.value.slice(0, 7);
  }
  if (e.inputType === "deleteContentBackward") {
    if (dateInput.value.length === 3) {
      dateInput.value = dateInput.value.slice(0, 2);
    }
  }
});

gotoBtn.addEventListener("click", gotoDate);

function gotoDate() {
  console.log("here");
  const dateArr = dateInput.value.split("/");
  if (dateArr.length === 2) {
    if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
      month = dateArr[0] - 1;
      year = dateArr[1];
      initCalendar();
      return;
    }
  }
  alert("Invalid Date");
}

//function get active day day name and date and update eventday eventdate
function getActiveDay(date) {
  const day = new Date(year, month, date);
  const dayName = day.toString().split(" ")[0];
  eventDay.innerHTML = dayName;
  eventDate.innerHTML = date + " " + months[month] + " " + year;
}


//function to add event
addEventBtn.addEventListener("click", () => {
  addEventWrapper.classList.toggle("active");
});

addEventCloseBtn.addEventListener("click", () => {
  addEventWrapper.classList.remove("active");
});

document.addEventListener("click", (e) => {
  if (e.target !== addEventBtn && !addEventWrapper.contains(e.target)) {
    addEventWrapper.classList.remove("active");
  }
});

//allow 50 chars in eventtitle
addEventTitle.addEventListener("input", (e) => {
  addEventTitle.value = addEventTitle.value.slice(0, 60);
});


//function to add event to eventsArr
addEventSubmit.addEventListener("click", () => {
    const eventTitle = addEventTitle.value;
    const eventTimeFrom = addEventFrom.value;
    const eventTimeTo = addEventTo.value;
    const eventMotivo = addEventMotivo.value;
    const eventNombre = addEventNombre.value;
    const eventMail = addEventMail.value;
    const eventTelefono = addEventTelefono.value;
    if (eventTitle === "") {
      alert("Por favor ingresa un título para el evento");
      return;
    } else if (eventTimeFrom === "") {
      alert("Por favor ingresa la hora de inicio del evento");
      return;
    } else if (eventTimeTo === "") {
      alert("Por favor ingresa la hora de fin del evento");
      return;
    } else if (eventMotivo === "") {
      alert("Por favor ingresa el motivo del evento");
      return;
    } else if (eventNombre === "") {
      alert("Por favor ingresa tu nombre");
      return;
    } else if (eventMail === "") {
      alert("Por favor ingresa tu correo electrónico");
      return;
    } else if (eventTelefono === "") {
      alert("Por favor ingresa tu número de teléfono");
      return;
    }
    
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(eventMail)) {
        alert("Por favor ingresa un correo electrónico válido");
        return;
    }

    // Validate phone number (example: only digits and 10 digits long)
    const phonePattern = /^\d{10}$/;
    if (!phonePattern.test(eventTelefono)) {
        alert("Por favor ingresa un número de teléfono válido (10 dígitos)");
        return;
    }
  
    //check correct time format 24 hour
    const timeFromArr = eventTimeFrom.split(":");
    const timeToArr = eventTimeTo.split(":");
    const t1 = timeFromArr[0];
    const t2= timeToArr[0];
   if (
    // Verifica si la hora de inicio es antes de las 8:00 am
    timeFromArr[0] < 8 || 
    (timeFromArr[0] === 8 && timeFromArr[1] < 0) || 
    
    // Verifica si la hora de inicio es después de las 8:00 pm
    timeFromArr[0] > 20 || 
    (timeFromArr[0] === 20 && timeFromArr[1] > 0) || 
        
    // Verifica si la hora de finalización es después de las 8:00 pm
    timeToArr[0] > 20 || 
    (timeToArr[0] === 20 && timeToArr[1] > 0) 
   
) {
    alert("Horas fuera del rango permitido. Recuerde que el horario permido es de 8:00 am a 8:00 pm");
    return;
}
if( t1  > t2){
    alert("Seleccione una hora de incio que sea antes que la hora final");
    return;
}
if(timeFromArr[1] > 0 || timeToArr[1]> 0 ){
  alert("Seleccione horas que terminen en :00");
  return;
}
  
    






    let eventExist = false;




  if (eventExist) {
    alert("Usted ya ha agregado un evento que se solapa en este intervalo de tiempo");
    return;
  }
    
    const newEvent = {
      day: activeDay,
      month: month + 1,
      year: year,
      events: [
        {
          title: eventTitle,
          motive: eventMotivo,
          nombre: eventNombre,
          mail: eventMail,
          telefono: eventTelefono,
          time_i: eventTimeFrom,
          time_f: eventTimeTo
        }
      ]
    };
  
    console.log(newEvent);
    console.log(activeDay);
  
    let eventAdded = false;
    if (eventsArr.length > 0) {
      eventsArr.forEach((item) => {
        if (
          item.day === activeDay &&
          item.month === month + 1 &&
          item.year === year
        ) {
          item.events.push(newEvent.events[0]);
          eventAdded = true;
        }
      });
    }
  
    if (!eventAdded) {
      eventsArr.push(newEvent);
    }
  
    saveEvent(newEvent); // Llama a la función para guardar el nuevo evento en el backend
  
    console.log(eventsArr);
    addEventWrapper.classList.remove("active");
    addEventTitle.value = "";
    addEventFrom.value = "";
    addEventTo.value = "";
    addEventMotivo.value = "";
    addEventNombre.value = "";
    addEventMail.value = "";
    addEventTelefono.value = "";
    updateEvents(activeDay);
    //select active day and add event class if not added
    const activeDayEl = document.querySelector(".day.active");
    if (!activeDayEl.classList.contains("event")) {
      activeDayEl.classList.add("event");
    }
  });



// Function to save events in local storage
function saveEvent(newEvent) {
  fetch('includes/save_event.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(newEvent)
  })
  .then(response => response.json()) // Parse response as JSON
  .then(data => {
      if (data.status === 'error') {
          if (confirm(data.message)) {
              location.reload();
          }
      } else if (data.status === 'success') {
         
          sendEmail(newEvent);
          alert(data.message); // Show alert with success message
          location.reload(); // Reload the page after success message
      }
  })
  .catch((error) => {
      console.error('Error:', error);
      alert('Hubo un error al procesar la solicitud.');
  });
}


function sendEmail(newEvent) {
  fetch('envar_correo.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(newEvent)
  })
  .then(response => response.text())
  .then(data => {
      console.log(data);
  })
  .catch((error) => {
      console.error('Error sending email:', error);
  });
}

//function to get events from local storage
  
function convertTime(time) {
  //convert time to 24 hour format
  let timeArr = time.split(":");
  let timeHour = timeArr[0];
  let timeMin = timeArr[1];
  let timeFormat = timeHour >= 12 ? "PM" : "AM";
  timeHour = timeHour % 12 || 12;
  time = timeHour + ":" + timeMin + " " + timeFormat;
  return time;
}