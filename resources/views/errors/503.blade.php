@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))

@section('line_one', __('Cannot do this now'))
@section('line_two', __('This is just a small delay.'))
@section('line_three', __('We will be back soon.'))
