@extends('layouts.master')
@section('title','Booking')
@section('content')

<div style="margin-bottom: 2%">
  @if (session()->has('booking_success'))
  <div>
    <p style="color: green">{{session()->get('booking_success')}}</p>
  </div>
  @endif
  @if (session()->has('booking_fail'))
  <div>
    <p style="color: red">{{session()->get('booking_fail')}}</p>
  </div>
  @endif
  <h3>{{$room->name}}</h3>
  <h3>Price: <sup>$</sup>{{$room->price}}<span>/day</span></h3>
</div>
@auth
<h5 style="margin-bottom: 10px;">{{$user->email}}</h5>
<form action="{{ route('bookings.store', ['room_id' => $room->id]) }}" class="filter__form" style="border: solid #e9ad28; " method="post">
  @csrf
  <div class="filter__form__item">
    <p>Username</p>
    <div class="filter__form__datepicker">
      <input style="padding-left: 0px" type="text" name="name" value="{{$user->profile->name}}">
    </div>
  </div>
  <div class="filter__form__item">
    <p>Address</p>
    <div class="filter__form__datepicker">
      <input style="padding-left:0px" type="text" name="address" value="{{$user->profile->address}}">
    </div>
  </div>
  <div class="filter__form__item">
    <p>Phone</p>
    <div class="filter__form__datepicker">
      <input style="padding-left: 0px;" type="text" name="phone" value="{{$user->profile->phone}}">
    </div>
  </div>
  <div class="filter__form__item">
    <p>Date Start</p>
    <div class="filter__form__datepicker">
      <span class="icon_calendar"></span>
      <input type="text" name="date_start" class="datepicker_pop check__in">
      <i class="arrow_carrot-down"></i>
    </div>
  </div>
  <div class="filter__form__item">
    <p>Date End</p>
    <div class="filter__form__datepicker">
      <span class="icon_calendar"></span>
      <input type="text" name="date_end" class="datepicker_pop check__out">
      <i class="arrow_carrot-down"></i>
    </div>
  </div>
  <button style="right: -100px; outline: solid 3px #e9ad28;" type="submit">Booking</button>
</form>
@endauth
@guest

<form action="{{ route('bookings.store', ['room_id' => $room->id]) }}" class="filter__form" style="border: solid #e9ad28; " method="post">
  @csrf
  <div class="filter__form__item">
    <p>Username</p>
    <div class="filter__form__datepicker">
      <input style="padding: 0px" type="text" name="name">
    </div>
  </div>
  <div class="filter__form__item">
    <p>Address</p>
    <div class="filter__form__datepicker">
      <input style="padding: 0px" type="text" name="address">
    </div>
  </div>
  <div class="filter__form__item">
    <p>Phone</p>
    <div class="filter__form__datepicker">
      <input style="padding: 0px" type="text" name="phone">
    </div>
  </div>
  <div class="filter__form__item">
    <p>Date Start</p>
    <div class="filter__form__datepicker">
      <span class="icon_calendar"></span>
      <input type="text" name="date_start" class="datepicker_pop check__in">
      <i class="arrow_carrot-down"></i>
    </div>
  </div>
  <div class="filter__form__item">
    <p>Date End</p>
    <div class="filter__form__datepicker">
      <span class="icon_calendar"></span>
      <input type="text" name="date_end" class="datepicker_pop check__out">
      <i class="arrow_carrot-down"></i>
    </div>
  </div>
  <button style="right: -100px; outline: solid 3px #e9ad28;" type="submit">Booking</button>
</form>

@endguest
@if ($errors->has('name'))
<p style="color: red">{{$errors->first('name')}}</p>
@endif
@if ($errors->has('address'))
<p style="color: red">{{$errors->first('address')}}</p>
@endif
@if ($errors->has('phone'))
<p style="color: red">{{$errors->first('phone')}}</p>
@endif
@if ($errors->has('date_start'))
<p style="color: red">{{$errors->first('date_start')}}</p>
@endif
@if ($errors->has('date_end'))
<p style="color: red">{{$errors->first('date_end')}}</p>
@endif
@endsection