

<div class="container section-marginTop text-center">
    <h1 class="section-title">Courses </h1>
    <h1 class="section-subtitle">IT Course, Project Based Source Code and All Other Services That We Provide </h1>
    <div class="row">
        @foreach($coursesData as $data)
        <div class="col-md-4 thumbnail-container">
                <img src="{{ $data['course_img'] }}" alt="Avatar" class="thumbnail-image ">
                <div class="thumbnail-middle">
                    <h1 class="thumbnail-title"> {{ $data['course_name'] }} </h1>
                    <h1 class="thumbnail-subtitle"> {{ $data['course_des'] }} </h1>
                    <h1 class="thumbnail-subtitle"> {{ $data['course_totalclass'] }} </h1>
                    <a href="{{ $data['course_link'] }}" class="normal-btn btn">Start</a>
                </div>
        </div>
        @endforeach
    </div>
</div>
