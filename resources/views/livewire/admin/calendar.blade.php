{{-- <div>
    <div>
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>
    @push('js')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

        <script>
            document.addEventListener('livewire:load', function() {
                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendar.Draggable;
                var calendarEl = document.getElementById('calendar');
                var checkbox = document.getElementById('drop-remove');
                var data = @this.events;
                var lastClickedEvent = null; // Keep track of the last clicked event
                var calendar = new Calendar(calendarEl, {
                    events: JSON.parse(data),
                    dateClick(info) {
                        var title = prompt('ادخل الحدث');
                        var date = new Date(info.date); // Convert date string to Date object
                        var formattedDate = date.toLocaleDateString('en-GB', { // Modify date format
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }).split('/').reverse().join('-'); // Reformat date to 'Y-m-d' format
                        if (title != null && title != '') {
                            calendar.addEvent({
                                title: title,
                                start: formattedDate,
                                allDay: true
                            });
                            var eventAdd = {title: title, start: formattedDate};
                            @this.addevent(eventAdd);
                            alert('تم اضافه الحدث بنجاح');
                            // Trigger Livewire event to refresh calendar
                            Livewire.emit('refreshCalendar');
                        } else {
                            alert('الرجاء ادخال عنوان الحدث');
                         }
                    },
                    editable: true,
                    selectable: true,
                    displayEventTime: false,
                    droppable: true,
                    eventDrop: function(info) {
                        var eventData = {
                            id: info.event.id,
                            title: info.event.title,
                            start: info.event.startStr,
                            end: info.event.endStr,
                            allDay: info.event.allDay
                        };
                        // Update the event via Livewire
                        @this.updateEvent(eventData);
                        alert('تم تحديث الحدث');
                    },
                    eventClick: function(info) {
                        var clicks = info.jsEvent.detail;
                        if (clicks === 2) { // Handle double click event
                            var newTitle = prompt('ادخال عنوان الحدث الجديد', info.event.title);
                            if (newTitle !== null) {
                                var eventData = {
                                    id: info.event.id,
                                    title: newTitle,
                                    start: info.event.start,
                                    end: info.event.end,
                                    allDay: info.event.allDay
                                };
                                // Update the event via Livewire
                                @this.updateEvent(eventData);
                                alert('تم تحديث عنوان الحدث');
                            }
                        } else { // Handle single click event
                            lastClickedEvent = info.event; // Store the last clicked event
                            if (confirm('هل متاكد من اضافه الحدث؟')) {
                                lastClickedEvent.remove(); // Remove the event from the calendar
                                // Call Livewire method to delete the event
                                @this.deleteEvent(lastClickedEvent.id);
                                lastClickedEvent = null; // Reset the last clicked event
                            }
                        }
                    },
                    loading: function(isLoading) {
                        if (!isLoading) {
                            this.getEvents().forEach(function(e){
                                if (e.source === null) {
                                    e.remove();
                                }
                            });
                        }
                    }
                });
                calendar.render();
                // Livewire event listener to refresh the calendar
                Livewire.on('refreshCalendar', () => {
                    calendar.refetchEvents();
                });
            });
        </script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
    @endpush
</div> --}}


<div>
    <div>
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>
    @push('js')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

        <script>
          document.addEventListener('livewire:load', function() {
    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;
    var calendarEl = document.getElementById('calendar');
    var checkbox = document.getElementById('drop-remove');
    var data = @this.events;
    var calendar = new Calendar(calendarEl, {
        events: JSON.parse(data),
        dateClick(info) {
            var title = prompt('ادخل عنوان الحدث ');
            var date = new Date(info.date);
            var timezoneOffset = date.getTimezoneOffset() * 60000; // Timezone offset in milliseconds
            var formattedDate = new Date(date - timezoneOffset).toISOString().slice(0, 10); // Convert to UTC and then to YYYY-MM-DD format
            if (title != null && title != '') {
                calendar.addEvent({
                    title: title,
                    start: formattedDate, // Use formatted date
                    allDay: true
                });
                var eventAdd = { title: title, start: formattedDate };
                @this.addevent(eventAdd);
                alert('تم اضافة الحدث بنجاح');
            } else {
                alert('من فضلك ادخل عنوان الحدث');
            }
        },
        editable: true,
        selectable: true,
        displayEventTime: false,
        droppable: true,
        drop: function(info) {
            if (checkbox.checked) {
                info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        },
        eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
        loading: function(isLoading) {
            if (!isLoading) {
                this.getEvents().forEach(function(e) {
                    if (e.source === null) {
                        e.remove();
                    }
                });
            }
        }
    });
    calendar.render();
    @this.on(`refreshCalendar`, () => {
        calendar.refetchEvents()
    });
});

        </script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
    @endpush
</div>
