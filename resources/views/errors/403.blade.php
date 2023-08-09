@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

@section('line_one', __('This is not for you'))
@section('line_two', __('You are not permitted to.'))
@section('line_three', __('See this private page.'))
