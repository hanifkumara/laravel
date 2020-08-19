@if (session()->has('success'))
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            </div>
        </div>
    </div>
@endif
@if (session()->has('error'))
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-danger">
                    {{session()->get('error')}}
                </div>
            </div>
        </div>
    </div>
@endif