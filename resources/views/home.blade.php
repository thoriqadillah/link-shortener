@extends('layouts.template')
@section('title', 'Home')

@section('content')

<div class="container">
    <h1 class="my-3">My Links</h1>
    <h5>Create New Link</h5>
    <form action="/create" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" placeholder="Your Link">
                        @error('link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <table class="table mt-4 table-responsive-md">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Link</th>
            <th scope="col">Short Link</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $link)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td><a href="{{$link->link}}">{{$link->link}}</a></td>
                    <td><a href="{{env('APP_URL')}}/{{$link->short}}">{{env('APP_URL')}}/{{$link->short}}</a></td>
                </tr>
            @endforeach
        </tbody>
      </table>

</div>
    
@endsection