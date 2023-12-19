@extends('layouts.app')

@section('content')
    <header class= "d-flex justify-content-between align-items-center my-5" dir = "rtl">
        <div class = "h6 text-dark">
            <a href= "/projects">المشاريع/ {{$project->title}}</a>
        </div>
        <div>
            <a href = "/projects/{{$project->id}}/edit" class= "btn btn-primary px-4" role = "button">تعديل المشروع</a>
        </div>
    </header> 

    <section dir="rtl">
        <div class = "row">
            <div class = "col-lg-4">
                <div class = "card text-right">
                    <div class = "card-body">
                        <div class = "status">
                            @switch($project->status)
                                @case(1)
                                    <span class = "text-success">مكتمل</span>
                                    @break
                                @case(2)
                                    <span class = "text-danger">ملغي</span>
                                    @break
                                @default
                                    <span class = "text-warning">قيد الانجاز</span>
                            @endswitch
                            <h5 class = "font-wight-bold card-title">
                                <a href = "/projects/{{ $project->id }}"> {{$project->title}} </a>
                            </h5>
                            <div class = "card-text mt-4">
                                {{ $project->description }}
                            </div>
                        </div>
                        @include('projects.footer')
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class = "font-wight-bold card-title">
                            تغيير حالة المشروع
                        </h5>
                        <form action="" method="POST">
                            @csrf
                            @method("PATCH")

                            <select name="status" class ="custom-select" onchange="this.form.submit()">
                                <option value="0" {{($project->status == 0)? "selected" : ""}}>قيد الانجاز</option>
                                <option value="1" {{($project->status == 1)? "selected" : ""}}>مكتمل</option>
                                <option value="2" {{($project->status == 2)? "selected" : ""}}>ملغي</option>
                            </select>
                        </form>
                        
                    </div>
                </div>
            </div>
            <div class = "col-lg-8">
                @foreach ($project->tasks as $task)
                    <div class = "card d-flex flex-row mt-2 p-4 align-item-center">
                        <div class = "{{$task->done ? "checked muted" : ""}}">
                            {{$task->body}}
                        </div>
                        <div class="mr-auto">
                            <form action="/projects/{{$project->id}}/tasks/{{$task->id}}" method="POST">
                                @csrf
                                @method("PATCH")
                                <input type="checkbox" name="done" {{$task->done ? "checked" : ""}} onchange="this.form.submit()">
                            </form>
                        </div>
                        <div class = "d-flex align-items-center mr-auto">
                            <form action="/projects/{{$task->project_id}}/tasks/{{$task->id}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class = "btn-delete mt-1" value="">
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class = "card mt-4">
                    <form action="/projects/{{$project->id}}/tasks" method="POST" class="d-flex p-3">
                        @csrf
                        <input type="text" name="body" class="form-control p-2 ml-2 border-0" placeholder="اضف مهمة جديدة">
                        <button type="submit" class="btn btn-primary">اضافة</button>
                    </form>
                </div>
                

            </div>
        </div>
    </section>
    
@endsection