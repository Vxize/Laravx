<?php

namespace Vxize\Lavx\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Vxize\Lavx\Http\Controllers\ResourceController;

class LogController extends ResourceController
{
    protected
        $path = 'admin.logs',
        $name = 'lavx::sys.log',
        $model = 'Spatie\\Activitylog\\Models\\Activity'
    ;

    public function columns($type = 'index')
    {
        $full = [
            'log_name' => 'lavx::log.log_name',
            'event' => 'lavx::log.event',
            'description' => 'lavx::sys.description',
            'subject_type' => 'lavx::log.subject_type',
            'subject_id' => 'lavx::log.subject_id',
            'causer_type' => 'lavx::log.causer_type',
            'causer_id' => 'lavx::log.causer_id',
            'properties' => 'lavx::log.properties',
            'created_at' => 'lavx::sys.created_at',
            'updated_at' => 'lavx::sys.updated_at',
        ];
        switch ($type) {
            case 'show':
                return $full;
                break;
            case 'download':
                return $full;
                break;
            case 'index':
                return [
                    'log_name' => 'lavx::log.log_name',
                    'event' => 'lavx::log.event',
                    'description' => 'lavx::sys.description',
                    'created_at' => 'lavx::sys.created_at',
                ];
                break;
            case 'search':
                return [
                    'lavx::log.event',
                    'lavx::sys.description',
                ];
                break;
            default:
                return [];
                break;
        }
    }
    
    public function search(Request $request)
    {
        $search = $request->input('search', null);
        $log_name = $request->input('log_name', null);
        $user_id = $request->input('user_id', null);
        return Activity::latest()
            ->when($log_name, function ($query, $log_name){
                $query->where('log_name', 'LIKE', '%'.$log_name.'%');
            })->when($user_id, function ($query, $user_id) {
                $query->where(function ($query) use ($user_id) {
                    $query->where(function ($query) use ($user_id) {
                        $query->where('causer_type', 'App\Models\User')
                            ->where('causer_id', $user_id);
                    })->orWhere(function ($query) use ($user_id) {
                        $query->where('subject_type', 'App\Models\User')
                            ->where('subject_id', $user_id);
                    });
                });
            })->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('description', 'LIKE', '%'.$search.'%')
                        ->orWhere('event', 'LIKE', '%'.$search.'%');
                });
            });
    }

    public function index(Request $request)
    {
        return $this->indexRecord($request, [
            'delete' => false,
            'edit' => false,
            'add' => false,
            'filter' => 'lavx::filters.log',
        ]);
    }

    public function show(Activity $log)
    {
        return $this->showRecord($log, [
            'delete' => false,
            'edit' => false,
        ]);
    }

}
