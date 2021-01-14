@extends('layouts.app')

@section('content')
<div class="flex justify-center">
  <div class="w-8/12 bg-white p-6 rounded-lg">
  <h2>posts</h2>
<?php var_dump(DB::connection()) ?>
</div>
@endsection