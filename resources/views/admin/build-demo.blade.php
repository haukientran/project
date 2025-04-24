@extends('admin.layouts.app')

@section('page_title', $title)

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $title }}</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {!!session('success') !!}
                </div>
            @endif

            <form action="{{ route('admin.build.demo.process') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="demo_url">Demo URL <span class="text-danger">*</span></label>
                    <input type="url" name="demo_url" id="demo_url" class="form-control" placeholder="https://example.com" value="https://ex01.icweb.online" required>
                    @error('demo_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Build Demo</button>
                </div>
            </form>
        </div>
    </div>
@endsection