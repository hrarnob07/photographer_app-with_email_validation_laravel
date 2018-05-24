@extends('layouts.app')

@section('content')


<form class="form-horizontal" method="POST" action="{{url('/addphoto')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-md-4 control-label">Title</label>

            <div class="col-md-6">
                <input id="title" type="title" class="form-control" name="title" value="{{ old('post_title') }}" required autofocus>

                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">description</label>

            <div class="col-md-6">
                <textarea id="description"  rows="7" class="form-control" name="description" value="{{ old('description') }}"  required></textarea>

                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>

       <div class="form-group{{ $errors->   has('category_id') ? ' has-error' : '' }}">
        <label for="category_id" class="col-md-4 control-label">Visibility</label>

        <div class="col-md-6">
            <select id="category_id"  class="form-control" name="category_id" value="{{ old('category_id') }}"  required>
                
        <option value="">select</option>
                     @if(count($categories)>0)
                       @foreach($categories->all() as $category)
                       <option value="{{$category->id}}">{{$category->category}}</option>
                             
                       @endforeach

                     @endif

                                     

                </select>

                @if ($errors->has('category_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
                        
                     

             <div class="form-group{{ $errors->has('post_image') ? ' has-error' : '' }}">
                <label for="designation" class="col-md-4 control-label">Featured Picturee </label>

                <div class="col-md-6">
                    <input id="post_image" type="file" class="form-control" name="post_image" required>

                    @if ($errors->has('post_image'))
                        <span class="help-block">
                            <strong>{{ $errors->first('post_image') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
                       

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary btn-large btn-block"  >
                            Publish Post
                        </button>

                       
                    </div>
                </div>
            </form>

@endsection