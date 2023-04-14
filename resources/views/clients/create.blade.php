@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-4 mb-2">
                <div class="card-header grey">
                    <h1>Add Client</h1>
                </div>
                <div class="card-body grey">
                    <form action="{{route('clients-store')}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Client Name</label>
                            <input type="text" class="form-control brown" name="name" value={{old('name')}}>
                            <div class="form-text black">Please add client name here</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Client Surname</label>
                            <input type="text" class="form-control brown" name="surname" value={{old('surname')}}>
                            <div class="form-text black">Please add client surname here</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Personal Code</label>
                            <input type="text" class="form-control brown" name="personal_code" value={{old('personal_code')}}>
                            <div class="form-text black">Please add client personal code here</div>
                        </div>

                        <button type="submit" class="btn btn-outline-dark brown">Submit</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
