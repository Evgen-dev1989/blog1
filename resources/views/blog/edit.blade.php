@extends('layouts.app')

@section('content')
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl">
                Update Post
            </h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="w-4/5 m-auto">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="w-4/5 m-auto pt-20">
        <form
            action="/blog/{{ $post->slug }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input
                type="text"
                name="title"
                value="{{ $post->title }}"
                class="bg-transparent block border-b-2 w-full h-20 text-6xl outline-none">

            <textarea
                name="description"
                placeholder="Description..."
                class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none">{{ $post->description }}</textarea>

            <button
                type="submit"
                class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                Submit Post
            </button>
            <?php
            $url ='https://pixabay.com/api/';

            $options = array(

                'key' => '27228236-ecacee828bdd0ed754e88ae07',
                'q'=> 'all',
                'lang'=>'en',
                'category'=> 'all',
                'colors'=> "grayscale", "transparent", "red", "orange", "yellow", "green", "turquoise", "blue", "lilac", "pink", "white", "gray", "black", "brown",
                'order'=>  "popular",

            );

            $curl= curl_init();

            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl,CURLOPT_URL,$url.'?'.http_build_query($options));

            $response =curl_exec($curl);
            $data =json_decode($response,true);
            curl_close($curl);



            $ids = [];

            array_walk_recursive($data, function($value, $key) use (&$ids){
                if ($key === "userImageURL") {
                    function multi_implode($el, $data) {
                        $my_array=array();
                        foreach($data as $val)
                            $my_array[] = is_array($val)? multi_implode($el, $val) : $val;
                        return implode($el, $my_array);
                    }

                    $ids[] = $value;
                }

            });


            ?>


            <button
                type="button"
                class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                <a href="{{$ids}}">Search Image</a>
            </button>
            <button
                type="submit"
                class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                Insert Image
            </button>

        </form>
    </div>

@endsection

