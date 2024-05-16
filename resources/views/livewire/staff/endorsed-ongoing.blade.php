<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
{{-- @dd($thisendorsed) --}}
@foreach ($thisendorsed as $thisendorsedval)
{{$thisendorsedval->scholar_id}},{{$thisendorsedval->name}},{{$thisendorsedval->school}},{{$thisendorsedval->course}},{{$thisendorsedval->semester}},{{$thisendorsedval->year}}
<br>
@endforeach
</div>
