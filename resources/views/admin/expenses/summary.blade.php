@extends('admin/layouts/app')

@section('content')
<h2>Thống kê tài chính</h2>
<p>Tổng thu nhập: {{ number_format($total_income, 2) }} VNĐ</p>
<p>Tổng chi phí: {{ number_format($total_expense, 2) }} VNĐ</p>
<p>Số dư: {{ number_format($balance, 2) }} VNĐ</p>
@endsection