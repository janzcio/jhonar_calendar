<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    public function load(){

        $calendar =  Event::all();
        $data = array();

        foreach($calendar as $row)
        {
         $data[] = array(
          'id'   => $row["id"],
          'title'   => $row["title"],
          'start'   => $row["start_event"],
          'end'   => $row["end_event"]
         );
        }
        echo json_encode($data);
        // return compact('data');
        
    }

    public function insert(){
        $success = false;
        $save = Event::create([
            'title' => $_POST['title'],
            'start_event' => $_POST['start'],
            'end_event' => $_POST['end']
        ]);

        if ($save) {
            $success = true;
        }

        return compact('success');
    }

    public function update(){
        $success = false;
        $update = Event::findOrFail($_POST['id']);
        $update->update([
            'title' => $_POST['title'],
            'start_event' => $_POST['start'],
            'end_event' => $_POST['end']
        ]);

        if ($update) {
            $success = true;
        }

        return compact('success');
    }

    public function delete(){
        $success = false;
        $delete = Event::find($_POST['id']);
        $delete->delete();

        if ($delete) {
            $success = true;
        }
        return compact('success');
    }
}
