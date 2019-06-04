@extends('layout')

@section('content')
@foreach($events as $event)
    <div class="table-responsive">
        <table class="table-striped">
            <tr>
                <td>User Display Name</td>
                <td>User Device</td>
                <td>Managed Device Name</td>
                <td>Compliance State</td>
                <td>Enrolled Date</td>
                <td>Registration State</td>
            </tr>
            <tr>
                <td>{{$event->getUserDisplayName()}} ({{$event->getEmailAddress()}})</td>
                <td>{{$event->getManufacturer()}} {{$event->getModel()}}</td>
                <td>{{$event->getManagedDeviceName()}}</td>
                <td>{{$event->getComplianceState()->value()}}</td>
                <td>{{$event->getEnrolledDateTime()->format('F d, Y')}}</td>
                <td>{{$event->getDeviceRegistrationState()->value()}}</td>
            </tr>
        </table>
    </div>
    <br />
    <br />
@endforeach
@stop
