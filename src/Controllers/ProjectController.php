<?php

namespace Project\Controllers;

use App\Http\Controllers\Admin\Controller;
use App\Helpers\Admin\Form;
use App\Helpers\Admin\ListData;
use Project\Requests\Admin\ProjectRequest;
use Project\Models\Project;
use Illuminate\Http\Request;
use App\Models\AdminUser;

class ProjectController extends Controller
{
    function __construct()
    {
        $this->module_name = 'Dự án';
        $this->model = new Project();
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $model = $this->model;
        $listdata = new ListData($request, $model);

        // Build Form tìm kiếm
        $listdata->search('name', 'Tiêu đề');
        $listdata->search('field_id', 'Lĩnh vực', 'select', null, config('app.fields'));
        $listdata->search('status', 'Trạng thái', 'select', null, $this->model->statusDropdown());
        $listdata->search('created_at', 'Thời gian', 'range');
        // $listdata->btnForm('excel_export', 'Xuất excel', 'success', 'fas fa-file-excel');

        // Build bảng
        $listdata->add('name', 'Tiêu đề', 0, 'text', [], ['td_class' => 'text-left']);
        $listdata->add('field_label', 'Lĩnh vực', 0, 'text', [], ['td_class' => 'text-center']);
        $listdata->add('total_revenue', 'Tổng thu', 0, 'number', [], ['td_class' => 'text-right']);
        $listdata->add('total_expense', 'Tổng chi', 0, 'number', [], ['td_class' => 'text-right']);
        $listdata->add('renewed_at', 'Ngày gia hạn', 0, 'date');
        $listdata->add('deadline', 'Deadline', 0, 'date');
        $listdata->add('', 'Thời gian', 0, 'time_at');
        $listdata->add('status', 'Trạng thái', 0, 'switch_status');
        $listdata->add('', 'Hành động', 0, 'action', ['edit', 'delete']);

        return $listdata->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->formUpdate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        // dd($request->all());
        $status = 1;
        extract($request->all(), EXTR_OVERWRITE);

        if (! empty($manager_id)) 
        {
            $manager_id = implode(',', $manager_id);
        }
        if (! empty($member_ids)) 
        {
            $member_ids = implode(',', $member_ids);
        }

        $data_update = compact( 'name', 'slug', 'image', 'description', 'manager_id', 'member_ids', 'field_id', 'total_revenue', 'total_expense', 'renewed_at', 'deadline', 'status');
        $this->actionStore($id ?? 0, $data_update, $redirect);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->formUpdate($id);
    }

    private function formUpdate($id = 0)
    {
        if($id) {
            $model = $this->model->findOrFail($id) ?? null; 
            $manager_id = explode(',', $model->manager_id);
            $model->manager_id = $manager_id;
        }

        $form = new Form($id ? $model : null);

        $form_data[] = $form->input('name', 'Tiêu đề',  1);
        $form_data[] = $form->slug('slug', 'Đường dẫn',  $this->table_name);
        $form_data[] = $form->input('image', 'Ảnh đại diện',  0, 'image', []);
        $form_data[] = $form->select('manager_id[]', 'Quản lý',  1, AdminUser::quickDropdown(),  ['multiple' => 'multiple']);
        $form_data[] = $form->select('member_ids[]', 'Thành viên dự án',  1, AdminUser::quickDropdown(),  ['multiple' => 'multiple']);

        $form_data[] = $form->select('field_id', 'Lĩnh vực',  1, config('app.fields'), []);
        $form_data[] = $form->input('total_revenue', 'Tổng thu nhập',  1, 'number');
        $form_data[] = $form->input('total_expense', 'Tổng chi phí',  1, 'number');
        $form_data[] = $form->input('renewed_at', 'Ngày gia hạn',  0, 'date');
        $form_data[] = $form->input('deadline', 'Ngày deadline',  0, 'date');
        
        $form_data[] = $form->ckeditor('description', 'Nội dung' );
        $form_data[] = $form->switch('status', 'Trạng thái');

        return $form->render();
    }
}
