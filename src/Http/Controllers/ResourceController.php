<?php

namespace Vxize\Lavx\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    protected 
        $rules = [],  //rules to valid form input
        $path = '',  // route name for resource
        $name = '',  // name for view, usually the model name
        $titles = [  // title to override default 
            'index' => null,
            'create' => null,
            'show' => null,
            'edit' => null,
        ],
        $model = '',  // model name for controller, App\Models\Name
        $views = [  // views for resources
            'index' => 'lavx::crud.index',
            'create' => 'lavx::crud.create',
            'show' => 'lavx::crud.show',
            'edit' => 'lavx::crud.edit',
        ],
        $redirects = [  // redirect route after save/delete
            'store' => null,
            'update' => null,
            'destroy' => null,
        ],
        $route_key_name = 'id',  // can be changed by Model->getRouteKeyName()
        $paginate = 7  // number per page
    ;

    public function search(Request $request)
    {
        $search = $request->input('search', null);
        if ($search) { // search data for model
            return [];
        }
        // show all data for model
        return [];
    }
    
    public function columns($type = 'index')
    {
        $common = [
            'name' => 'lavx::name',
        ];
        switch ($type) {
            case 'show':
                return $common;
                break;
            case 'download':
                return $common;
                break;
            case 'index':
                return $common;
                break;
            case 'extra':
                return [];
                break;               
            default:
                return [];
                break;
        }
    }

    public function extraTable($data)
    {
        return [];
    }

    public function indexRecord(Request $request, $parm = [])
    {        
        $table_data = $parm['table_data'] ?? $this->search($request);
        $download = $request->input('_dl', null);
        if ($download) {            
            return DownloadDataController::toCSV(
                $parm['download_columns'] ?? $this->columns('download'),
                $table_data->get(),
                date('Y-m-d_H-i-s')
            );
        }
        $table = $table_data->paginate($parm['paginate'] ?? $this->paginate);
        return view($parm['template'] ?? $this->views['index'], array_merge([
            'title' => __($this->titles['index']) ?? __($this->name),
            'table' => $table,
            'path' => $parm['path'] ?? $this->path,
            'columns' => $parm['table_columns'] ?? $this->columns('index'),
            'extra_columns' => $parm['extra_columns'] ?? $this->columns('extra') ?? [],
            'extra_table' => $parm['extra_table'] ?? $this->extraTable($table),
        ], $parm));
    }

    public function createRecord($parm = [])
    {
        return view($parm['template'] ?? $this->views['create'], array_merge([
            'title' => __($this->titles['create']) ?? __('lavx::form.add_new').__($this->name),
            'path' => $this->path,
        ], $parm));
    }

    // process data before store/update record
    public function beforeSave($data)
    {
        return $data;
    }

    // validate and insert new record to DB, return id of new inserted record
    public function insertOneRecord($data = [])
    {
        $validator = validator($data, $this->rules);        
        if ($validator->fails()) {
            $validator->validated();
            session([
                'validator_errors' => $validator->errors()->all()
            ]);
            return 0;
        }        
        return $this->model::create($this->beforeSave($data))->id ?? 0;
    }

    public function storeRecord(Request $request, $data = [])
    {
        $id = $this->insertOneRecord(array_merge($request->all(), $data));
        $result = $id ? 'success' : 'error';
        $message = $id ? 'lavx::form.save_success' : 'lavx::form.submit_error';
        return redirect()->route(
            $this->redirects['store'] ?? $this->path.'.index',
            $id ?? null
        )->with($result, __($message));
    }
 
    public function showRecord($record, $parm = [])
    {
        return view($parm['template'] ?? $this->views['show'], array_merge([
            'title' => __($this->titles['show']) ?? __($this->name),
            'record' => $record,
            'path' => $this->path,
            'columns' => $this->columns('show'),
            'route_key_name' => $this->route_key_name,
        ], $parm));
    }
 
    public function editRecord($record, $parm = [])
    {
        return view($parm['template'] ?? $this->views['edit'], array_merge([
            'title' => __($this->titles['edit']) ?? __('lavx::sys.edit').__($this->name),
            'path' => $this->path,
            'route_key_name' => $this->route_key_name,
            'record' => $record
        ], $parm));
    }

    // validate and update an old record, return number of affected rows
    public function updateOneRecord($record, $data = [])
    {
        $validator = validator($data, $this->rules);
        if ($validator->fails()) {            
            $validator->validated();
            session([
                'validator_errors' => $validator->errors()->all()
            ]);
            return 0;
        }
        return $record->update($this->beforeSave($data));
    }
 
    public function updateRecord(Request $request, $record, $data = [])
    {
        $rows = $this->updateOneRecord($record, array_merge($request->all(), $data));
        $result = $rows ? 'success' : 'error';
        $message = $rows ? 'lavx::form.save_success' : 'lavx::form.update_error';
        return redirect()->route(
            $this->redirects['update'] ?? $this->path.'.index',
            $record->id ?? null
        )->with($result, __($message));
    }
 
    public function destroyRecord($record)
    {
        $record->delete();
        return redirect()->route(
            $this->redirects['destroy'] ?? $this->path.'.index'
        )->with('success', __('lavx::form.delete_success'));
    }
}
