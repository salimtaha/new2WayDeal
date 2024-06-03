<?php

namespace App\Http\Livewire\Admin;

use App\Models\Event;
use Livewire\Component;

class Calendar extends Component
{
    public $events = '';

    public function getevent()
    {
        $events = Event::select('id','title','start')->get();

        return  json_encode($events);
    }


    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['start'] = $event['start'];
        Event::create($input);

        return $this->redirect('/admin/welcome');
    }

    public function eventDrop($event, $oldEvent)
    {
        $eventdata = Event::find($event['id']);
        $eventdata->start = $event['start'];
        $eventdata->save();
    }

    public function deleteEvent($eventId)
    {
        // dd($eventId);
        return $this->redirect('/admin/welcome');
    }


    public function updateEvent($eventData)
    {
    //    dd($eventData);
    return $this->redirect('/admin/welcome');
    }


    public function render()
    {
        $events = Event::select('id','title','start')->get();

        $this->events = json_encode($events);
        return view('livewire.admin.calendar');
    }

}
