<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RoomRepository;
use App\Entities\Room;
use Illuminate\Http\Request;

/**
 * Class RoomRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoomRepositoryEloquent extends BaseRepository implements RoomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Room::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /*
    * Filter room by date and a number person/room
    */
    public function filterRoom(Request $request)
    {
        $person_room_id = $request->input('person_room');

        $date_start = $request->input('date_start');
        $date_start = strtotime($date_start);
        $date_start = date('Y-m-d', $date_start);

        $date_end = $request->input('date_end');
        $date_end = strtotime($date_end);
        $date_end = date('Y-m-d', $date_end);

        // \DB::enableQueryLog();
        $rooms = $this->model->with([
            'type',
            'bed',
            'bookingDetails' => function ($query) use ($date_start, $date_end) {
                return $query->where('date_start', '<', $date_start)
                    ->Where('date_end', '>', $date_end);
            }
        ])->where('person_room_id', '=', $person_room_id)->get();

        return $rooms;

        // dd(\DB::getQueryLog());
    }
}
