<?php
namespace Project\Controllers;

use Project\Models\Expense;
use Project\Models\Project;
use App\Http\Controllers\Admin\Controller;

use App\Helpers\Admin\Form;
use App\Helpers\Admin\ListData;
use Project\Requests\Admin\ExpenseRequest;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    function __construct()
    {
        $this->module_name = 'Thu chi';
        $this->model = new Expense();
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
        $listdata->search('type', 'Loại', 'select', null, $this->model->getTypes());
        $listdata->search('status', 'Trạng thái', 'select', null, $this->model->statusDropdown());
        $listdata->search('created_at', 'Thời gian', 'range');

        // Build bảng
        $listdata->add('name', 'Tiêu đề', 0, 'text', [], ['td_class' => 'text-left']);
        $listdata->add('type_label', 'Loại', 0, 'text', [], ['td_class' => 'text-center']);
        $listdata->add('field_label', 'Lĩnh vực', 0, 'text', [], ['td_class' => 'text-center']);
        $listdata->add('amount', 'Số tiền', 0, 'number', [], ['td_class' => 'text-right']);
        $listdata->add('date', 'Ngày ghi nhận', 0, 'date');
        $listdata->add('note', 'Ghi chú', 0);
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
    public function store(ExpenseRequest $request)
    {
        // dd($request->all());
        $status = 1;
        extract($request->all(), EXTR_OVERWRITE);
        $data_update = compact( 'name', 'slug', 'type', 'amount', 'field_id', 'project_id', 'member_id', 'note', 'date');
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
        $form = new Form($id ? $this->model->findOrFail($id) : null);
        $form_data[] = $form->input('name', 'Tiêu đề',  1);
        $form_data[] = $form->slug('slug', 'Đường dẫn',  $this->table_name);
        $form_data[] = $form->select('member_id', 'Người thu chi',  1, AdminUser::quickDropdown());
        $form_data[] = $form->select('type', 'Loại',  1, $this->model->getTypes());
        $form_data[] = $form->input('amount', 'Số tiền',  1, 'number');
        $form_data[] = $form->select('field_id', 'Lĩnh vực',  1, config('app.fields'));
        $form_data[] = $form->select('project_id', 'Dự án',  0, Project::quickDropdown());

        $form_data[] = $form->input('date', 'Ngày ghi nhận',  0, 'date');
        $form_data[] = $form->input('note', 'Ghi chú', 0, 'textarea');
        $form_data[] = $form->switch('status', 'Trạng thái');

        return $form->render();
    }

    public function summary()
    {
        $total_income = Expense::where('type', 1)->sum('amount');
        $total_expense = Expense::where('type', 2)->sum('amount');
        $balance = $total_income - $total_expense;

        return view('project::admin.expenses.summary', compact('total_income', 'total_expense', 'balance'));
    }
}
