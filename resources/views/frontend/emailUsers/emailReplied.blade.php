@extends('frontend.emailLayouts.default')
@section('title', ' مرحبا ' . $name)
@section('body')
    <tbody>
    <tr>
        <td style="font:14px/25px arial; color:#333; padding: 24px 0 35px;">

            <p>{{ $subject }}</p>
            <br />
            {{ $content }}
            <p>شكرا جزيلا,</p>
        </td>
    </tr>
    </tbody>
@stop
