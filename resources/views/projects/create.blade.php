@extends('layouts.app')

@section('title', 'انشاء مشروع جديد')

@section('content')
    <div class = "row justify-content-center text-right">
        <div class = "col-8">
            <div class="card p-4">
                <h3 class = "text-center pb-5 font-wight-bold">
                    مشروع جديد
                </h3>
                <form action= "/projects" method="POST" dir="rtl">
                    @include('projects.form', ["project" => new App\Models\Project()])               
                    <div class="form-group d-flex flex-row-reverse">
                        <button type = "submit" class = "btn btn-primary">انشاء</button>
                        <a href = "/projects" class = "btn btn-light">الغاء</a>
                    </div>
                </form>
            </div>           
        </div>
    </div>
    
@endsection
