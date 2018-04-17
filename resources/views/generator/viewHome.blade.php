@extends('template.layout')

@section('title')
    Proposal Generator
@endsection

@section('content')

    <h1>The Proposal Generator</h1>

    <div id="generatorApp">
        @foreach($sections as $section)
            <h2>{{ $section->name }}</h2>

            <div class="radio">
                <label>
                    <input type="radio" name="radio{{ $section->id }}" id="radio{{ $section->id }}" value="" v-model="section[{{ $section->id }}]" checked>
                    Empty
                </label>
            </div>

            @foreach($section->pieces as $piece)
                <div class="radio">
                    <label>
                        <input type="radio" name="radio{{ $section->id }}" id="radio{{ $section->id }}" value="{{ $piece->text }}" v-model="section[{{ $section->id }}]">
                        {{ $piece->text }}
                    </label>
                </div>
            @endforeach

            <div class="radio">
                <label>
                    <input type="radio" name="radio{{ $section->id }}" id="radio{{ $section->id }}custom" value="**custom{{ $section->id }}" v-model="section[{{ $section->id }}]">
                    <textarea class="form-control autoexpand" rows="2" cols="50" id="textarea{{ $section->id }}" v-model="custom[{{ $section->id }}]" onclick="$(this).prev().click(); $(this).prop('cols', 70).prop('rows', 5);"></textarea>

                </label>
            </div>
        @endforeach

        <br>
        <hr>
        <br>

        <h2>Proposal</h2>

        <textarea class="form-control autoexpand" rows="5" onclick="this.select();">@{{ proposal }}</textarea>
    </div>

    <br><br>

    <script>

        var genApp = new Vue({
            el: '#generatorApp',

            /*
            Perhaps the right way to have approached this was to create:
            values[sectionid][pieceid] = piece.. where "custom" in place of pieceid would hold custom text
            selected[sectionid] = pieceid or custom
             */

            data: {
                section: new Array({{ count($sections)+1 }}).fill(''),
                custom: new Array({{ count($sections)+1 }}).fill(''),
            },

            computed: {
                proposal: function() {
                    var gApp = this;
                    return this.section.filter(function (val) {return val != '';}).join('\n\n').replace(/\*\*custom(\d)/g, function (match, n){return gApp.custom[n]});
                }
            },

            methods: {

            }
        });
    </script>

@endsection