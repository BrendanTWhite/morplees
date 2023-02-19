@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))

@section('line_one', __('That was not ideal'))
@section('line_two', __('You have found a software bug.'))
@section('line_three', __('We will fix it soon.'))
