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
                    {{-- kalau sudah dihosting diganti {{env('APP_URL')}} --}}
                    <td><a href="http://127.0.0.1:8000/{{$link->short}}">http://127.0.0.1:8000/{{$link->short}}</a></td> 
                    <td><a href="/delete/{{$link->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg></a></td>
                </tr>
            @endforeach
        </tbody>
      </table>

</div>
    
@endsection