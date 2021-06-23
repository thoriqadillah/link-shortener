@extends('layouts.template')
@section('title', 'Home')

@section('content')

<div class="container">
<h1 class="my-3">My Links</h1>

    @if (session()->has('success'))
    <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>        
    @endif
    
    <h5>Edit Your Link</h5>
    <form action="/update/{{$latest->id}}" method="POST">
        @method('patch')
        @csrf
        <div class="row">
            <div class="col-8">
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control @error('link') is-invalid @enderror" value="{{old('link') ?? $latest->link}}" name="link" placeholder="Your Link" disabled>
                        @error('link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">http://127.0.0.1:8000/</div>
                          </div>
                          <input type="text" class="form-control @error('link') is-invalid @enderror" id="inlineFormInputGroupUsername" name="short" value="{{old('short') ?? $latest->short}}" placeholder="Short Link">
                          @error('link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                      </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2">Save</button>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection