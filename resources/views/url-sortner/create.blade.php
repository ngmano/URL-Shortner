@extends('layouts.layout')
@section('content')

@section('title', 'Create')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Sort URL</h1>


        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">              
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Generate Sorten URL!</h1>
                  </div>
                  <form action="{{ route('url-sortner.store') }}" method="post" class="user" data-ajax_submit="true">
                    @csrf
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="original_url" placeholder="Enter URL Address... *">
                    </div>                                       
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Generate
                    </button>
                    <hr> 
                    <div class="card shadow mb-4 hide" id="output-box">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">Sortener URL</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample" style="">
                  <div class="card-body">
                    <p><strong>Original URL:</strong> <a href="" id="original_url"></a></p>
                    <p><strong>Sortener URL:</strong> <a href="" id="sorted_url"></a></p>
                  </div>
                </div>
              </div>                   
                  </form>                 
                </div>
              </div>
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            </div>
          </div>
        </div>


      
</div>
<!-- /.container-fluid -->
@endsection