@extends('app.layout')
@section('content')

    <div class="card bg-primary-gradient">
        <div class="d-flex align-items-end row">
            <div class="">
                <div class="card-body">
                    <h4 class="card-title text-white fw-bolder">{{__('Generate Image with AI')}}</h4>
                    <p class="card-text text-white ">{{__('Describe the scene or subject in vivid detail, Be specific about styles, colors, and moods.')}}</p>


                    <form novalidate="novalidate" method="post" action="{{$base_url}}/app/ai-generate-image" id="form-ai-generate-image" data-form="refresh" data-btn-id="btn-ai-generate-image">
                        <div class="row g-3 align-items-center mt-3 mb-4">
                            <div class="col-auto">
                                <label for="input_prompt" class="col-form-label text-white">{{__('Prompt')}}</label>
                            </div>

                            <div class="col-md-9">
                                <input type="text" id="input_prompt" name="prompt" class="form-control" placeholder="Illustrate a photo of a space craft">
                            </div>
                            <div class="col-auto">
                                <button id="btn-ai-generate-image" class="btn btn-dark">{{__('Generate')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('Images')}} /</span> {{__('AI generated images')}}</h4>

        <!-- Examples -->
        <div class="row mb-5">
            @foreach($files as $file)

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <img class="card-img-top" src="{{config('app.url')}}/uploads/{{$file->path}}" class="rounded max-height-75" loading="lazy" alt="{{$file->title}}" alt="Card image cap" />
                        <div class="card-body">

                            <p class="card-text">
                                {{$file->created_at->diffForHumans()}}
                            </p>

                            <a href="{{$base_url}}/app/download-media-file/{{$file->uuid}}"  class="btn btn-outline-dark btn-icon rounded-pill dropdown-toggle hide-arrow" aria-expanded="false"><i class="bi bi-cloud-download"></i></a> <a href="{{$base_url}}/app/delete/media-file/{{$file->uuid}}"  class="btn btn-outline-dark btn-icon rounded-pill dropdown-toggle hide-arrow"  aria-expanded="false"><i class="bi bi-trash3"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
