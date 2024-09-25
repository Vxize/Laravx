<?php

namespace Vxize\Lavx\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    protected
        $rules = [],  //common rules to valid form input
        $insert_rules = [],  //rules to valid form input when insert record
        $update_rules = [],  //rules to valid form input when update record
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
        $messages = [  // message to show for store/update result
            'store' => [
                'success' => 'lavx::form.save_success',
                'error' => 'lavx::form.submit_error'
            ],
            'update' => [
                'success' => 'lavx::form.save_success',
                'error' => 'lavx::form.submit_error'
            ],
            'destroy' => [
                'success' => 'lavx::form.delete_success',
                'error' => 'lavx::form.delete_error'
            ]
        ],
        $route_key_name = 'id',  // can be changed by Model->getRouteKeyName()
        $paginate = null  // number per page
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
            case 'search':
                return $common;
                break;
            case 'store':  // columns for store
                return array_keys($common);
                break;
            case 'update':  // columns for update
                return array_keys($common);
                break;
            case 'action':  // buttons in action column
                return [];
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
        $default_paginate = intval(config('lavx.paginate'));
        $paginate = $request->input('paginate')
            ?? $parm['paginate']
            ?? $this->paginate
            ?? $default_paginate;
        $table = $table_data->paginate($paginate);
        return view($parm['template'] ?? $this->views['index'], array_merge([
            'title' => __($this->titles['index'] ?? $this->name),
            'table' => $table,
            'path' => $parm['path'] ?? $this->path,
            'route_key_name' => $this->route_key_name,
            'searchable' => implode(', ', array_map(fn($value) => __($value), $this->columns('search'))),
            'columns' => $parm['table_columns'] ?? $this->columns('index'),
            'action_columns' => $parm['action_columns'] ?? $this->columns('action') ?? [],
            'extra_columns' => $parm['extra_columns'] ?? $this->columns('extra') ?? [],
            'extra_table' => $parm['extra_table'] ?? $this->extraTable($table),
            'paginate' => $paginate,
        ], $parm));
    }

    public function createRecord($parm = [])
    {
        return view($parm['template'] ?? $this->views['create'], array_merge([
            'title' => isset($this->titles['create'])
                ? __($this->titles['create'])
                : __('lavx::form.add_new').__($this->name),
            'path' => $this->path,
        ], $parm));
    }

    // process data before store record, might use model event instead
    public function prepareDataBeforeStore($data, Request $request)
    {
        return $data;
    }

    // things to do on success store
    public function onStoreSuccess(Request $request, $record)
    {

    }

    // things to do on failed store
    public function onStoreFail(Request $request)
    {

    }

    // validate and insert new record to DB, return id of new inserted record
    public function insertOneRecord($data = [])
    {
        $validator = validator(
            $data,
            array_merge($this->rules, $this->insert_rules)
        );
        if ($validator->fails()) {
            $validator->validated();
            session([
                'validator_errors' => $validator->errors()->all()
            ]);
            return 0;
        }
        return $this->model::create($data) ?? null;
    }

    public function storeRecord(Request $request, $data = [])
    {
        $data = array_merge($request->only($this->columns('store')), $data);
        $record = $this->insertOneRecord(
            $this->prepareDataBeforeStore($data, $request)
        );
        if ($record) {
            $result = 'success';
            $message = $request->success_message ?? $this->messages['store']['success'];
            $this->onStoreSuccess($request, $record);
        } else {
            $result = 'error';
            $message = $request->error_message ?? $this->messages['store']['error'];
            $this->onStoreFail($request);
        }
        return to_route(
            $request->_redirect ?? $this->redirects['store'] ?? $this->path.'.index',
            $request->_redirect_data ?? $record ?? null
        )->with($result, __($message));
    }
 
    public function showRecord($record, $parm = [])
    {
        return view($parm['template'] ?? $this->views['show'], array_merge([
            'title' => __($this->titles['show'] ?? $this->name),
            'record' => $record,
            'path' => $this->path,
            'columns' => $this->columns('show'),
            'route_key_name' => $this->route_key_name,
        ], $parm));
    }
 
    public function editRecord($record, $parm = [])
    {
        return view($parm['template'] ?? $this->views['edit'], array_merge([
            'title' => isset($this->titles['edit'])
                ? __($this->titles['edit'])
                : __('lavx::sys.edit').__($this->name),
            'path' => $this->path,
            'route_key_name' => $this->route_key_name,
            'record' => $record
        ], $parm));
    }

    // validate and update an old record, return number of affected rows
    public function updateOneRecord($record, $data = [])
    {
        $validator = validator(
            $data,
            array_merge($this->rules, $this->update_rules)
        );
        if ($validator->fails()) {
            $validator->validated();
            session([
                'validator_errors' => $validator->errors()->all()
            ]);
            return 0;
        }
        return $record->update($data);
    }

    // process data before update record, might use model event instead
    public function prepareDataBeforeUpdate($data, Request $request)
    {
        return $data;
    }

    // things to do on success update
    public function onUpdateSuccess(Request $request, $record, $old_record)
    {

    }

    // things to do on failed update
    public function onUpdateFail(Request $request, $record)
    {

    }

    public function columnsUpdated($new_record, $old_record, $columns = [])
    {
        $check_columns = $columns ?: $this->columns('update');
        if (empty($check_columns)) {
            return [];
        }
        $old_columns = $old_record->only($check_columns);
        $new_columns = $new_record->only($check_columns);
        if ($old_columns == $new_columns) {
            return [];
        }
        $unchanged_columns = array_intersect_assoc($old_columns, $new_columns);
        return [
            'old' => array_diff_assoc($old_columns, $unchanged_columns),
            'new' => array_diff_assoc($new_columns, $unchanged_columns),
        ];
    }
 
    public function updateRecord(Request $request, $record, $data = [])
    {
        $old_record = $record->replicate();
        //return rows affected by the update
        $data = array_merge($request->only($this->columns('update')), $data);
        $rows = $this->updateOneRecord(
            $record,
            $this->prepareDataBeforeUpdate($data, $request)
        );
        if ($rows) {
            $result = 'success';
            $message = $request->success_message ?? $this->messages['update']['success'];
            $this->onUpdateSuccess($request, $record, $old_record);
        } else {
            $result = 'error';
            $message = $request->error_message ?? $this->messages['update']['error'];
            $this->onUpdateFail($request, $record);
        }
        return to_route(
            $request->_redirect ?? $this->redirects['update'] ?? $this->path.'.index',
            $request->_redirect_data ?? $record ?? null
        )->with($result, __($message));
    }

    // things to do on json success update
    public function onUpdateJsonSuccess(Request $request, $record, $old_record, $json_column)
    {

    }

    // things to do on failed update
    public function onUpdateJsonFail(Request $request, $record, $json_column)
    {

    }

    public function updateJsonColumn(Request $request, $record, $json_column, $data = [])
    {
        $old_record = $record->replicate();
        $row = $this->updateOneRecord($record, [
            $json_column => array_merge($record[$json_column] ?? [], $data)
        ]);
        if ($row) {
            $result = 'success';
            $message = $request->success_message ?? $this->messages['update']['success'];
            $this->onUpdateJsonSuccess($request, $record, $old_record, $json_column);
        } else {
            $result = 'error';
            $message = $request->error_message ?? $this->messages['update']['error'];
            $this->onUpdateJsonFail($request, $record, $json_column);
        }
        return to_route(
            $request->_redirect ?? $this->redirects['update'] ?? $this->path.'.index',
            $request->_redirect_data ?? $record ?? null
        )->with($result, __($message));
    }
 
    // things to do on success destroy
    public function onDestroySuccess(Request $request, $record)
    {

    }

    // things to do on failed destroy
    public function onDestroyFail(Request $request, $record)
    {

    }

    public function destroyRecord(Request $request, $record)
    {
        $deleted_record = $record->replicate();
        $deleted = $record->delete();
        if ($deleted) {
            $result = 'success';
            $message = $this->messages['destroy']['success'];
            $this->onDestroySuccess($request, $deleted_record);
        } else {
            $result = 'error';
            $message = $this->messages['destroy']['error'];
            $this->onDestroyFail($request, $deleted_record);
        }
        return to_route(
            $request->_redirect ?? $this->redirects['destroy'] ?? $this->path.'.index',
            $request->_redirect_data ?? $deleted_record ?? null
        )->with($result, __($message));
    }

    // things to do on json success destroy
    public function onDestroyJsonSuccess(Request $request, $record, $json_column)
    {

    }

    // things to do on json failed destroy
    public function onDestroyJsonFail(Request $request, $record, $json_column)
    {

    }

    public function destroyJsonColumn(Request $request, $record, $json_column, $json_keys = [])
    {
        $deleted_record = $record->replicate();
        $json_column_data = $record[$json_column] ?? [];
        foreach ($json_keys as $key) {
            if ($key && isset($json_column_data[$key])) {
                unset($json_column_data[$key]);
            }
        }
        $row = $this->updateOneRecord($record, [
            $json_column => $json_column_data ?: null
        ]);
        if ($row) {
            $result = 'success';
            $message = $this->messages['destroy']['success'];
            $this->onDestroyJsonSuccess($request, $deleted_record, $json_column);
        } else {
            $result = 'error';
            $message = $this->messages['destroy']['error'];
            $this->onDestroyJsonFail($request, $deleted_record, $json_column);
        }
        return to_route(
            $request->_redirect ?? $this->redirects['destroy'] ?? $this->path.'.index',
            $request->_redirect_data ?? $deleted_record ?? null
        )->with($result, __($message));
    }
}
